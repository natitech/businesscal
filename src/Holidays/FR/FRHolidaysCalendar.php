<?php

namespace Poolpi\Businesscal\Holidays\FR;

use Poolpi\Businesscal\Holidays\HolidaysCalendar;

class FRHolidaysCalendar implements HolidaysCalendar
{
    const MAX_PHP_EASTER_YEAR = 2037;

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

    private function addDynamicHolidays()
    {
        $this->addHoliday($this->getLundiPaques());
        $this->addHoliday($this->getAscension());
        $this->addHoliday($this->getLundiPentecote());
    }

    private function addDatesWithMap(array $monthDaysMap)
    {
        foreach ($monthDaysMap as $month => $days) {
            foreach ((array)$days as $day) {
                $this->addHoliday($this->makeDateForYear($month, $day));
            }
        }
    }

    private function getFixedHolidaysMonthDaysMap()
    {
        return [
            1  => [1],
            5  => [1, 8],
            7  => [14],
            8  => [15],
            11 => [1, 11],
            12 => [25]
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

    private function addHoliday($date)
    {
        if ($date) {
            $this->holidays[] = $date;
        }
    }

    private function getDateAfterEaster($nbDaysAfterEaster)
    {
        return $this->getEasterDate()->add(new \DateInterval('P' . $nbDaysAfterEaster . 'D'));
    }

    private function getEasterDate()
    {
        return \DateTime::createFromFormat('U', easter_date($this->year));
    }

    private function makeDateForYear($month, $day)
    {
        return \DateTime::createFromFormat('Y-m-d', sprintf('%s-%s-%s', $this->year, $month, $day));
    }

    private function guardYear()
    {
        if ($this->year > self::MAX_PHP_EASTER_YEAR) {
            throw new \InvalidArgumentException('Easter date not found');
        }
    }
}
