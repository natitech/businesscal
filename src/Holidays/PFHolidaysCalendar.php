<?php

namespace Nati\Businesscal\Holidays;

class PFHolidaysCalendar extends FRHolidaysCalendar
{
    protected function getFixedHolidaysMonthDaysMap()
    {
        $map = parent::getFixedHolidaysMonthDaysMap();

        $map[3][5]  = 'Arrivée de l\'Evangile';
        $map[6][29] = 'Fête de l\'autonomie';

        return $map;
    }

    protected function addDynamicHolidays()
    {
        parent::addDynamicHolidays();

        $this->addHoliday($this->getVendrediSaint(), 'Vendredi Saint');
    }

    private function getVendrediSaint()
    {
        return $this->getDateAfterEaster(-2);
    }
}
