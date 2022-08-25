<?php

namespace Nati\Businesscal\Test\Unit\Holidays\Calendar;

use Nati\Businesscal\Holidays\Calendar\SolidarityFRHolidaysCalendar;
use Nati\Businesscal\Holidays\HolidaysCalendar;

class SolidarityFRHolidaysCalendarTest extends FRHolidaysCalendarTest
{
    protected function getCalendar(): HolidaysCalendar
    {
        return new SolidarityFRHolidaysCalendar();
    }

    /**
     * @test
     */
    public function canReturnLundiPentecote()
    {
        $this->assertHasNotHoliday('2017/06/05');
    }
}
