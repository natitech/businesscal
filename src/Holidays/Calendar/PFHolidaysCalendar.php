<?php

namespace Nati\Businesscal\Holidays\Calendar;

use Nati\Businesscal\ChristianCalendar;
use Nati\Businesscal\Holidays\Holiday;
use Nati\Businesscal\Holidays\HolidaysCalendar;

/**
 * PF is the same as FR with some regional holidays
 */
final class PFHolidaysCalendar implements HolidaysCalendar
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
        return array_merge(
            $this->fr->getHolidays($year),
            Holiday::createFromSimpleMap($year, $this->getStaticRegional()),
            $this->getDynamicRegional($year)
        );
    }

    private function getStaticRegional(): array
    {
        return [
            3 => [5 => 'Arrivée de l\'Evangile'],
            6 => [29 => 'Fête de l\'autonomie']
        ];
    }

    private function getDynamicRegional(int $year): array
    {
        return [Holiday::create($this->christian->getEasterFriday($year), 'Vendredi Saint')];
    }
}
