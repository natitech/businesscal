<?php

namespace Nati\Businesscal\Test\Integration;

use Nati\Businesscal\BusinessCalendar;
use Nati\Businesscal\Holidays\Calendar\FRHolidaysCalendar;
use PHPUnit\Framework\Attributes\Test;

final class StaticFRBusinessCalendarTest extends FRBusinessCalendar
{
    #[Test]
    public function canAddManyDays()
    {
        $this->assertNewDateIs('2016/11/09', '2014/01/01', 720);
    }

    protected function getCalendar(): BusinessCalendar
    {
        return new BusinessCalendar(new FRHolidaysCalendar());
    }
}
