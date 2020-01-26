# Client for CNB exchange rates

Usage
-----

### Create instance of class

```php
$client = new CnbApi\Client(?CnbApi\Caching\ICaching $caching = null, ?CnbApi\Source\ISource $source = null);
```

### Exchange rate list selection

To select the entire exchange rate list, there is a method that returns the complete data from the Czech National Bank.

```php
$client->getEntity(?DateTime $date = null);
```

The **first parameter is the date of the exchange rate list** . If the date is not specified, the exchange rate list is selected at the current date.

The method returns an object `CnbApi\Entity\ExchangeRate`

### Select one currency

Select by exchange rate code

```php
$client->findRateByCode('EUR');
```

Select by country name

```php
$client->findRateByCountry('Mexiko');
```

These selections always return the object `CnbApi\Entity\Rate`

If you specify the DateTime object as the second parameter, the date will be listed with the date set. Time is ignored.

```php
$client->findRateByCode('EUR', new \DateTime('2019-01-01'));
```

### Helper classes

In class `CnbApi\Helpers\Currency` are maintained most widely used currency.

```php
$client->findRateByCode(\CnbApi\Helpers\Currency::EURO);
```

### Advanced conversion

If you need to convert from one currency to another, it is possible to use the Client :: rate (...) method, which allows conversion between multiple currencies.

The entire conversion process is shown in this diagram.

```
+----------------------------------+   +---------------------+   +---------------------+
| Client::rate(from: EUR, to: USD) +---> Convert EUR to CZK  +--->  Convert CZK to USD |
+----------------------------------+   +---------------------+   +---------------------+
```

Convert 5 EUR to USD:

```php
$client->rate('EUR', 'USD', 5);
```
