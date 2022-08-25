<?php

namespace Nati\Businesscal;

use Nati\Businesscal\Holidays\HolidaysCalendar;

final class BusinessCalendar
{
    private HolidaysCalendar $holidaysCalendar;

    /** @var \Nati\Businesscal\Holidays\Holiday[][] */
    private array              $holidays = [];

    private \DateTimeImmutable $newDate;

    private int                $nbBusinessDaysAdded;

    public function __construct(HolidaysCalendar $holidaysCalendar)
    {
        $this->holidaysCalendar = $holidaysCalendar;
    }

    public function addNbBusinessDaysTo(\DateTimeImmutable $date, int $nbBusinessDays): \DateTimeImmutable
    {
        $this->init($date, $nbBusinessDays);

        while ($this->nbBusinessDaysAdded < $nbBusinessDays) {
            $this->increment();
        }

        return $this->newDate;
    }

    public function isBusinessDay(\DateTimeImmutable $date): bool
    {
        return !$this->isNewDateWeekEnd($date) && $this->findHolidayFor($date) === null;
    }

    public function whyIsHoliday(\DateTimeImmutable $date): string
    {
        return $this->guardHoliday($date)->label;
    }

    private function init(\DateTimeImmutable $date, $nbBusinessDays)
    {
        $this->guardPositiveNbDays($nbBusinessDays);
        $this->newDate             = $date;
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

    private function isNewDateWeekEnd(\DateTimeImmutable $date): bool
    {
        $dayWeekIndex = (int)$date->format('N');

        return $dayWeekIndex === 6 || $dayWeekIndex === 7;
    }

    private function guardHoliday(\DateTimeImmutable $date): ?Holidays\Holiday
    {
        if (!($holiday = $this->findHolidayFor($date))) {
            throw new \InvalidArgumentException('Not a holiday');
        }

        return $holiday;
    }

    private function findHolidayFor(\DateTimeImmutable $date): ?Holidays\Holiday
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

    private function getHolidays(\DateTimeImmutable $date): array
    {
        return $this->touchYearHolidays((int)$date->format('Y'));
    }

    private function touchYearHolidays($year): array
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

    private function areTheSameDay(\DateTimeImmutable $date1, \DateTimeImmutable $date2): bool
    {
        return $date1->format('Y m d') === $date2->format('Y m d');
    }

    private function addOneDay()
    {
        $this->newDate = $this->newDate->add(new \DateInterval('P1D'));
    }
}
