<?php

require_once __DIR__ . '/../vendor/autoload.php';

$cnb = new CnbApi();

$rates = $cnb->getExchangeRates();
$list = $rates->fetchAll();

var_dump($list);