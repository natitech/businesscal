<?php

namespace Nati\Businesscal\Test\Unit\Holidays\Calendar;

use Nati\Businesscal\Holidays\Calendar\SolidarityFRHolidaysCalendar;
use Nati\Businesscal\Holidays\HolidaysCalendar;

final class SolidarityFRHolidaysCalendarTest extends PredictableHolidaysCalendar
{
    public static function expected2017Holidays(): array
    {
        return [
            'Jour de l\'an'   => ['01/01'],
            'Lundi Pâques'    => ['04/17'],
            'Fête du travail' => ['05/01'],
            'Armistice'       => ['05/08'],
            'Fête nationale'  => ['07/14'],
            'Noël'            => ['12/25'],
            'Ascension'       => ['05/25']
        ];
    }

    public static function expected2017Workingdays(): array
    {
        return array_merge(parent::expected2017Workingdays(), ['Lundi Pentecôte' => ['06/05']]);
    }

    protected function getCalendar(): HolidaysCalendar
    {
        return new SolidarityFRHolidaysCalendar();
    }
}
