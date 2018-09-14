<?php

namespace Nati\Businesscal\Holidays\HolidayApi;

interface HolidayApiWrapper
{
    public function holidays($parameters = []);

    public function setCountryCode($countryCode);
}
