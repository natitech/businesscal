<?php

namespace Nati\Businesscal\Test\Unit\Holidays\Calendar;

use Nati\Businesscal\Holidays\Calendar\FRHolidaysCalendar;
use Nati\Businesscal\Holidays\HolidaysCalendar;
use PHPUnit\Framework\TestCase;

class FRHolidaysCalendarTest extends HolidaysCalendarTest
{
    protected function getCalendar(): HolidaysCalendar
    {
        return new FRHolidaysCalendar();
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
}
