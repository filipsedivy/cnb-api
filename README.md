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

**The folder must exist, otherwise the application will end with an exception.**

If you do not want to cach the result, you do not need to specify the first parameter.

```php
$cnb = new CnbApi\CnbApi();
```

### Exchange rate selection

Selecting using the exchange rate code

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