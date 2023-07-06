<?php

namespace Nati\Businesscal\Holidays\Calendar;

use Nati\Businesscal\ChristianCalendar;
use Nati\Businesscal\Holidays\Holiday;
use Nati\Businesscal\Holidays\HolidaysCalendar;

/**
 * "SolidarityFR" is defined by the removal of pentecost monday from FR
 */
final class SolidarityFRHolidaysCalendar implements HolidaysCalendar
{
    private readonly FRHolidaysCalendar $fr;

    private readonly ChristianCalendar $christian;

    public function __construct()
    {
        $this->fr        = new FRHolidaysCalendar();
        $this->christian = new ChristianCalendar();
    }

    public function getHolidays(int $year): array
    {
        return Holiday::removeHolidayByDate($this->fr->getHolidays($year), $this->christian->getPentecostMonday($year));
    }
}
