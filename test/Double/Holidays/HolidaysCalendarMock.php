<?php

namespace Poolpi\Businesscal\Double\Holidays;

use Poolpi\Businesscal\Holidays\HolidaysCalendar;

class HolidaysCalendarMock implements HolidaysCalendar
{
    private $holidays = [];

    public function getHolidays($year)
    {
        return $this->holidays;
    }

    public function setHolidays(array $holidays)
    {
        $this->holidays = $holidays;

        return $this;
    }
}
