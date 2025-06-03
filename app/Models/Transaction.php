<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_reference',
        'external_transaction_id',
        'payment_method',
        'amount',
        'currency',
        'status',
        'payment_details',
        'payer_id',
        'payer_email',
        'description',
        'return_url',
        'cancel_url',
        'completed_at'
    ];

    protected $casts = [
        'payment_details' => 'array',
        'amount' => 'decimal:2',
        'completed_at' => 'datetime'
    ];

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'transaction_id');
    }
}
