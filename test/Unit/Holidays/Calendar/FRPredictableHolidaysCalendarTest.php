<?php

namespace Nati\Businesscal\Test\Unit\Holidays\Calendar;

use Nati\Businesscal\Holidays\Calendar\FRHolidaysCalendar;
use Nati\Businesscal\Holidays\HolidaysCalendar;

class FRPredictableHolidaysCalendarTest extends PredictableHolidaysCalendar
{
    public static function expected2017Holidays(): array
    {
        return [
            'Jour de l\'an'   => ['01/01'],
            'Lundi Pâques'    => ['04/17'],
            'Lundi Pentecôte' => ['06/05'],
            'Fête du travail' => ['05/01'],
            'Armistice'       => ['05/08'],
            'Fête nationale'  => ['07/14'],
            'Noël'            => ['12/25'],
            'Ascension'       => ['05/25']
        ];
    }

    protected function getCalendar(): HolidaysCalendar
    {
        return new FRHolidaysCalendar();
    }
}
