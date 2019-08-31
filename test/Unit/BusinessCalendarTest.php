<?php

namespace Nati\Businesscal\Test\Unit;

use PHPUnit\Framework\TestCase;
use Nati\Businesscal\BusinessCalendar;
use Nati\Businesscal\Test\Double\Holidays\HolidaysCalendarMock;
use Nati\Businesscal\Holidays\Holiday;

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

    protected function setUp(): void
    {
        $this->holidays = new HolidaysCalendarMock();

        $this->adder = new BusinessCalendar($this->holidays);
    }

    /**
     * @test
     */
    public function whenAddingNegativeDaysThenThrowException()
    {
        $this->expectException(\InvalidArgumentException::class);

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
        $this->prepareHoliday();

        $this->assertNewDateIs('2017/04/19', '2017/04/14', 2);
    }

    /**
     * @test
     */
    public function whenWhyHolidayOnNonHolidayThenThrowException()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->why();
    }

    /**
     * @test
     */
    public function canReturnWhyHoliday()
    {
        $this->prepareHoliday();

        $this->assertEquals('Holiday !', $this->why());
    }

    private function assertNewDateIs($expected, $start, $nbBusinessDays)
    {
        $this->assertEquals(new \DateTimeImmutable($expected), $this->add($start, $nbBusinessDays));
    }

    private function add($start, $nbBusinessDays)
    {
        return $this->adder->addNbBusinessDaysTo(new \DateTimeImmutable($start), $nbBusinessDays);
    }

    private function prepareHoliday()
    {
        $this->holidays->setHolidays([Holiday::create($this->getHolidayDate(), 'Holiday !')]);
    }

    private function why()
    {
        return $this->adder->whyIsHoliday($this->getHolidayDate());
    }

    private function getHolidayDate()
    {
        return new \DateTimeImmutable('2017/04/17');
    }
}
