<?php

namespace Nati\Businesscal\Holidays;

class Holiday
{
    /**
     * @var \DateTimeImmutable
     */
    public $date;

    /**
     * @var string
     */
    public $label;

    public static function create(\DateTimeImmutable $date, $label = null)
    {
        $holiday = new self;

        $holiday->date  = $date;
        $holiday->label = $label;

        return $holiday;
    }
}
