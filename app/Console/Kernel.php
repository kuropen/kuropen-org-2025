<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // WARNING: no less than 5 minute interval, due to the limitation of Railway

        // $schedule->command('inspire')->hourly();
        $schedule->command('document:load')->hourly();
        $schedule->command('document:check')->timezone('Asia/Tokyo')->dailyAt('2:30');
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
