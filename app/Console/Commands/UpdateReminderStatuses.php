<?php
// app/Console/Commands/UpdateReminderStatuses.php

namespace App\Console\Commands;

use App\Models\Reminder;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateReminderStatuses extends Command
{
    protected $signature = 'reminders:update-statuses';
    protected $description = 'Update reminder statuses based on their dates';

    public function handle()
    {
        $now = Carbon::now();

        Reminder::where('status', 'upcoming')
            ->where('start_datetime', '<=', $now)
            ->where('end_datetime', '>', $now)
            ->update(['status' => 'upcoming']);

        Reminder::where('status', '!=', 'ended')
            ->where('end_datetime', '<=', $now)
            ->update(['status' => 'ended']);

        Reminder::where('status', 'ended')
            ->where('start_datetime', '>', $now)
            ->update(['status' => 'upcoming']);

        $this->info('Reminder statuses updated successfully.');

        return 0;
    }
}
