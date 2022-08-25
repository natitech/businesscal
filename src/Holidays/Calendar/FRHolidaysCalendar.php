<?php

namespace Nati\Businesscal\Holidays\Calendar;

use Nati\Businesscal\CalendarHelper;
use Nati\Businesscal\ChristianCalendar;
use Nati\Businesscal\Holidays\Holiday;
use Nati\Businesscal\Holidays\HolidaysCalendar;

class FRHolidaysCalendar implements HolidaysCalendar
{
    protected ChristianCalendar $christian;

    private array $holidays = [];

    public function __construct()
    {
        $this->christian = new ChristianCalendar();
    }

    public function getHolidays(int $year): array
    {
        $this->addFixedHolidays($year);
        $this->addDynamicHolidays($year);

        return $this->holidays;
    }

    private function addFixedHolidays(int $year)
    {
        $this->addDatesWithMap($year, $this->getFixedHolidaysMonthDaysMap());
    }

    protected function addDynamicHolidays(int $year)
    {
        $this->addHoliday($this->christian->getEasterMonday($year), 'Lundi de Pâques');
        $this->addHoliday($this->christian->getAscensionDay($year), 'Ascension');
        $this->addHoliday($this->christian->getPentecostMonday($year), 'Lundi de Pentecôte');
    }

    private function addDatesWithMap(int $year, array $monthDaysMap)
    {
        foreach ($monthDaysMap as $month => $days) {
            foreach ((array)$days as $day => $label) {
                $this->addHoliday(CalendarHelper::makeDate($year, $month, $day), $label);
            }
        }
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

    protected function addHoliday(\DateTimeImmutable $date, $label = null)
    {
        $this->holidays[] = Holiday::create($date, $label);
    }
}
