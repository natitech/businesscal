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
        $this->setApiKey('e8d12030-b6b3-4935-aa47-12b1adcdfb99');

        $this->add('2017/04/12', 10);

        $this->assertTrue(true);
    }

    /**
     * @test
     * @group slow
     * @expectedException \InvalidArgumentException
     */
    public function whenHolidayApiFailsThenThrowException()
    {
        $this->setApiKey('fail');

        $this->add('2012/01/01', 20);
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
