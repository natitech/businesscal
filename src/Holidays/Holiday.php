<?php

namespace Nati\Businesscal\Holidays;

use Nati\Businesscal\CalendarHelper;

final class Holiday
{
    public readonly \DateTimeImmutable $date;

    public readonly ?string            $label;

    public static function create(\DateTimeImmutable $date, $label = null): self
    {
        $holiday        = new self;
        $holiday->date  = $date;
        $holiday->label = $label;

        return $holiday;
    }

    /**
     * As an example, if you want to make holiday on 1st and 8th of may, you would pass this "simpleMap" :
     * [5  => [1 => 'Fête du travail', 8 => 'Victoire 1945']]
     */
    public static function createFromSimpleMap(int $year, array $simpleMap): array
    {
        $holidays = [];
        foreach ($simpleMap as $month => $days) {
            foreach ($days as $day => $label) {
                $holidays[] = Holiday::create(CalendarHelper::makeDate($year, $month, $day), $label);
            }
        }

        return $holidays;
    }

    public static function removeHolidayByDate(array $holidays, \DateTimeImmutable $date): array
    {
        return array_values(
            array_filter($holidays, fn(Holiday $holiday) => !CalendarHelper::onSameDay($holiday->date, $date))
        );
    }
}
