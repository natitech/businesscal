<?php

namespace Poolpi\Businesscal\Test\Unit\Holidays\FR;

use PHPUnit\Framework\TestCase;
use Poolpi\Businesscal\Holidays\FR\FRHolidaysCalendar;

class FRHolidaysCalendarTest extends TestCase
{
    /**
     * @var FRHolidaysCalendar
     */
    protected $calendar;

    protected function setUp()
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

    private function isDateInHolidays($date)
    {
        foreach ($this->getHolidays() as $holiday) {
            if ($date === $holiday->date->format('Y/m/d')) {
                return true;
            }
        }

        return false;
    }

    private function getHolidays()
    {
        return $this->calendar->getHolidays(2017);
    }
}
