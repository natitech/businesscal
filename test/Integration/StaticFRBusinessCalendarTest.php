<?php

namespace Nati\Businesscal\Test\Integration;

use Nati\Businesscal\BusinessCalendar;
use Nati\Businesscal\Holidays\Calendar\FRHolidaysCalendar;

class StaticFRBusinessCalendarTest extends FRBusinessCalendarTest
{
    /**
     * @test
     */
    public function canAddManyDays()
    {
        $this->assertNewDateIs('2016/11/09', '2014/01/01', 720);
    }

    protected function getCalendar(): BusinessCalendar
    {
        return new BusinessCalendar(new FRHolidaysCalendar());
    }
}
