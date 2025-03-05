<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // Run daily at midnight
        $schedule->command('shops:send-emails')->everyMinute();

        // Alternative scheduling options:
        // Run every hour: ->hourly();
        // Run at specific time: ->dailyAt('13:00');
        // Run every minute (for testing): ->everyMinute();
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }
}
