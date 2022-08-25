<?php

namespace Nati\Businesscal\Holidays\Calendar;

use Nati\Businesscal\CalendarHelper;
use Nati\Businesscal\Holidays\Holiday;

class SolidarityFRHolidaysCalendar extends FRHolidaysCalendar
{
    public function getHolidays(int $year): array
    {
        return $this->removeHolidayByDate(parent::getHolidays($year), $this->christian->getPentecostMonday());
    }

    private function removeHolidayByDate(array $holidays, \DateTimeImmutable $date): array
    {
        return array_values(
            array_filter($holidays, fn(Holiday $holiday) => !CalendarHelper::onSameDay($holiday->date, $date))
        );
    }
}
