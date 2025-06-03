<?php

namespace App\Imports;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class MembersImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures, Importable;

    private $rowCount = 0;
    private $currentRow = 0;
    private $duplicatesSkipped = 0;

    private $errors = [];

    public function model(array $row): ?User
    {
        try {
            $this->currentRow++;

            $normalizedRow = array_change_key_case($row, CASE_LOWER);
            $normalizedRow = array_combine(
                array_map(fn($key) => str_replace(' ', '_', strtolower($key)), array_keys($normalizedRow)),
                array_values($normalizedRow)
            );

            $requiredFields = [
                'first_name',
                'family_name',
                'email',
                'mobile_number',
                'prc_registration_number',
                'prc_date_issued',
                'prc_valid_until',
                'sex',
                'civil_status',
            ];

            foreach ($requiredFields as $field) {
                if (empty($normalizedRow[$field])) {
                    $message = "Required field '" . strtoupper(str_replace('_', ' ', $field)) . "' is missing or empty in row {$this->currentRow}";
                    $this->errors[] = "Required field '" . strtoupper(str_replace('_', ' ', $field)) . "' is missing or empty in row {$this->currentRow}.";
                    throw new Exception($message);
                }
            }

            // Check for duplicates
            $existingUser = User::where('email', $normalizedRow['email'])
                ->orWhere('prc_registration_number', $normalizedRow['prc_registration_number'])
                ->first();

            if ($existingUser) {
                $this->duplicatesSkipped++;
                $this->errors[] = "Duplicate email {$normalizedRow['email']} or PRC number {$normalizedRow['prc_registration_number']} in row {$this->currentRow}";
                return null;
            }

            $this->rowCount++;

            $user = new User([
                'first_name' => $normalizedRow['first_name'],
                'family_name' => $normalizedRow['family_name'],
                'middle_name' => $normalizedRow['middle_name'] ?? null,
                'birthdate' => $this->parseBirthDate($normalizedRow['birth_date'] ?? null),
                'birthplace' => $normalizedRow['birth_place'] ?? null,
                'sex' => $normalizedRow['sex'],
                'civil_status' => $normalizedRow['civil_status'],
                'permanent_address' => $normalizedRow['permanent_address'] ?? null,
                'telephone' => $normalizedRow['telephone'] ?? null,
                'fax' => $normalizedRow['fax'] ?? null,
                'mobile' => $this->formatPhoneNumber($normalizedRow['mobile_number']),
                'email' => $normalizedRow['email'],
                'prc_registration_number' => $normalizedRow['prc_registration_number'],
                'prc_date_issued' => $this->parseBirthDate($normalizedRow['prc_date_issued']),
                'prc_valid_until' => $this->parseBirthDate($normalizedRow['prc_valid_until']),
                'current_chapter' => $normalizedRow['current_chapter'] ?? null,
                'previous_chapter' => $normalizedRow['previous_chapter'] ?? null,
                'position_held' => $normalizedRow['position_held'] ?? null,
                'status' => 'pending',
            ]);

            $user->save();
            $user->assignRole('member');

            return $user;
        }catch (\Exception $e) {
            $this->errors[] = "Row {$this->currentRow}: {$e->getMessage()}";
            return null;
        }
    }

    protected function parseBirthDate($dateValue): ?string
    {
        if (empty($dateValue)) {
            return null;
        }

        try {
            // Handle Excel date serial numbers
            if (is_numeric($dateValue)) {
                $date = Date::excelToDateTimeObject($dateValue);
                if ($date instanceof \DateTime) {
                    return $date->format('Y-m-d');
                }
                throw new Exception("Invalid Excel serial date: {$dateValue}");
            }

            // Normalize date string
            $dateValue = trim($dateValue);
            $dateValue = preg_replace('/[\s]+/', '', $dateValue);
            $dateValue = preg_replace('/\/+/', '/', $dateValue);

            // Try common date formats
            $formats = [
                'Y-m-d', 'm/d/Y', 'd/m/Y', 'n/j/Y', 'Y/m/d', 'm-d-Y',
            ];

            foreach ($formats as $format) {
                try {
                    $date = Carbon::createFromFormat($format, $dateValue);
                    if ($date && $date->isValid()) {
                        return $date->format('Y-m-d');
                    }
                } catch (\Exception $e) {
                    continue;
                }
            }

            throw new Exception("Invalid date format: '{$dateValue}'. Expected formats: YYYY-MM-DD, MM/DD/YYYY, or DD/MM/YYYY.");
        } catch (\Exception $e) {
            Log::warning("Failed to parse birth date in row {$this->currentRow}: {$dateValue}. Error: {$e->getMessage()}");
            throw new Exception("Invalid date format in row {$this->currentRow}: '{$dateValue}'. Expected formats: YYYY-MM-DD, MM/DD/YYYY, DD/MM/YYYY, or valid Excel serial number.");
        }
    }

    protected function formatPhoneNumber($phoneValue): ?string
    {
        if (empty($phoneValue)) {
            return null;
        }

        // Remove all non-digit characters
        $digits = preg_replace('/[^0-9]/', '', $phoneValue);

        // Handle cases where Excel stripped leading zero
        if (!empty($digits) && !str_starts_with($digits, '0') && strlen($digits) === 10) {
            $digits = '0' . $digits;
        }

        // Validate length
        if (strlen($digits) < 10) {
            throw new Exception("Phone number must be at least 10 digits in row {$this->currentRow}");
        }

        return $digits;
    }

    public function getRowCount(): int
    {
        return $this->rowCount;
    }

    public function getDuplicatesSkippedCount(): int
    {
        return $this->duplicatesSkipped;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'family_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile_number' => 'required|regex:/^[0-9]{10,12}$/',
            'prc_registration_number' => 'required|string|unique:users,prc_registration_number',
            'prc_date_issued' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!empty($value)) {
                        try {
                            $this->parseBirthDate($value);
                        } catch (\Exception $e) {
                            $fail("Invalid date format in row {$this->currentRow}: '{$value}'. Expected formats: YYYY-MM-DD, MM/DD/YYYY, DD/MM/YYYY, or valid Excel serial number.");
                        }
                    }
                },
            ],
            'prc_valid_until' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!empty($value)) {
                        try {
                            $this->parseBirthDate($value);
                        } catch (\Exception $e) {
                            $fail("Invalid date format in row {$this->currentRow}: '{$value}'. Expected formats: YYYY-MM-DD, MM/DD/YYYY, DD/MM/YYYY, or valid Excel serial number.");
                        }
                    }
                },
            ],
            'sex' => 'required|in:Male,Female,Non-binary,Others',
            'civil_status' => 'required|in:Single,Married,Divorced,Widowed',
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            'first_name.required' => 'The FIRST NAME field is required.',
            'family_name.required' => 'The FAMILY NAME field is required.',
            'email.required' => 'The EMAIL field is required.',
            'email.email' => 'The EMAIL field must be a valid email address.',
            'mobile_number.required' => 'The MOBILE NUMBER field is required.',
            'prc_registration_number.required' => 'The PRC REGISTRATION NUMBER field is required.',
            'prc_date_issued.required' => 'The PRC DATE ISSUED field is required.',
            'prc_valid_until.required' => 'The PRC VALID UNTIL field is required.',
            'sex.required' => 'The SEX field is required.',
            'sex.in' => 'The SEX field must be one of: Male, Female, Non-binary, Others.',
            'civil_status.required' => 'The CIVIL STATUS field is required.',
            'civil_status.in' => 'The CIVIL STATUS field must be one of: Single, Married, Divorced, Widowed.',
        ];
    }
}
