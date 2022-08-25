<?php

namespace Nati\Businesscal\Holidays\Calendar;

class PFHolidaysCalendar extends FRHolidaysCalendar
{
    protected function getFixedHolidaysMonthDaysMap(): array
    {
        $map = parent::getFixedHolidaysMonthDaysMap();

        $map[3][5]  = 'Arrivée de l\'Evangile';
        $map[6][29] = 'Fête de l\'autonomie';

        return $map;
    }

    protected function addDynamicHolidays(int $year)
    {
        parent::addDynamicHolidays($year);

        $this->addHoliday($this->christian->getEasterFriday($year), 'Vendredi Saint');
    }
}
