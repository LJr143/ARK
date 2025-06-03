<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FiscalYear extends Model
{
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'membership_fee',
        'late_penalty_rate',
        'grace_period_days',
        'is_active'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'membership_fee' => 'decimal:2',
        'late_penalty_rate' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    // Relationships
    public function dues()
    {
        return $this->hasMany(Due::class, 'fiscal_year_id');
    }

    // Scopes
    public function scopeActive(Builder $query)
    {
        return $query->where('is_active', true);
    }

    public function scopeCurrent(Builder $query)
    {
        return $query->where('start_date', '<=', now())
            ->where('end_date', '>=', now());
    }

    // Attributes
    public function getIsCurrentAttribute(): bool
    {
        return $this->start_date <= now() && $this->end_date >= now();
    }

    public function getDueDateAttribute()
    {
        return $this->start_date->addDays($this->grace_period_days);
    }

    // Business logic
    public function calculatePenalty($paymentDate = null): float
    {
        $paymentDate = $paymentDate ?: now();

        if ($paymentDate <= $this->due_date) {
            return 0;
        }

        $daysLate = $paymentDate->diffInDays($this->due_date);
        return $this->membership_fee * ($this->late_penalty_rate / 100) * $daysLate;
    }

    public static function createNextFiscalYear(): FiscalYear
    {
        $current = self::current()->first();

        if (!$current) {
            throw new \Exception('No active fiscal year found');
        }

        $nextStart = $current->end_date->addDay();
        $nextEnd = $nextStart->copy()->addYear()->subDay();
        $nextName = 'FY ' . $nextStart->format('Y') . '-' . $nextEnd->format('Y');

        return self::create([
            'name' => $nextName,
            'start_date' => $nextStart,
            'end_date' => $nextEnd,
            'membership_fee' => $current->membership_fee,
            'late_penalty_rate' => $current->late_penalty_rate,
            'grace_period_days' => $current->grace_period_days,
            'is_active' => false
        ]);
    }
}
