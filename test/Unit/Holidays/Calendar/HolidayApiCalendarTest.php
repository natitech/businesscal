<?php

namespace Nati\Businesscal\Test\Unit\Holidays\Calendar;

use Nati\Businesscal\Holidays\Calendar\HolidayApiCalendar;
use Nati\Businesscal\Holidays\Holiday;
use Nati\Businesscal\Test\Double\Holidays\Calendar\HolidayApiWrapperMock;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class HolidayApiCalendarTest extends TestCase
{
    private readonly HolidayApiCalendar $calendar;

    private readonly HolidayApiWrapperMock $api;

    protected function setUp(): void
    {
        $this->api = new HolidayApiWrapperMock();

        $this->calendar = (new HolidayApiCalendar($this->api))->forCountry('FR');
    }

    #[Test]
    public function whenApiFailingThenThrowException()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->api->setIsFailing(true);

        $this->calendar->getHolidays(2017);
    }

    #[Test]
    public function whenApiSuccesThenReturnPublicDates()
    {
        $this->assertEquals(
            [Holiday::create(new \DateTimeImmutable('2015/07/04'), 'Independence Day')],
            $this->calendar->getHolidays(2017)
        );
    }
}
