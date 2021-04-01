<?php

namespace Nati\Businesscal\Test\Unit\Holidays\Calendar;

use Nati\Businesscal\Holidays\Calendar\HolidayApiCalendar;
use Nati\Businesscal\Holidays\Holiday;
use Nati\Businesscal\Test\Double\Holidays\Calendar\HolidayApiWrapperMock;
use PHPUnit\Framework\TestCase;

class HolidayApiCalendarTest extends TestCase
{
    private HolidayApiCalendar $calendar;

    private HolidayApiWrapperMock $api;

    protected function setUp(): void
    {
        $this->api = new HolidayApiWrapperMock();

        $this->calendar = (new HolidayApiCalendar($this->api))->forCountry('FR');
    }

    /**
     * @test
     */
    public function whenApiFailingThenThrowException()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->api->setIsFailing(true);

        $this->calendar->getHolidays(2017);
    }

    /**
     * @test
     */
    public function whenApiSuccesThenReturnPublicDates()
    {
        $this->assertEquals(
            [Holiday::create(new \DateTimeImmutable('2015/07/04'), 'Independence Day')],
            $this->calendar->getHolidays(2017)
        );
    }
}
