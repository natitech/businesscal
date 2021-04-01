<?php

namespace Nati\Businesscal\Test\Unit\Holidays\Calendar;

use Nati\Businesscal\Holidays\Calendar\FRHolidaysCalendar;
use Nati\Businesscal\Holidays\HolidaysCalendar;
use PHPUnit\Framework\TestCase;

class FRHolidaysCalendarTest extends TestCase
{
    protected HolidaysCalendar $calendar;

    protected function setUp(): void
    {
        $this->calendar = new FRHolidaysCalendar();
    }

    /**
     * @test
     */
    public function whenNotHolidayThenDontReturnIt()
    {
        $this->assertHasNotHoliday('2017/01/02');
    }

    /**
     * @test
     */
    public function canReturnFixedHoliday()
    {
        $this->assertHasHoliday('2017/01/01');
        $this->assertHasHoliday('2017/12/25');
    }

    /**
     * @test
     */
    public function canReturnLundiPaques()
    {
        $this->assertHasHoliday('2017/04/17');
    }

    /**
     * @test
     */
    public function canReturnAscension()
    {
        $this->assertHasHoliday('2017/05/25');
    }

    /**
     * @test
     */
    public function canReturnLundiPentecote()
    {
        $this->assertHasHoliday('2017/06/05');
    }

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
        return $this->calendar->getHolidays(2017);
    }
}
