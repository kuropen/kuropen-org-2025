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
        // WARNING: Railwayの制限のため、スケジュールは5分刻みとすること

        $schedule->command('misskey:health-check')->everyFiveMinutes();
        $schedule->command('misskey:check-blocked')->hourly();
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
