<?php

namespace Database\Seeders;

use App\Models\ReminderCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReminderCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ReminderCategory::create([
            'name' => 'Event'
        ]);
        ReminderCategory::create([
            'name' => 'Schedule'
        ]);
        ReminderCategory::create([
            'name' => 'Deadline'
        ]);
        ReminderCategory::create([
            'name' => 'Update'
        ]);
    }
}
