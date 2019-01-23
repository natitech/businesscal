<?php

namespace Nati\Businesscal\Holidays;

class FRHolidaysCalendar implements HolidaysCalendar
{
    private const MAX_PHP_EASTER_YEAR = 2037;

    private $year;

    private $holidays;

    public function getHolidays($year)
    {
        $this->init($year);
        $this->addFixedHolidays();
        $this->addDynamicHolidays();

        return $this->holidays;
    }

    private function init($year)
    {
        $this->year     = $year;
        $this->holidays = [];

        $this->guardYear();
    }

    private function addFixedHolidays()
    {
        $this->addDatesWithMap($this->getFixedHolidaysMonthDaysMap());
    }

    protected function addDynamicHolidays()
    {
        $this->addHoliday($this->getLundiPaques(), 'Lundi de Pâques');
        $this->addHoliday($this->getAscension(), 'Ascension');
        $this->addHoliday($this->getLundiPentecote(), 'Lundi de Pentecôte');
    }

    private function addDatesWithMap(array $monthDaysMap)
    {
        foreach ($monthDaysMap as $month => $days) {
            foreach ((array)$days as $day => $label) {
                $this->addHoliday($this->makeDateForYear($month, $day), $label);
            }
        }
    }

    protected function getFixedHolidaysMonthDaysMap()
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

    private function getLundiPaques()
    {
        return $this->getDateAfterEaster(1);
    }

    private function getAscension()
    {
        return $this->getDateAfterEaster(39);
    }

    protected function getLundiPentecote()
    {
        return $this->getDateAfterEaster(50);
    }

    protected function addHoliday($date, $label = null)
    {
        if ($date) {
            $this->holidays[] = Holiday::create($date, $label);
        }
    }

    protected function getDateAfterEaster($nbDaysAfterEaster)
    {
        $interval = new \DateInterval('P' . abs($nbDaysAfterEaster) . 'D');

        if ($nbDaysAfterEaster > 0) {
            return $this->getEasterDate()->add($interval);
        }

        return $this->getEasterDate()->sub($interval);
    }

    private function getEasterDate()
    {
        return \DateTimeImmutable::createFromFormat('U', easter_date($this->year));
    }

    private function makeDateForYear($month, $day)
    {
        return \DateTimeImmutable::createFromFormat('Y-m-d', sprintf('%s-%s-%s', $this->year, $month, $day));
    }

    private function guardYear()
    {
        if ($this->year > self::MAX_PHP_EASTER_YEAR) {
            throw new \InvalidArgumentException('Easter date not found');
        }
    }
}
