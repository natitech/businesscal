## Businesscal

PHP standalone library to manipulate business days

## Installation

composer require poolpi/businesscal

## Usage

```php
//You can pick up any calendar you want
$calendar = new BusinessCalendar(new FrHolidaysCalendar);

//To know if a given date is a business day
$calendar->isBusinessDay(new \DateTime());

//To add some business days to a given date
$calendar->addNbBusinessDaysTo(new \DateTime(), 20);
```
