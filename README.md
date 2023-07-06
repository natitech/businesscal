## Businesscal

[![Build Status](https://travis-ci.org/natitech/businesscal.svg?branch=master)](https://travis-ci.org/natitech/businesscal)
[![Latest Stable Version](https://poser.pugx.org/natitech/businesscal/v/stable)](https://packagist.org/packages/businesscal)
[![License](https://poser.pugx.org/natitech/businesscal/license)](https://packagist.org/packages/natitech/businesscal)

PHP standalone library to manipulate business days

## Installation

```
composer require nati/businesscal
```

Version 6.x is compatible with PHP 7.4 and PHP 8.0 but is not maintained anymore.
Version 7.x is compatible with PHP 8.1+ and is the current maintained version. 

## Usage

```php
//You can pick up a holiday calendar from Nati\Businesscal\Holidays namespace or create your own implementing Nati\Businesscal\Holidays\HolidaysCalendar
$calendar = new Nati\Businesscal\BusinessCalendar(new FrHolidaysCalendar);

//To know if a given date is a business day
$calendar->isBusinessDay(new \DateTimeImmutable());

//To add some business days to a given date
$calendar->addNbBusinessDaysTo(new \DateTimeImmutable(), 20);
```
