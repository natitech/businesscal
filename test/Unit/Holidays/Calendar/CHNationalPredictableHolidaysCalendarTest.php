<?php

namespace Nati\Businesscal\Test\Unit\Holidays\Calendar;

use Nati\Businesscal\Holidays\Calendar\CHNationalHolidaysCalendar;
use Nati\Businesscal\Holidays\HolidaysCalendar;

class CHNationalPredictableHolidaysCalendarTest extends PredictableHolidaysCalendar
{
    public static function expected2017Holidays(): array
    {
        return [
            'Jour de l\'an'  => ['01/01'],
            'Fête nationale' => ['08/01'],
            'Noël'           => ['12/25'],
            'Vendredi Saint' => ['04/14'],
            'Ascension'      => ['05/25']
        ];
    }

    protected function getCalendar(): HolidaysCalendar
    {
        return new CHNationalHolidaysCalendar();
    }
}
