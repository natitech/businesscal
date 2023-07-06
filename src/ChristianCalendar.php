<?php

namespace Nati\Businesscal;

final class ChristianCalendar
{
    public function getEasterFriday(int $year): \DateTimeImmutable
    {
        return $this->getDateAroundEaster($year, -2);
    }

    public function getEasterMonday(int $year): \DateTimeImmutable
    {
        return $this->getDateAroundEaster($year, 1);
    }

    public function getPentecostMonday(int $year): \DateTimeImmutable
    {
        return $this->getDateAroundEaster($year, 50);
    }

    public function getAscensionDay(int $year): \DateTimeImmutable
    {
        return $this->getDateAroundEaster($year, 39);
    }

    private function getDateAroundEaster(int $year, int $nbDaysAfterEaster): \DateTimeImmutable
    {
        return $this->addDays($this->getEasterDate($year), $nbDaysAfterEaster);
    }

    /** @see <https://www.php.net/manual/en/function.easter-date.php#refsect1-function.easter-date-notes> */
    private function getEasterDate(int $year): \DateTimeImmutable
    {
        return $this->addDays(new \DateTimeImmutable($year . '-03-21'), easter_days($year));
    }

    private function addDays(\DateTimeImmutable $date, int $nbDays): \DateTimeImmutable
    {
        if ($nbDays === 0) {
            return $date;
        }

        $interval = new \DateInterval('P' . abs($nbDays) . 'D');

        return $nbDays > 0 ? $date->add($interval) : $date->sub($interval);
    }
}
