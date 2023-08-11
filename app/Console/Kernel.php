<?php

namespace App\Console;

use App\Console\Commands\ClearCacheCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        ClearCacheCommand::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('clear:cache')->daily();
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
