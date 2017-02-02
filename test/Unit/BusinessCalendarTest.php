<?php

namespace Poolpi\Businesscal\Test\Unit;

use PHPUnit\Framework\TestCase;
use Poolpi\Businesscal\BusinessCalendar;
use Poolpi\Businesscal\Double\Holidays\HolidaysCalendarMock;

class BusinessCalendarTest extends TestCase
{
    /**
     * @var HolidaysCalendarMock
     */
    private $holidays;

    /**
     * @var BusinessCalendar
     */
    private $adder;

    protected function setUp()
    {
        $this->holidays = new HolidaysCalendarMock();

        $this->adder = new BusinessCalendar($this->holidays);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function whenAddingNegativeDaysThenThrowException()
    {
        $this->add('2017/01/30', -2);
    }

    /**
     * @test
     */
    public function whenAddingNoDaysThenReturnDate()
    {
        $this->assertNewDateIs('2017/01/30', '2017/01/30', 0);
    }

    /**
     * @test
     */
    public function whenAddingBusinessDaysThenAddWeekDays()
    {
        $this->assertNewDateIs('2017/02/01', '2017/01/30', 2);
    }

    /**
     * @test
     */
    public function whenAddingBusinessDaysThenIgnoreWeekEnd()
    {
        $this->assertNewDateIs('2017/02/06', '2017/01/30', 5);
    }

    /**
     * @test
     */
    public function whenAddingBusinessDaysThenIgnoreHolidays()
    {
        $this->holidays->setHolidays([new \DateTime('2017/04/17')]);

        $this->assertNewDateIs('2017/04/19', '2017/04/14', 2);
    }

    private function assertNewDateIs($expected, $start, $nbBusinessDays)
    {
        $this->assertEquals(new \DateTime($expected), $this->add($start, $nbBusinessDays));
    }

    private function add($start, $nbBusinessDays)
    {
        return $this->adder->addNbBusinessDaysTo(new \DateTime($start), $nbBusinessDays);
    }
}
