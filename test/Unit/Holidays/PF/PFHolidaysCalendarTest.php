<?php

namespace Nati\Businesscal\Test\Unit\Holidays\FR;

use Nati\Businesscal\Holidays\PF\PFHolidaysCalendar;

class PFHolidaysCalendarTest extends FRHolidaysCalendarTest
{
    protected function setUp()
    {
        $this->calendar = new PFHolidaysCalendar();
    }

    /**
     * @test
     */
    public function canReturnPFFixedHoliday()
    {
        $this->assertHasHoliday('2017/03/05');
        $this->assertHasHoliday('2017/06/29');
    }

    /**
     * @test
     */
    public function canReturnVendrediSaint()
    {
        $this->assertHasHoliday('2017/04/14');
    }
}
