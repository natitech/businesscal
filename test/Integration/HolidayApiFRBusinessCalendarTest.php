<?php

namespace Nati\Businesscal\Test\Integration;

use HolidayAPI\Client;
use Nati\Businesscal\BusinessCalendar;
use Nati\Businesscal\Holidays\Calendar\HolidayApiCalendar;

class HolidayApiFRBusinessCalendarTest extends FRBusinessCalendarTest
{
    private string $apiKey = '150cc546-b50d-4afc-b681-d2f8d3963239';

    /**
     * @test
     */
    public function canTouchApi()
    {
        $this->setApiKey($this->apiKey);

        $this->add('2021/04/01', 10);

        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function whenHolidayApiFailsThenThrowException()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->setApiKey('150cc546-b50d-4afc-b681-d2f8d3961234');

        $this->add('2021/04/01', 20);
    }

    private function setApiKey($key)
    {
        $this->apiKey = $key;
        $this->prepareCalendar();
    }

    protected function getCalendar(): BusinessCalendar
    {
        return new BusinessCalendar((new HolidayApiCalendar(new Client(['key' => $this->apiKey])))->forCountry('FR'));
    }
}
