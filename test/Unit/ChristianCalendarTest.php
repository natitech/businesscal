<?php

namespace Nati\Businesscal\Test\Unit;

use Nati\Businesscal\ChristianCalendar;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ChristianCalendarTest extends TestCase
{
    #[Test]
    public function canReturnEasterDateBasedHolidayWhateverTZ()
    {
        //The purpose of this test is to fix strange behavior of easter_date PHP function

        putenv('TZ=UTC');
        $this->assertEquals('18/05', (new ChristianCalendar())->getAscensionDay(2023)->format('d/m'));

        putenv('TZ=Europe/Paris');
        $this->assertEquals('18/05', (new ChristianCalendar())->getAscensionDay(2023)->format('d/m'));
    }

    #[Test]
    public function canReturnEasterDateBasedHolidayEvenInDistantFuture()
    {
        //The purpose of this test is to fix strange behavior of easter_date PHP function

        $this->assertEquals('18/05', (new ChristianCalendar())->getAscensionDay(2045)->format('d/m'));
    }
}
