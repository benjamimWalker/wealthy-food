<?php

namespace App\Console;

use App\Jobs\UpdateProducts;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule
            ->job(new UpdateProducts)
            ->dailyAt('03:49')
            ->onFailure(function () {
                // config and use a custom logger
                Log::error('UpdateProducts job failed');
            })
            ->after(function () {
                Cache::rememberForever('last_run', fn () => now());
            });
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
