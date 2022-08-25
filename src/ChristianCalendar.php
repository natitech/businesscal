<?php

namespace Nati\Businesscal;

final class ChristianCalendar
{
    private const MAX_PHP_EASTER_YEAR = 2037;

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
        $easter = $this->getEasterDate($year);

        if ($nbDaysAfterEaster === 0) {
            return $easter;
        }

        $interval = new \DateInterval('P' . abs($nbDaysAfterEaster) . 'D');

        return $nbDaysAfterEaster > 0 ? $easter->add($interval) : $easter->sub($interval);
    }

    private function getEasterDate(int $year): \DateTimeImmutable
    {
        return \DateTimeImmutable::createFromFormat('U', easter_date($this->guardEasterYear($year)));
    }

    private function guardEasterYear(int $year): int
    {
        if ($year > self::MAX_PHP_EASTER_YEAR) {
            throw new \InvalidArgumentException('Easter date not found');
        }

        return $year;
    }
}
