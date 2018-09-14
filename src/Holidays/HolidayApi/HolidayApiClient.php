<?php

namespace Nati\Businesscal\Holidays\HolidayApi;

use HolidayAPI\v1;

class HolidayApiClient extends v1 implements HolidayApiWrapper
{
    public function setCountryCode($countryCode)
    {
        $this->__set('country', $countryCode);

        return $this;
    }
}
