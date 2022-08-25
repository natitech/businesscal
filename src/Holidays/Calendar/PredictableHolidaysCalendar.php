<?php

namespace Nati\Businesscal\Holidays\Calendar;

use Nati\Businesscal\CalendarHelper;
use Nati\Businesscal\Holidays\Holiday;
use Nati\Businesscal\Holidays\HolidaysCalendar;

abstract class PredictableHolidaysCalendar implements HolidaysCalendar
{
    public function getHolidays(int $year): array
    {
        return array_merge($this->getFixedHolidays($year), $this->getDynamicHolidays($year));
    }

    private function getFixedHolidays(int $year): array
    {
        $holidays = [];

        foreach ($this->getFixedHolidaysMonthDaysMap() as $month => $days) {
            foreach ($days as $day => $label) {
                $holidays[] = Holiday::create(CalendarHelper::makeDate($year, $month, $day), $label);
            }
        }

        return $holidays;
    }

    abstract protected function getDynamicHolidays(int $year): array;
    abstract protected function getFixedHolidaysMonthDaysMap(): array;
}
