<?php

require_once __DIR__ . '/../vendor/autoload.php';

use CnbApi\Internal\ExchangeRateIterator;

$cnb = new CnbApi();

$rates = $cnb->getExchangeRates();
$list = $rates->fetch();
