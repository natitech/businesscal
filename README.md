## Businesscal

PHP standalone library to manipulate business days
[![Build Status](https://travis-ci.org/natitech/businesscal.svg?branch=master)](https://travis-ci.org/natitech/businesscal)

## Installation

```
composer require nati/businesscal
```

## Usage

```php
//You can pick up a holiday calendar from Nati\Businesscal\Holidays namespace or create your own implementing Nati\Businesscal\Holidays\HolidaysCalendar
$calendar = new Nati\Businesscal\BusinessCalendar(new FrHolidaysCalendar);

//To know if a given date is a business day
$calendar->isBusinessDay(new \DateTimeImmutable());

//To add some business days to a given date
$calendar->addNbBusinessDaysTo(new \DateTimeImmutable(), 20);
```
