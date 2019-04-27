CnbApi
======

Install it using Composer:

```
composer require filipsedivy/cnb-api
```

The last stable release requires PHP version 7.1.

Documentation
-------------

### Create an object

```php
$cnb = new CnbApi(string $tempDirectory = null);
```

### CnbApi methods

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
$cnb = new CnbApi();
$rate = $cnb->findRateByRate('EUR')
```

Return: `Rate`