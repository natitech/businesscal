<?php

namespace Nati\Businesscal\Test\Unit\Holidays\FR;

use Nati\Businesscal\Holidays\FR\SolidarityFRHolidaysCalendar;

class SolidarityFRHolidaysCalendarTest extends FRHolidaysCalendarTest
{
    protected function setUp()
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
