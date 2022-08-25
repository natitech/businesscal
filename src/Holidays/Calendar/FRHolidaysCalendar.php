<?php

namespace Nati\Businesscal\Holidays\Calendar;

use Nati\Businesscal\CalendarHelper;
use Nati\Businesscal\ChristianCalendar;
use Nati\Businesscal\Holidays\Holiday;
use Nati\Businesscal\Holidays\HolidaysCalendar;

class FRHolidaysCalendar implements HolidaysCalendar
{
    private int $year;

    protected ChristianCalendar $christian;

    private array $holidays;

    public function getHolidays(int $year): array
    {
        $this->init($year);
        $this->addFixedHolidays();
        $this->addDynamicHolidays();

        return $this->holidays;
    }

    private function init(int $year)
    {
        $this->year      = $year;
        $this->christian = new ChristianCalendar($year);
        $this->holidays  = [];
    }

    private function addFixedHolidays()
    {
        $this->addDatesWithMap($this->getFixedHolidaysMonthDaysMap());
    }

    protected function addDynamicHolidays()
    {
        $this->addHoliday($this->christian->getEasterMonday(), 'Lundi de Pâques');
        $this->addHoliday($this->christian->getAscensionDay(), 'Ascension');
        $this->addHoliday($this->christian->getPentecostMonday(), 'Lundi de Pentecôte');
    }

    private function addDatesWithMap(array $monthDaysMap)
    {
        foreach ($monthDaysMap as $month => $days) {
            foreach ((array)$days as $day => $label) {
                $this->addHoliday(CalendarHelper::makeDate($this->year, $month, $day), $label);
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
