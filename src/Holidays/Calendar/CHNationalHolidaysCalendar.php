<?php

namespace Nati\Businesscal\Holidays\Calendar;

use Nati\Businesscal\ChristianCalendar;
use Nati\Businesscal\Holidays\Holiday;
use Nati\Businesscal\Holidays\HolidaysCalendar;

final class CHNationalHolidaysCalendar implements HolidaysCalendar
{
    private ChristianCalendar $christian;

    public function __construct()
    {
        $this->christian = new ChristianCalendar();
    }

    public function getHolidays(int $year): array
    {
        return array_merge(
            Holiday::createFromSimpleMap($year, $this->getFixedHolidaysMonthDaysMap()),
            $this->getDynamicHolidays($year)
        );
    }

    private function getFixedHolidaysMonthDaysMap(): array
    {
        return [
            1  => [1 => 'Jour de l\'an'],
            8  => [1 => 'Fête nationale'],
            12 => [25 => 'Noël']
        ];
    }

    private function getDynamicHolidays(int $year): array
    {
        return [
            Holiday::create($this->christian->getEasterFriday($year), 'Vendredi Saint'),
            Holiday::create($this->christian->getAscensionDay($year), 'Ascension')
        ];
    }
}
