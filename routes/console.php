<?php

use Illuminate\Support\Facades\Schedule;
use Illuminate\Foundation\Console\ClosureCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    /** @var ClosureCommand $this */
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

//Schedule::command('app:paymentMethodsCommand')->everyFiveMinutes();
//Schedule::command('app:CalculatorDataCommand')->everyFiveMinutes();
//Schedule::command('app:CourseCommand')->everyFiveMinutes();
