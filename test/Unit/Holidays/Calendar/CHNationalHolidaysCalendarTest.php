<?php

namespace Nati\Businesscal\Test\Unit\Holidays\Calendar;

use Nati\Businesscal\Holidays\Calendar\CHNationalHolidaysCalendar;
use Nati\Businesscal\Holidays\HolidaysCalendar;

class CHNationalHolidaysCalendarTest extends HolidaysCalendarTest
{
    protected function getCalendar(): HolidaysCalendar
    {
        return new CHNationalHolidaysCalendar();
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
        $this->assertHasHoliday('2017/08/01');
        $this->assertHasHoliday('2017/12/25');
    }

    /**
     * @test
     */
    public function canReturnVendrediSaint()
    {
        $this->assertHasHoliday('2017/04/14');
    }

    /**
     * @test
     */
    public function canReturnAscension()
    {
        $this->assertHasHoliday('2017/05/25');
    }
}
