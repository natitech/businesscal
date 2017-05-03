<?php

namespace Poolpi\Businesscal\Holidays;

class Holiday
{
    /**
     * @var \DateTime
     */
    public $date;

    /**
     * @var string
     */
    public $label;

    public static function create(\DateTime $date, $label = null)
    {
        $holiday = new self;

        $holiday->date  = $date;
        $holiday->label = $label;

        return $holiday;
    }
}
