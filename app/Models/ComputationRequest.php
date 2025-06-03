<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComputationRequest extends Model
{
    protected $fillable = ['reference_number','member_id', 'message', 'status', 'catered_by'];


    public function member(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
