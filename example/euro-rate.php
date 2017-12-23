<?php

require_once __DIR__.'/../vendor/autoload.php';

$cnb = new CnbApi();

var_dump($cnb->getExchangeRateByCurrencyCode('eur'));