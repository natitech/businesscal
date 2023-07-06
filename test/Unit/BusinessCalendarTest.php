<?php

namespace Nati\Businesscal\Test\Unit;

use Nati\Businesscal\BusinessCalendar;
use Nati\Businesscal\Holidays\Holiday;
use Nati\Businesscal\Test\Double\Holidays\Calendar\HolidaysCalendarMock;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class BusinessCalendarTest extends TestCase
{
    private readonly HolidaysCalendarMock $holidays;

    private readonly BusinessCalendar     $adder;

    protected function setUp(): void
    {
        $this->holidays = new HolidaysCalendarMock();

        $this->adder = new BusinessCalendar($this->holidays);
    }

    #[Test]
    public function whenAddingNegativeDaysThenThrowException()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->add('2017/01/30', -2);
    }

    #[Test]
    public function whenAddingNoDaysThenReturnDate()
    {
        $this->assertNewDateIs('2017/01/30', '2017/01/30', 0);
    }

    #[Test]
    public function whenAddingBusinessDaysThenAddWeekDays()
    {
        $this->assertNewDateIs('2017/02/01', '2017/01/30', 2);
    }

    #[Test]
    public function whenAddingBusinessDaysThenIgnoreWeekEnd()
    {
        $this->assertNewDateIs('2017/02/06', '2017/01/30', 5);
    }

    #[Test]
    public function whenAddingBusinessDaysThenIgnoreHolidays()
    {
        $this->prepareHoliday();

        $this->assertNewDateIs('2017/04/19', '2017/04/14', 2);
    }

    #[Test]
    public function whenWhyHolidayOnNonHolidayThenThrowException()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->why();
    }

    #[Test]
    public function canReturnWhyHoliday()
    {
        $this->prepareHoliday();

        $this->assertEquals('Holiday !', $this->why());
    }

    private function assertNewDateIs($expected, $start, $nbBusinessDays)
    {
        $this->assertEquals(new \DateTimeImmutable($expected), $this->add($start, $nbBusinessDays));
    }

    private function add($start, $nbBusinessDays): \DateTimeImmutable
    {
        return $this->adder->addNbBusinessDaysTo(new \DateTimeImmutable($start), $nbBusinessDays);
    }

    private function prepareHoliday()
    {
        $this->holidays->setHolidays([Holiday::create($this->getHolidayDate(), 'Holiday !')]);
    }

    private function why(): string
    {
        return $this->adder->whyIsHoliday($this->getHolidayDate());
    }

    private function getHolidayDate(): \DateTimeImmutable
    {
        return new \DateTimeImmutable('2017/04/17');
    }
}
