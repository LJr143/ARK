<?php

namespace App\Console\Commands;

use App\Models\FiscalYear;
use App\Services\FiscalYearService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckFiscalYear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fiscal-year:check';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and transition to the next fiscal year if needed';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            $service = app(FiscalYearService::class);
            $service->handleFiscalYearTransition();
            $this->info('Fiscal year check completed successfully.');
        } catch (\Exception $e) {
            Log::error('Fiscal year check failed: ' . $e->getMessage(), ['exception' => $e]);
            $this->error('Failed to check fiscal year: ' . $e->getMessage());
        }
    }
}
