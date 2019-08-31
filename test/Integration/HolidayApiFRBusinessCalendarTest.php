<?php

namespace Nati\Businesscal\Test\Integration;

use Nati\Businesscal\BusinessCalendar;
use Nati\Businesscal\Holidays\HolidayApi\HolidayApiCalendar;
use Nati\Businesscal\Holidays\HolidayApi\HolidayApiClient;

class HolidayApiFRBusinessCalendarTest extends FRBusinessCalendarTest
{
    private $apiKey = '150cc546-b50d-4afc-b681-d2f8d3963239';

    /**
     * @test
     * @group slow
     */
    public function canTouchApi()
    {
        $this->setApiKey($this->apiKey);

        $this->add('2018/08/15', 10);

        $this->assertTrue(true);
    }

    /**
     * @test
     * @group slow
     */
    public function whenHolidayApiFailsThenThrowException()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->setApiKey('fail');

        $this->add('2018/08/15', 20);
    }

    private function setApiKey($key)
    {
        $this->apiKey = $key;
        $this->prepareCalendar();
    }

    protected function getCalendar()
    {
        return new BusinessCalendar(
            new HolidayApiCalendar((new HolidayApiClient($this->apiKey))->setCountryCode('FR'))
        );
    }
}
