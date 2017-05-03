<?php

namespace Poolpi\Businesscal\Holidays;

interface HolidaysCalendar
{
    /**
     * @param int $year
     *
     * @return Holiday[]
     *
     * @throws \InvalidArgumentException
     */
    public function getHolidays($year);
}
