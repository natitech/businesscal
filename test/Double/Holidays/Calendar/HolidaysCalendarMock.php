<?php

namespace Nati\Businesscal\Test\Double\Holidays\Calendar;

use Nati\Businesscal\Holidays\HolidaysCalendar;

final class HolidaysCalendarMock implements HolidaysCalendar
{
    private array $holidays = [];

    public function getHolidays($year): array
    {
        return $this->holidays;
    }

    public function setHolidays(array $holidays): self
    {
        $this->holidays = $holidays;

        return $this;
    }
}
