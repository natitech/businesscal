<?php

namespace Nati\Businesscal\Holidays;

class Holiday
{
    public \DateTimeImmutable $date;

    public ?string            $label;

    public static function create(\DateTimeImmutable $date, $label = null): self
    {
        $holiday        = new self;
        $holiday->date  = $date;
        $holiday->label = $label;

        return $holiday;
    }
}
