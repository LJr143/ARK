<?php

namespace App\Services;

use App\Exceptions\FiscalYearOverlapException;
use App\Exceptions\NoActiveFiscalYearException;
use App\Models\ComputationRequest;
use App\Models\Due;
use App\Models\FiscalYear;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class FiscalYearService
{
    public function __construct(
        private FiscalYear $fiscalYearModel,
        private User $userModel,
        private Due $dueModel
    ) {}

    public function ensureCurrentFiscalYearExists(): FiscalYear
    {
        try {
            $current = $this->getCurrentFiscalYear();

            return $current ?? $this->activateMostRecentFiscalYear();
        } catch (NoActiveFiscalYearException $e) {
            return $this->createDefaultFiscalYear();
        }
    }

    protected function activateMostRecentFiscalYear(): FiscalYear
    {
        $latest = $this->fiscalYearModel->newQuery()
            ->orderBy('start_date', 'desc')
            ->first();

        if (!$latest) {
            throw new NoActiveFiscalYearException('No fiscal years exist in the system');
        }

        $this->activateFiscalYear($latest);
        return $latest;
    }

    protected function createDefaultFiscalYear(): FiscalYear
    {
        $currentYear = now()->year;
        $startDate = now()->month >= 7
            ? Carbon::create($currentYear, 7, 1)
            : Carbon::create($currentYear - 1, 7, 1);

        $endDate = $startDate->copy()->addYear()->subDay();

        $fiscalYear = $this->fiscalYearModel->create([
            'name' => 'FY ' . $startDate->format('Y') . '-' . $endDate->format('Y'),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'membership_fee' => config('dues.default_fee', 1000.00),
            'late_penalty_rate' => config('dues.default_penalty_rate', 5.0),
            'grace_period_days' => config('dues.default_grace_period', 30),
            'is_active' => true
        ]);

        Log::info('Created default fiscal year', ['id' => $fiscalYear->id]);

        $this->generateDuesForFiscalYear($fiscalYear);
        return $fiscalYear;
    }

    public function handleFiscalYearTransition(): void
    {
        try {
            $current = $this->ensureCurrentFiscalYearExists();

            if (now()->isSameDay($current->end_date)) {
                $this->transitionToNewFiscalYear($current);
            }
        } catch (\Exception $e) {
            Log::error('Fiscal year transition failed: ' . $e->getMessage(), [
                'exception' => $e
            ]);
            // TODO: NOTIFICATION ON FISCAL YEAR TRANSITION
        }
    }

    protected function transitionToNewFiscalYear(FiscalYear $current): void
    {
        $nextYear = $this->createNextFiscalYear($current);
        $this->activateFiscalYear($nextYear);
        $this->generateDuesForFiscalYear($nextYear);

        Log::info('Successfully transitioned to new fiscal year', [
            'old_year' => $current->name,
            'new_year' => $nextYear->name
        ]);
    }

    protected function createNextFiscalYear(FiscalYear $current): FiscalYear
    {
        $nextStart = $current->end_date->addDay();
        $nextEnd = $nextStart->copy()->addYear()->subDay();

        return $this->fiscalYearModel->create([
            'name' => 'FY ' . $nextStart->format('Y') . '-' . $nextEnd->format('Y'),
            'start_date' => $nextStart,
            'end_date' => $nextEnd,
            'membership_fee' => $current->membership_fee,
            'late_penalty_rate' => $current->late_penalty_rate,
            'grace_period_days' => $current->grace_period_days,
            'is_active' => false
        ]);
    }

    /**
     * @throws FiscalYearOverlapException
     */
    public function createFiscalYear(array $data): FiscalYear
    {
        $startDate = Carbon::parse($data['start_date']);
        $endDate = $startDate->copy()->addYear()->subDay();

        $this->validateNoOverlap($startDate, $endDate);

        return $this->fiscalYearModel->create([
            'name' => $data['name'] ?? 'FY ' . $startDate->format('Y') . '-' . $endDate->format('Y'),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'membership_fee' => $data['membership_fee'],
            'late_penalty_rate' => $data['late_penalty_rate'] ?? 0,
            'grace_period_days' => $data['grace_period_days'] ?? 30,
            'is_active' => $data['is_active'] ?? false
        ]);
    }

    protected function validateNoOverlap(Carbon $startDate, Carbon $endDate): void
    {
        $overlapping = $this->fiscalYearModel->newQuery()
            ->where(function($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhere(function($q) use ($startDate, $endDate) {
                        $q->where('start_date', '<', $startDate)
                            ->where('end_date', '>', $endDate);
                    });
            })
            ->exists();

        if ($overlapping) {
            throw new FiscalYearOverlapException('Fiscal year overlaps with existing period');
        }
    }

    public function activateFiscalYear(FiscalYear $fiscalYear): void
    {
        $this->fiscalYearModel->newQuery()->update(['is_active' => false]);
        $fiscalYear->update(['is_active' => true]);
    }

    public function generateDuesForFiscalYear(FiscalYear $fiscalYear): void
    {
        $this->userModel->each(function (User $member) use ($fiscalYear) {
            $this->dueModel->firstOrCreate(
                [
                    'member_id' => $member->id,
                    'fiscal_year_id' => $fiscalYear->id
                ],
                [
                    'amount' => $fiscalYear->membership_fee,
                    'due_date' => $fiscalYear->due_date,
                    'status' => 'unpaid'
                ]
            );
        });
    }

    public function generateComputation(?string $reference_number = null, ?int $member_id = null, bool $unpaidOnly = false): ?array
    {
        try {
            // Determine member_id based on input
            if ($reference_number) {
                $request = ComputationRequest::where('reference_number', $reference_number)->first();
                if (!$request) {
                    Log::warning('Computation request not found', ['reference_number' => $reference_number]);
                    return null;
                }
                $member_id = $request->member_id;
            } elseif (!$member_id) {
                Log::warning('No reference number or member ID provided for computation');
                return null;
            }

            // Validate member exists
            $member = $this->userModel->find($member_id);
            if (!$member) {
                Log::warning('Member not found', ['member_id' => $member_id]);
                return null;
            }

            // Get dues for the member, optionally filtering for unpaid only
            $query = $this->dueModel->where('member_id', $member_id)
                ->with(['fiscalYear' => function ($query) {
                    $query->select('id', 'name', 'start_date', 'end_date', 'membership_fee', 'late_penalty_rate', 'grace_period_days');
                }]);

            if ($unpaidOnly) {
                $query->where('status', 'unpaid');
            }

            $dues = $query->get();

            if ($dues->isEmpty()) {
                Log::info('No dues found for member', [
                    'member_id' => $member_id,
                    'unpaid_only' => $unpaidOnly,
                ]);
                return null;
            }

            // Compute dues details
            $computation = $dues->map(function (Due $due) {
                $amount = $due->amount;
                $penalty = $due->penalty_amount;
                $isPastFiscalYear = $due->fiscalYear->end_date->isPast();

                // Calculate penalty if due is unpaid and past grace period
                if ($due->status === 'unpaid' && $due->due_date) {
                    $gracePeriodEnd = $due->due_date->copy()->addDays($due->fiscalYear->grace_period_days);
                    if (Carbon::now()->gt($gracePeriodEnd)) {
                        $penalty = $amount * ($due->fiscalYear->late_penalty_rate / 100);
                    }
                }

                return [
                    'fiscal_year' => $due->fiscalYear->name,
                    'amount' => $amount,
                    'penalty' => $penalty,
                    'total' => $amount + $penalty,
                    'id' => $due->id,
                    'due_date' => $due->due_date?->format('Y-m-d'),
                    'status' => $due->status,
                    'is_past_fiscal_year' => $isPastFiscalYear,
                ];
            })->toArray();

            Log::info('Dues computation generated', [
                'reference_number' => $reference_number,
                'member_id' => $member_id,
                'dues_count' => $dues->count(),
                'unpaid_only' => $unpaidOnly,
            ]);

            return [
                'member_id' => $member_id,
                'dues' => $computation,
                'total_amount' => array_sum(array_column($computation, 'total')),
                'total_unpaid' => array_sum(array_column(
                    array_filter($computation, fn($due) => $due['status'] === 'unpaid'),
                    'total'
                )),
            ];
        } catch (\Exception $e) {
            Log::error('Failed to generate dues computation: ' . $e->getMessage(), [
                'reference_number' => $reference_number,
                'member_id' => $member_id,
                'exception' => $e,
            ]);
            throw $e;
        }
    }

    public function getCurrentFiscalYear(): ?FiscalYear
    {
        return $this->fiscalYearModel->current()->first();
    }
}
