<?php

namespace Poolpi\Businesscal\Holidays;

interface HolidaysCalendar
{
    /**
     * @param int $year
     *
     * @return \DateTime[]
     *
     * @throws \InvalidArgumentException
     */
    public function getHolidays($year);
}
