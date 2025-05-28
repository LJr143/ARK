<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReminderRecipient extends Model
{
    protected $table = 'reminder_recipients';
    protected $fillable = ['reminder_id', 'user_id'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }
}
