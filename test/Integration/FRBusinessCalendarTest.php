<?php

namespace Nati\Businesscal\Test\Integration;

use Nati\Businesscal\BusinessCalendar;
use PHPUnit\Framework\TestCase;

abstract class FRBusinessCalendarTest extends TestCase
{
    private BusinessCalendar $calendar;

    protected function setUp(): void
    {
        $this->prepareCalendar();
    }

    protected function assertNewDateIs($expected, $start, $nbBusinessDays)
    {
        $this->assertEquals(new \DateTimeImmutable($expected), $this->add($start, $nbBusinessDays));
    }

    protected function add($start, $nbBusinessDays): \DateTimeImmutable
    {
        return $this->calendar->addNbBusinessDaysTo(new \DateTimeImmutable($start), $nbBusinessDays);
    }

    protected function prepareCalendar()
    {
        $this->calendar = $this->getCalendar();
    }

    abstract protected function getCalendar();
}
