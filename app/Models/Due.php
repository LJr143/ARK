<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Due extends Model
{
    protected $fillable = [
        'member_id',
        'fiscal_year_id',
        'amount',
        'penalty_amount',
        'payment_date',
        'due_date',
        'status',
        'transaction_reference',
        'notes'
    ];

    protected $casts = [
        'payment_date' => 'date',
        'due_date' => 'date',
        'amount' => 'decimal:2',
        'penalty_amount' => 'decimal:2'
    ];

    public function member(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function fiscalYear(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(FiscalYear::class);
    }


    public function getTotalAmountAttribute(): float
    {
        return $this->amount + $this->penalty_amount;
    }

    public function calculatePenalty(): float
    {
        if ($this->payment_date || now() <= $this->due_date) {
            return 0;
        }

        return $this->fiscalYear->calculatePenalty();
    }

    public function recordPayment($amount, $reference, $notes = null)
    {
        $this->penalty_amount = $this->calculatePenalty();
        $totalDue = $this->total_amount;

        if ($amount >= $totalDue) {
            $this->status = 'paid';
        } elseif ($amount > 0) {
            $this->status = 'partial';
        }

        $this->payment_date = now();
        $this->transaction_reference = $reference;
        $this->notes = $notes;
        $this->save();

        return $this;
    }
}
