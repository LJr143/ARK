<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\App;
use App\Services\FiscalYearService;
use App\Models\FiscalYear;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


