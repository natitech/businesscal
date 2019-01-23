<?php

namespace Nati\Businesscal\Test\Double\Holidays\HolidayApi;

use Nati\Businesscal\Holidays\HolidayApi\HolidayApiWrapper;

class HolidayApiWrapperMock implements HolidayApiWrapper
{
    private $isFailing = false;

    public function holidays($parameters = [])
    {
        if ($this->isFailing) {
            return $this->getUnauthorizedResponse();
        }

        return $this->getSuccessfullResponse();
    }

    public function setCountryCode($countryCode)
    {
    }

    public function setIsFailing($isFailing)
    {
        $this->isFailing = (boolean)$isFailing;

        return $this;
    }

    private function getUnauthorizedResponse()
    {
        return ['status' => 401, 'error' => 'The API key parameter is required.'];
    }

    private function getSuccessfullResponse()
    {
        return [
            'status'   => 200,
            'holidays' => [
                [
                    [
                        'name'     => 'Independence Day',
                        'date'     => '2015-07-04',
                        'observed' => '2015-07-03',
                        'public'   => true
                    ]
                ],
                [
                    [
                        'name'     => 'Harry Potter Day',
                        'date'     => '2015-11-02',
                        'observed' => '2015-11-01',
                        'public'   => false
                    ]
                ]
            ]
        ];
    }
}
