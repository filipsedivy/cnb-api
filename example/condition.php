<?php

require_once __DIR__ . '/../vendor/autoload.php';

use CnbApi\Internal\ExchangeRateIterator;

$cnb = new CnbApi();

$exchange_rates = $cnb->getExchangeRates();
$exchange_rates->addEqual(ExchangeRateIterator::COLUMN_CURRENCY_NAME, 'euro');
$rate = $exchange_rates->fetch();

if ($rate !== null)
{
    echo 'Currency code: ' . $rate->getCurrency()->getCode() . PHP_EOL;
    echo 'Currency name: ' . $rate->getCurrency()->getName() . PHP_EOL;
    echo 'Rate: ' . $rate->getRate() . PHP_EOL;
    echo 'Amount: ' . $rate->getAmount() . PHP_EOL;
}
else
{
    echo 'Sorry, currency not found';
}