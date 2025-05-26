<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReminderAttachment extends Model
{
    protected $fillable = ['reminder_id', 'original_name', 'path', 'mime_type', 'size'];

}
