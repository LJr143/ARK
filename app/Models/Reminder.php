<?php
// app/Models/Reminder.php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'reminder_id',
        'title',
        'start_datetime',
        'end_datetime',
        'location',
        'recipient_type',
        'status',
        'description',
        'category_id',
        'period_from',
        'period_to',
        'notification_methods'
    ];

    protected $casts = [
        'start_datetime' => 'datetime',
        'end_datetime' => 'datetime',
        'notification_methods' => 'array',
    ];

    public function recipients(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function customRecipients(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'reminder_recipients', 'reminder_id', 'user_id');
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ReminderCategory::class);
    }
    public function attachments()
    {
        return $this->hasMany(ReminderAttachment::class);
    }

    public function getFormattedDateAttribute()
    {
        return $this->start_datetime->format('F j, Y');
    }

    public function getFormattedTimeAttribute()
    {
        if (!$this->end_datetime) {
            return null;
        }
        return $this->start_datetime->format('h:i A') . ' - ' . $this->end_datetime->format('h:i A');
    }

    public function getRecipientsTextAttribute()
    {
        return $this->recipient_type === 'public'
            ? 'Public — Sent to all'
            : 'Custom Recipients';
    }

    public function getFormattedDateTimeAttribute(): string
    {
        $start = Carbon::parse($this->start_datetime);
        $end = Carbon::parse($this->end_datetime);

        if ($start->isSameDay($end)) {
            return $start->format('M d, Y • h:i A') . ' - ' . $end->format('h:i A');
        }

        return $start->format('M d, Y • h:i A') . ' - ' . $end->format('M d, Y • h:i A');
    }
}
