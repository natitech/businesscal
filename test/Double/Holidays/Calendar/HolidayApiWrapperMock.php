<?php

namespace Nati\Businesscal\Test\Double\Holidays\Calendar;

use HolidayAPI\Client;

class HolidayApiWrapperMock extends Client
{
    private bool $isFailing = false;

    public function __construct()
    {
    }

    public function holidays($request)
    {
        if ($this->isFailing) {
            throw new \Exception('Holiday api failure !');
        }

        return $this->getSuccessfullResponse();
    }

    public function setIsFailing($isFailing): self
    {
        $this->isFailing = (boolean)$isFailing;

        return $this;
    }

    private function getSuccessfullResponse(): array
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
