<?php

namespace Nati\Businesscal\Test\Unit\Holidays\Calendar;

use Nati\Businesscal\Holidays\Calendar\PFHolidaysCalendar;
use Nati\Businesscal\Holidays\HolidaysCalendar;

class PFHolidaysCalendarTest extends FRHolidaysCalendarTest
{
    protected function getCalendar(): HolidaysCalendar
    {
        return new PFHolidaysCalendar();
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
