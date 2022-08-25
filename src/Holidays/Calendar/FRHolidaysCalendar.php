<?php

namespace Nati\Businesscal\Holidays\Calendar;

use Nati\Businesscal\ChristianCalendar;
use Nati\Businesscal\Holidays\Holiday;
use Nati\Businesscal\Holidays\HolidaysCalendar;

final class FRHolidaysCalendar implements HolidaysCalendar
{
    private ChristianCalendar $christian;

    public function __construct()
    {
        $this->christian = new ChristianCalendar();
    }

    public function getHolidays(int $year): array
    {
        return array_merge(Holiday::createFromSimpleMap($year, $this->getStaticSimpleMap()), $this->getDynamic($year));
    }

    private function getStaticSimpleMap(): array
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

    private function getDynamic(int $year): array
    {
        return [
            Holiday::create($this->christian->getEasterMonday($year), 'Lundi de Pâques'),
            Holiday::create($this->christian->getAscensionDay($year), 'Ascension'),
            Holiday::create($this->christian->getPentecostMonday($year), 'Lundi de Pentecôte')
        ];
    }
}
