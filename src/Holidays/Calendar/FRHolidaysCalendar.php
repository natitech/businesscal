<?php

namespace Nati\Businesscal\Holidays\Calendar;

use Nati\Businesscal\CalendarHelper;
use Nati\Businesscal\ChristianCalendar;
use Nati\Businesscal\Holidays\Holiday;

class FRHolidaysCalendar extends PredictableHolidaysCalendar
{
    protected ChristianCalendar $christian;

    public function __construct()
    {
        $this->christian = new ChristianCalendar();
    }

    protected function getFixedHolidaysMonthDaysMap(): array
    {
        return [
            1  => [1 => 'Jour de l\'an'],
            5  => [1 => 'Fête du travail', 8 => 'Victoire 1945'],
            7  => [14 => 'Fête nationale'],
            8  => [15 => 'Assomption'],
            11 => [1 => 'Toussaint', 11 => 'Armistice 1918'],
            12 => [25 => 'Noël']
        ];
    }

    protected function getDynamicHolidays(int $year): array
    {
        return [
            Holiday::create($this->christian->getEasterMonday($year), 'Lundi de Pâques'),
            Holiday::create($this->christian->getAscensionDay($year), 'Ascension'),
            Holiday::create($this->christian->getPentecostMonday($year), 'Lundi de Pentecôte')
        ];
    }
}
