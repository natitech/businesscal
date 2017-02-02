<?php

namespace Poolpi\Businesscal\Holidays\HolidayApi;

use Poolpi\Businesscal\Holidays\HolidaysCalendar;

class HolidayApiCalendar implements HolidaysCalendar
{
    private $api;

    private $holidays;

    public function __construct(HolidayApiWrapper $api)
    {
        $this->api = $api;
    }

    public function getHolidays($year)
    {
        $apiResponse = $this->getApiResponse($year);

        $this->holidays = [];
        foreach ((array)$apiResponse['holidays'] as $holidayStructure) {
            $this->addHoliday($holidayStructure[0]);
        }

        return $this->holidays;
    }

    private function getApiResponse($year)
    {
        return $this->guardResponse($this->api->holidays(['year' => $year]));
    }

    private function addHoliday($holidayStructure)
    {
        if ($this->extractField($holidayStructure, 'public')
            && ($date = $this->makeDate($this->extractField($holidayStructure, 'date')))
        ) {
            $this->holidays[] = $date;
        }
    }

    private function guardResponse($apiResponse)
    {
        $this->guardStatus($apiResponse);
        $this->guardStructure($apiResponse);

        return $apiResponse;
    }

    private function makeDate($apiDate)
    {
        if (!$apiDate) {
            return null;
        }

        return \DateTime::createFromFormat('Y-m-d H:i:s', $apiDate . ' 00:00:00');
    }

    private function guardStatus($apiResponse)
    {
        if ((int)$apiResponse['status'] !== 200) {
            throw $this->createApiErrorException($apiResponse);
        }
    }

    private function guardStructure($apiResponse)
    {
        if (!array_key_exists('holidays', $apiResponse)) {
            throw $this->createApiErrorException($apiResponse);
        }
    }

    private function extractField($structure, $field, $default = null)
    {
        return array_key_exists($field, $structure) ? $structure[$field] : $default;
    }

    private function createApiErrorException($apiResponse)
    {
        return new \InvalidArgumentException($this->extractField($apiResponse, 'error'));
    }
}
