<?php

namespace Nati\Businesscal\Test\Unit\Holidays\HolidayApi;

use PHPUnit\Framework\TestCase;
use Nati\Businesscal\Double\Holidays\HolidayApi\HolidayApiWrapperMock;
use Nati\Businesscal\Holidays\Holiday;
use Nati\Businesscal\Holidays\HolidayApi\HolidayApiCalendar;

class HolidayApiCalendarTest extends TestCase
{
    /**
     * @var HolidayApiCalendar
     */
    private $calendar;

    /**
     * @var HolidayApiWrapperMock
     */
    private $api;

    protected function setUp()
    {
        $this->api = new HolidayApiWrapperMock();

        $this->calendar = new HolidayApiCalendar($this->api);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function whenApiFailingThenThrowException()
    {
        $this->api->setIsFailing(true);

        $this->calendar->getHolidays(2017);
    }

    /**
     * @test
     */
    public function whenApiSuccesThenReturnPublicDates()
    {
        $this->assertEquals(
            [Holiday::create(new \DateTime('2015/07/04'), 'Independence Day')],
            $this->calendar->getHolidays(2017)
        );
    }
}
