<?php
namespace Database\Seeders;

use App\Models\Reminder;
use Illuminate\Database\Seeder;

class ReminderSeeder extends Seeder
{
    public function run()
    {
        Reminder::create([
            'title' => 'Board Members Meeting',
            'start_datetime' => '2025-05-30 10:00:00',
            'end_datetime' => '2025-05-30 12:00:00',
            'location' => 'Online',
            'recipient_type' => 'custom',
            'status' => 'upcoming'
        ]);

        Reminder::create([
            'title' => 'Brigada Eskwela 2025',
            'start_datetime' => '2025-07-14 13:30:00',
            'end_datetime' => '2025-07-14 16:00:00',
            'location' => 'Mandaluyong City',
            'recipient_type' => 'public',
            'status' => 'upcoming'
        ]);

        // Add more sample data as needed
    }
}
