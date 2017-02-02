<?php

namespace Poolpi\Businesscal\Test\Unit\Holidays\FR;

use Poolpi\Businesscal\Holidays\FR\SolidarityFRHolidaysCalendar;

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
