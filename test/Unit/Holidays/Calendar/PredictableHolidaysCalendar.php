<?php

namespace Nati\Businesscal\Test\Unit\Holidays\Calendar;

use Nati\Businesscal\Holidays\HolidaysCalendar;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

abstract class PredictableHolidaysCalendar extends TestCase
{
    #[Test, DataProvider('expected2017Workingdays')]
    public function whenNotHolidayThenDontReturnIt(string $simplifiedDate)
    {
        $this->assertHasNotHoliday('2017/' . $simplifiedDate);
    }

    #[Test, DataProvider('expected2017Holidays')]
    public function canReturnHolidays(string $simplifiedDate)
    {
        $this->assertHasHoliday('2017/' . $simplifiedDate);
    }

    private function assertHasNotHoliday($date)
    {
        $this->assertFalse($this->isDateInHolidays($date), 'Date should not be holiday');
    }

    private function assertHasHoliday($date)
    {
        $this->assertTrue($this->isDateInHolidays($date), 'Expected holiday is not');
    }

    private function isDateInHolidays($date): bool
    {
        foreach ($this->getHolidays() as $holiday) {
            if ($date === $holiday->date->format('Y/m/d')) {
                return true;
            }
        }

        return false;
    }

    private function getHolidays(): array
    {
        return $this->getCalendar()->getHolidays(2017);
    }

    public static function expected2017Workingdays(): array
    {
        return [
            'Random1' => ['01/10'],
            'Random2' => ['02/10']
        ];
    }

    abstract protected function getCalendar(): HolidaysCalendar;

    abstract static public function expected2017Holidays(): array;
}
