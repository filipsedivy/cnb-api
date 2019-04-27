CnbApi
======

Install it using Composer:

```
composer require filipsedivy/cnb-api
```

The last stable release requires PHP version 7.1.

Documentation
-------------

If you want to turn on caching results, use the first parameter to set the folder to temp folder.
If you leave the first parameter blank, the cache will be disabled.

```php
$cnb = new CnbApi(string $tempDirectory = null);
```

| Methods                                                                         |
| ------------------------------------------------------------------------------- |
| $cnb->getEntity(`DateTime` $date) : `CnbApi\Entity\ExchangeRate`                  |
| $cnb->findRateByCode(`string` $code, `DateTime` $date = `null`) : `CnbApi\Entity\Rate`|
| $cnb->findRateByCountry(`string` $country, `DateTime` $date = `null`) : `CnbApi\Entity\Rate`|
| $cnb->convertFromCzk(`string` $code, `float` $amount = 1, `DateTime` $date = null : `CnbApi\Entity\Rate`|
| $cnb->convertToCzk(`string` $code, `float` $amount = 1, `DateTime` $date = `null` : `CnbApi\Entity\Rate`|


Usage
-----

```php
$cnb->findRateByRate('EUR');
```

Return: `CnbApi\Entity\Rate`

```php
$cnb->getEntity(new DateTime('2019-02-04'));
```

Return: `CnbApi\Entity\ExchangeRate`