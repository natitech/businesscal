<?php

namespace Nati\Businesscal\Test\Integration;

use Nati\Businesscal\BusinessCalendar;
use Nati\Businesscal\Holidays\FRHolidaysCalendar;

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
