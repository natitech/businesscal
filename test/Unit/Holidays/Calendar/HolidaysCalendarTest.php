<?php

namespace Nati\Businesscal\Test\Unit\Holidays\Calendar;

use Nati\Businesscal\Holidays\HolidaysCalendar;
use PHPUnit\Framework\TestCase;

abstract class HolidaysCalendarTest extends TestCase
{
    protected function assertHasNotHoliday($date)
    {
        $this->assertFalse($this->isDateInHolidays($date));
    }

    protected function assertHasHoliday($date)
    {
        $this->assertTrue($this->isDateInHolidays($date));
    }

    private function isDateInHolidays($date): bool
    {
        foreach ($this->getHolidays() as $holiday) {
            if ($date === $holiday->date->format('Y/m/d')) {
                return true;
            }
        }

        return false;
    }

    private function getHolidays(): array
    {
        return $this->getCalendar()->getHolidays(2017);
    }

    abstract protected function getCalendar(): HolidaysCalendar;
}
