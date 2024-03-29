<?php

namespace Nati\Businesscal\Test\Integration;

use HolidayAPI\Client;
use Nati\Businesscal\BusinessCalendar;
use Nati\Businesscal\Holidays\Calendar\HolidayApiCalendar;
use PHPUnit\Framework\Attributes\Test;

final class HolidayApiFRBusinessCalendarTest extends FRBusinessCalendar
{
    private string $apiKey = '150cc546-b50d-4afc-b681-d2f8d3963239';

    #[Test]
    public function canTouchApi()
    {
        $this->setApiKey($this->apiKey);

        $this->add($this->lastYearOn1stApril(), 20);

        $this->assertTrue(true);
    }

    #[Test]
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

    private function lastYearOn1stApril(): string
    {
        $currentYear = (int)(new \DateTimeImmutable())->format('Y');

        return ($currentYear - 1) . '/04/01';
    }
}
