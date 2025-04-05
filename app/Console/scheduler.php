<?php

use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Schedule;

return function (Schedule $schedule) {
    $schedule->command('fetch:random-users')->everyFiveMinutes();
};
