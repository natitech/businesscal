<?php

namespace Nati\Businesscal;

final class ChristianCalendar
{
    private const MAX_PHP_EASTER_YEAR = 2037;

    private int $year;

    public function __construct(int $year)
    {
        $this->year = $year;
    }

    public function getEasterFriday(): \DateTimeImmutable
    {
        return $this->getDateAroundEaster(-2);
    }

    public function getEasterMonday(): \DateTimeImmutable
    {
        return $this->getDateAroundEaster(1);
    }

    public function getPentecostMonday(): \DateTimeImmutable
    {
        return $this->getDateAroundEaster(50);
    }

    public function getAscensionDay(): \DateTimeImmutable
    {
        return $this->getDateAroundEaster(39);
    }

    private function getDateAroundEaster(int $nbDaysAfterEaster): \DateTimeImmutable
    {
        $easter = $this->getEasterDate();

        if ($nbDaysAfterEaster === 0) {
            return $easter;
        }

        $interval = new \DateInterval('P' . abs($nbDaysAfterEaster) . 'D');

        return $nbDaysAfterEaster > 0 ? $easter->add($interval) : $easter->sub($interval);
    }

    private function getEasterDate(): \DateTimeImmutable
    {
        return \DateTimeImmutable::createFromFormat('U', easter_date($this->guardEasterYear()));
    }

    private function guardEasterYear(): int
    {
        if ($this->year > self::MAX_PHP_EASTER_YEAR) {
            throw new \InvalidArgumentException('Easter date not found');
        }

        return $this->year;
    }
}
