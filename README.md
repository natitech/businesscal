## Businesscal

PHP standalone library to manipulate business days
[![Build Status](https://travis-ci.org/tonio6071/businesscal.svg?branch=master)](https://travis-ci.org/tonio6071/businesscal)

## Installation

```
composer require poolpi/businesscal
```

## Usage

```php
//You can pick up any calendar dependency you want
$calendar = new Poolpi\Businesscal\BusinessCalendar(new FrHolidaysCalendar);

//To know if a given date is a business day
$calendar->isBusinessDay(new \DateTime());

//To add some business days to a given date
$calendar->addNbBusinessDaysTo(new \DateTime(), 20);
```
