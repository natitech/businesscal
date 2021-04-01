<?php

namespace Nati\Businesscal\Test\Unit\Holidays\Calendar;

use Nati\Businesscal\Holidays\Calendar\SolidarityFRHolidaysCalendar;

class SolidarityFRHolidaysCalendarTest extends FRHolidaysCalendarTest
{
    protected function setUp(): void
    {
        $this->calendar = new SolidarityFRHolidaysCalendar();
    }

    /**
     * @test
     */
    public function canReturnLundiPentecote()
    {
        $this->assertHasNotHoliday('2017/06/05');
    }
}
