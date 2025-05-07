<?php

use Illuminate\Support\Facades\Schedule;
use Illuminate\Foundation\Console\ClosureCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    /** @var ClosureCommand $this */
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

 Schedule::command('app:paymentMethodsCommand')->daily();
 Schedule::command('app:CalculatorDataCommand')->daily();
 Schedule::command('app:CountriesDataCommand')->daily();
 Schedule::command('app:AvailabilityDataCommand')->daily();
 Schedule::command('app:CourseCommand')->daily();
 Schedule::command('app:PanelStatsCommand')->daily();
 Schedule::command('app:PriceDataCommand')->daily();
