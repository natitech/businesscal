<?php

namespace Nati\Businesscal\Holidays\Calendar;

use Nati\Businesscal\Holidays\Holiday;

class PFHolidaysCalendar extends FRHolidaysCalendar
{
    protected function getFixedHolidaysMonthDaysMap(): array
    {
        $map = parent::getFixedHolidaysMonthDaysMap();

        $map[3][5]  = 'Arrivée de l\'Evangile';
        $map[6][29] = 'Fête de l\'autonomie';

        return $map;
    }

    protected function getDynamicHolidays(int $year): array
    {
        return array_merge(
            parent::getDynamicHolidays($year),
            [Holiday::create($this->christian->getEasterFriday($year), 'Vendredi Saint')]
        );
    }
}
