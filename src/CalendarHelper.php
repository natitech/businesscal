<?php

namespace Nati\Businesscal;

final class CalendarHelper
{
    public static function onSameDay(\DateTimeImmutable $date1, \DateTimeImmutable $date2): bool
    {
        return $date1->format('Y-m-d') === $date2->format('Y-m-d');
    }

    public static function makeDate(int $year, int $month, int $day): \DateTimeImmutable
    {
        return \DateTimeImmutable::createFromFormat('Y-m-d', sprintf('%d-%d-%d', $year, $month, $day));
    }
}
