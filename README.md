CnbApi
======

Install it using Composer:

```
composer require filipsedivy/cnb-api
```

The last stable release requires PHP version 5.6 or newer (is compatible with PHP 7.0 and 7.1).

Documentation
-------------

### Create an object

```php
$cnb = new CnbApi();
```

### CnbApi methods

| Methods                                                                     |
| --------------------------------------------------------------------------- |
| $cnb->getExchangeRates(`$date`) : `ExchangeRateIterator` → `ObjectIterator` |
| $cnb->setCache(`Nette\Caching\Cache $cache`)                                |

### Object iterator

#### Conditionals

| Methods                        |
| ------------------------------ |
| setLimit(`$limit`)             |
| setOffset(`$offset`)           |
| addEqual(`$column`, `$value`)  |


#### Methods

| Methods                        |
| ------------------------------ |
| fetch() : `Entity`             |
| fetchAll() : `Entity[]`        |

Usage
-----

### Get all exchange rates

```php
$cnb = new CnbApi();
$rates = $cnb->getExchangeRates();
$rates->fetchAll();
```

Return: `ExchangeRate[]`

### Usage filters

Get today exchange rate for EUR

```php
$cnb = new CnbApi();
$rates = $cnb->getExchangeRates();
$rates->addEqual(\CnbApi\Internal\ExchangeRateIterator::COLUMN_CURRENCY_CODE, 'EUR');
$rates->fetch();
```

Return: `ExchangeRate`

### Usage Nette\Cache

```php
$storage = new \Nette\Caching\Storages\FileStorage(__DIR__.'/temp');
$cache = new \Nette\Caching\Cache($storage);

$cnb = new CnbApi();
$cnb->setCache($cache);
$rates = $cnb->getExchangeRates();
$list = $rates->fetchAll();
```

Return: `ExchangeRate[]`