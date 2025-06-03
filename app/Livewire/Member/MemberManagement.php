<?php

namespace App\Livewire\Member;

use AllowDynamicProperties;
use App\Exports\MembersTemplateExport;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MembersExport;
use App\Imports\MembersImport;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

#[AllowDynamicProperties] class MemberManagement extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $showModal = false;
    public $showImportModal = false;
    public $showViewModal = false;
    public $editMode = false;
    public $member_id;
    public $importFile;
    public $importResults = null;

    public $first_name = '';
    public $family_name = '';
    public $middle_name = '';
    public $prc_registration_number = '';
    public $email = '';
    public $mobile = '';
    public $status;
    public $current_chapter;
    public $date_added;
    public $updated_at;

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'family_name' => 'required|string|max:255',
        'middle_name' => 'required|string|max:255',
        'prc_registration_number' => 'required|string|max:50|unique:users,prc_registration_number',
        'email' => 'required|email|unique:users,email',
        'mobile' => 'required|string|max:20',
        'status' => 'required|in:active,pending,deactivated,inactive',
        'current_chapter' => 'required|string|max:255',
        'importFile' => 'required|mimes:xlsx,xls,csv|max:10240',
    ];

    public function mount(): void
    {
        $this->date_added = now()->format('Y-m-d H:i:s');
    }

    public function render()
    {
        $members = User::where('first_name', 'like', '%' . $this->search . '%')
            ->orWhere('middle_name', 'like', '%' . $this->search . '%')
            ->orWhere('family_name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orWhere('prc_registration_number', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.member.member-management', compact('members'));
    }

    public function openModal(): void
    {
        $this->resetForm();
        $this->editMode = false;
        $this->showModal = true;
    }

    public function openEditModal($id): void
    {
        $this->extracted($id);

        $this->editMode = true;
        $this->showModal = true;
    }

    public function openViewModal($id): void
    {
        $this->extracted($id);

        $this->showViewModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->showViewModal = false;
        $this->resetForm();
    }

    public function openImportModal(): void
    {
        $this->importResults = null;
        $this->importFile = null;
        $this->showImportModal = true;
    }

    public function closeImportModal(): void
    {
        $this->showImportModal = false;
        $this->importFile = null;
        $this->importResults = null;
    }

    public function save(): void
    {
        $rules = $this->rules;

        if ($this->editMode) {
            $rules['email'] = 'required|email|unique:users,email,' . $this->member_id;
            $rules['prc_registration_number'] = 'required|string|max:50|unique:users,prc_registration_number,' . $this->member_id;
        }

        $this->validate($rules);

        $data = [
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'family_name' => $this->family_name,
            'prc_registration_number' => $this->prc_registration_number,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'status' => $this->status,
            'current_chapter' => $this->current_chapter,
        ];

        if ($this->editMode) {
            User::findOrFail($this->member_id)->update($data);
            session()->flash('message', 'Member updated successfully!');
        } else {
            User::create($data);
            session()->flash('message', 'Member added successfully!');
        }

        $this->closeModal();
    }

    public function delete($id): void
    {
        User::findOrFail($id)->delete();
        session()->flash('message', 'Member deleted successfully!');
    }

    public function export(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new MembersExport, 'members.xlsx');
    }

    /**
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function downloadTemplate(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $templatePath = public_path('templates/members_import_template.xlsx');
        if (!file_exists($templatePath)) {
            $this->createTemplate();
        }

        return response()->download($templatePath, 'members_import_template.xlsx');
    }

    /**
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     * @throws \Exception
     */
    public function createTemplate(): void
    {
        $templatePath = public_path('templates/members_import_template.xlsx');

        if (!is_dir(dirname($templatePath))) {
            mkdir(dirname($templatePath), 0755, true);
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 12],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'EA153D']],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000']
                ]
            ]
        ];

        $dataStyle = [
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'DDDDDD']
                ]
            ]
        ];

        foreach (range('A', 'R') as $column) {
            $sheet->getColumnDimension($column)->setWidth(20);
        }

        $headers = [
            'A1' => 'FIRST NAME', 'B1' => 'FAMILY NAME', 'C1' => 'MIDDLE NAME',
            'D1' => 'BIRTH DATE', 'E1' => 'BIRTH PLACE', 'F1' => 'SEX',
            'G1' => 'CIVIL STATUS', 'H1' => 'PERMANENT ADDRESS', 'I1' => 'TELEPHONE',
            'J1' => 'FAX', 'K1' => 'MOBILE NUMBER', 'L1' => 'EMAIL',
            'M1' => 'PRC REGISTRATION NUMBER', 'N1' => 'PRC DATE ISSUED', 'O1' => 'PRC VALID UNTIL', 'P1' => 'CURRENT CHAPTER', 'Q1' => 'PREVIOUS CHAPTER',
            'R1' => 'POSITION HELD'
        ];

        foreach ($headers as $cell => $header) {
            $sheet->setCellValue($cell, $header);
        }
        $sheet->getStyle('A1:R1')->applyFromArray($headerStyle);

        try {
            $configureValidation = function ($validation) {
                $validation->setType(DataValidation::TYPE_LIST);
                $validation->setErrorStyle(DataValidation::STYLE_STOP);
                $validation->setShowDropDown(true);
                $validation->setErrorTitle('Invalid value');
                $validation->setError('Please select from the dropdown');
            };

            // Gender Validation (reduced range)
            $sexValidation = $sheet->getDataValidation('F1:F1000');
            $configureValidation($sexValidation);
            $sexValidation->setFormula1('"Male,Female,Non-binary,Others"');

            // Civil Status Validation (reduced range)
            $civilStatusValidation = $sheet->getDataValidation('G1:G1000');
            $configureValidation($civilStatusValidation);
            $civilStatusValidation->setFormula1('"Single,Married,Divorced,Widowed"');

            // Date formatting (reduced range)
            $sheet->getStyle('D2:D1000')->getNumberFormat()->setFormatCode('yyyy-mm-dd');
            $sheet->getStyle('N2:N1000')->getNumberFormat()->setFormatCode('yyyy-mm-dd');
            $sheet->getStyle('O2:O1000')->getNumberFormat()->setFormatCode('yyyy-mm-dd');

        } catch (\Exception $e) {
            throw $e;
        }

        $sampleData = [
            'A2' => 'Juan', 'B2' => 'Dela Cruz', 'C2' => 'Masculino',
            'D2' => '2000-01-01', 'E2' => 'Ubay, Bohol', 'F2' => 'Male',
            'G2' => 'Married', 'H2' => 'Province/Municipality/Baranggay/HouseNo.',
            'I2' => '0XX-XXX-YYYY 02-XXXX-YYYY', 'J2' => '+1 (800) 555-1212', 'K2' => '01234567889',
            'L2' => 'xxxxxxxx@gmail.com', 'M2' => 'PRC-1234567-MED', 'N2' => '2000-01-01',
            'O2' => '2000-01-01', 'P2' => 'Bonifacio Chapter', 'Q2' => 'Caloocan Chapter', 'R2' => 'President'
        ];

        foreach ($sampleData as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }
        $sheet->getStyle('A2:R2')->applyFromArray($dataStyle);


        $sheet->freezePane('A2');
        $sheet->setAutoFilter('A1:R1');
        $writer = new Xlsx($spreadsheet);
        try {
            $writer->save($templatePath);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function import(): void
    {
        $this->validate([
            'importFile' => 'required|mimes:xlsx,xls,csv|max:10240',
        ]);

        try {
            $import = new MembersImport();
            Excel::import($import, $this->importFile);

            $this->importResults = [
                'successful' => $import->getRowCount(),
                'duplicates' => $import->getDuplicatesSkippedCount(),
                'errors' => $import->getErrors(),
            ];

            session()->flash('message', 'Import completed successfully!');
        } catch (\Exception $e) {
            $this->importResults = [
                'successful' => $import ? $import->getRowCount() : 0,
                'duplicates' => $import ? $import->getDuplicatesSkippedCount() : 0,
                'errors' => array_merge($import ? $import->getErrors() : []), ['General import error: ' . $e->getMessage()],
            ];
            session()->flash('error', 'Import failed with errors. See details below.');
        }

        // Keep modal open to show results
        $this->importFile = null;
    }

    public function resetForm(): void
    {
        $this->first_name = '';
        $this->middle_name = '';
        $this->family_name = '';
        $this->prc_registration_number = '';
        $this->email = '';
        $this->mobile = '';
        $this->status = '';
        $this->current_chapter = '';
        $this->date_added = now()->format('Y-m-d H:i:s');
        $this->member_id = null;
        $this->resetValidation();
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    /**
     * @param $id
     * @return void
     */
    public function extracted($id): void
    {
        $member = User::findOrFail($id);
        $this->member_id = $member->id;
        $this->first_name = $member->first_name;
        $this->middle_name = $member->middle_name;
        $this->family_name = $member->family_name;
        $this->prc_registration_number = $member->prc_registration_number;
        $this->email = $member->email;
        $this->mobile = $member->mobile;
        $this->status = $member->status;
        $this->current_chapter = $member->current_chapter;
        $this->date_added = $member->created_at->format('Y-m-d H:i:s');
        $this->updated_at = $member->updated_at->format('Y-m-d H:i:s');
    }
}
