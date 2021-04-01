<?php

namespace Nati\Businesscal\Holidays\Calendar;

use HolidayAPI\Client;
use Nati\Businesscal\Holidays\Holiday;
use Nati\Businesscal\Holidays\HolidaysCalendar;

class HolidayApiCalendar implements HolidaysCalendar
{
    private Client  $api;

    private array   $holidays;

    private ?string $country = null;

    public function __construct(Client $api)
    {
        $this->api = $api;
    }

    public function forCountry(string $countryCode): self
    {
        $this->country = $countryCode;

        return $this;
    }

    public function getHolidays(int $year): array
    {
        $apiResponse = $this->getApiResponse($year);

        $this->holidays = [];
        foreach ((array)$apiResponse['holidays'] as $holidayStructure) {
            if (isset($holidayStructure[0])) {
                $this->addHoliday($holidayStructure[0]);
            }
        }

        return $this->holidays;
    }

    private function getApiResponse($year)
    {
        if (!$this->country) {
            throw new \InvalidArgumentException('Country code required');
        }

        try {
            return $this->api->holidays(['year' => $year, 'country' => $this->country]);
        } catch (\Exception $e) {
            throw new \InvalidArgumentException('Error while fetching holidayapi', 0, $e);
        }
    }

    private function addHoliday($holidayStructure)
    {
        if ($this->extractField($holidayStructure, 'public')
            && ($date = $this->makeDate($this->extractField($holidayStructure, 'date')))
        ) {
            $this->holidays[] = Holiday::create($date, $this->extractField($holidayStructure, 'name'));
        }
    }

    private function makeDate($apiDate): ?\DateTimeImmutable
    {
        if (!$apiDate) {
            return null;
        }

        return \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $apiDate . ' 00:00:00');
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

    private function createApiErrorException($apiResponse): \InvalidArgumentException
    {
        return new \InvalidArgumentException($this->extractField($apiResponse, 'error'));
    }
}
