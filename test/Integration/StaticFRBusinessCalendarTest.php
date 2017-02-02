<?php

namespace Poolpi\Businesscal\Test\Integration;

use Poolpi\Businesscal\BusinessCalendar;
use Poolpi\Businesscal\Holidays\FR\FRHolidaysCalendar;

class StaticFRBusinessCalendarTest extends FRBusinessCalendarTest
{
    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function whenYearIsBeyondPHPThenThrowException()
    {
        $this->add('2036/01/01', 720);
    }

    protected function getCalendar()
    {
        return new BusinessCalendar(new FRHolidaysCalendar);
    }
}
