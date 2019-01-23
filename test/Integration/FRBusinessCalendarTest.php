<?php

namespace Nati\Businesscal\Test\Integration;

use PHPUnit\Framework\TestCase;

abstract class FRBusinessCalendarTest extends TestCase
{
    /**
     * @var \Nati\Businesscal\BusinessCalendar
     */
    private $calendar;

    protected function setUp()
    {
        $this->prepareCalendar();
    }

    /**
     * @test
     */
    public function canAddManyDays()
    {
        $this->assertNewDateIs('2016/11/09', '2014/01/01', 720);
    }

    protected function assertNewDateIs($expected, $start, $nbBusinessDays)
    {
        $this->assertEquals(new \DateTimeImmutable($expected), $this->add($start, $nbBusinessDays));
    }

    protected function add($start, $nbBusinessDays)
    {
        return $this->calendar->addNbBusinessDaysTo(new \DateTimeImmutable($start), $nbBusinessDays);
    }

    protected function prepareCalendar()
    {
        $this->calendar = $this->getCalendar();
    }

    abstract protected function getCalendar();
}
