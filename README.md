CnbApi
======

[![Build Status](https://travis-ci.org/filipsedivy/CnbApi.svg?branch=master)](https://travis-ci.org/filipsedivy/CnbApi)

Install it using Composer:

```
composer require filipsedivy/cnb-api
```

The last stable release requires PHP version 7.1.

Documentation
-------------

If you leave the first parameter blank, the cache will be disabled.

```php
$cnb = new CnbApi\CnbApi(string $tempDirectory = null);
```


Usage
-----

### Create instance of class

If you want to turn on caching results, use the first parameter to set the folder to temp folder.

```php
$cnb = new CnbApi\CnbApi(__DIR__ . '/temp');
```

To use the cache, you must have the [nette/caching](https://packagist.org/packages/nette/caching) package installed, which is not part of the mandatory packages.

**The folder must exist, otherwise the application will end with an exception.**

If you do not want to cach the result, you do not need to specify the first parameter.

```php
$cnb = new CnbApi\CnbApi();
```

### Exchange rate list selection

To select the entire exchange rate list, there is a method that returns the complete data from the Czech National Bank.

```php
$cnb->getEntity();
```

The **first parameter is the date of the exchange rate list** . If the date is not specified, the exchange rate list is selected at the current date.

The method returns an object `CnbApi\Entity\ExchangeRate`

### Select one currency

Select by exchange rate code

```php
$cnb->findRateByRate('EUR');
```

Select by country name

```php
$cnb->findRateByCountry('Mexiko');
```

These selections always return the object `CnbApi\Entity\Rate`

If you specify the DateTime object as the second parameter, the date will be listed with the date set. Time is ignored.

```php
$cnb->findRateByRate('EUR', new \DateTime('2019-01-01'));
```

### Currency conversion between Czech crown

Ancillary methods are available that allow the transfer between the Czech crown and the country's target name or the country's destination code.

```php
$cnb->convertFromCzk('EUR', 5.0);
```

```php
$cnb->convertToCzk('EUR', 5.0);
```

Methods return object `CnbApi\Entity\Rate`

### Helper classes

In class `CnbApi\Helpers\Currency` are maintained most widely used currency.

```php
$cnb->findRateByCode(\CnbApi\Helpers\Currency::EURO)
```
