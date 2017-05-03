<?php

namespace Poolpi\Businesscal;

use Poolpi\Businesscal\Holidays\HolidaysCalendar;

class BusinessCalendar
{
    private $holidaysCalendar;

    /**
     * @var \Poolpi\Businesscal\Holidays\Holiday[][]
     */
    private $holidays = [];

    /**
     * @var \DateTime
     */
    private $newDate;

    private $nbBusinessDaysAdded;

    public function __construct(HolidaysCalendar $holidaysCalendar)
    {
        $this->holidaysCalendar = $holidaysCalendar;
    }

    public function addNbBusinessDaysTo(\DateTime $date, $nbBusinessDays)
    {
        $this->init($date, $nbBusinessDays);

        while ($this->nbBusinessDaysAdded < $nbBusinessDays) {
            $this->increment();
        }

        return $this->newDate;
    }

    public function isBusinessDay(\DateTime $date)
    {
        return !$this->isNewDateWeekEnd($date) && $this->findHolidayFor($date) === null;
    }

    public function whyIsHoliday(\DateTime $date)
    {
        return $this->guardHoliday($date)->label;
    }

    private function init(\DateTime $date, $nbBusinessDays)
    {
        $this->guardPositiveNbDays($nbBusinessDays);
        $this->newDate             = clone $date;
        $this->nbBusinessDaysAdded = 0;
        $this->holidays            = [];
    }

    private function increment()
    {
        $this->addOneDay();

        if ($this->isBusinessDay($this->newDate)) {
            $this->nbBusinessDaysAdded++;
        }
    }

    private function isNewDateWeekEnd(\DateTime $date)
    {
        $dayWeekIndex = (int)$date->format('N');

        return $dayWeekIndex === 6 || $dayWeekIndex === 7;
    }

    private function guardHoliday(\DateTime $date)
    {
        if (!($holiday = $this->findHolidayFor($date))) {
            throw new \InvalidArgumentException('Not a holiday');
        }

        return $holiday;
    }

    private function findHolidayFor(\DateTime $date)
    {
        $holidays = $this->getHolidays($date);

        foreach ($holidays as $holiday) {
            if ($this->areTheSameDay($date, $holiday->date)) {
                return $holiday;
            }
        }

        return null;
    }

    private function guardPositiveNbDays($nbBusinessDays)
    {
        if ($nbBusinessDays < 0) {
            throw new \InvalidArgumentException();
        }
    }

    private function getHolidays(\DateTime $date)
    {
        return $this->touchYearHolidays((int)$date->format('Y'));
    }

    private function touchYearHolidays($year)
    {
        if (!array_key_exists($year, $this->holidays)) {
            $this->prepareYearHolidays($year);
        }

        return $this->holidays[$year];
    }

    private function prepareYearHolidays($year)
    {
        $this->holidays[$year] = $this->holidaysCalendar->getHolidays($year);
    }

    private function areTheSameDay(\DateTime $date1, \DateTime $date2)
    {
        return $date1->format('Y m d') === $date2->format('Y m d');
    }

    private function addOneDay()
    {
        return $this->newDate->add(new \DateInterval('P1D'));
    }
}
