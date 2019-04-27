<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

$cnb = new \CnbApi\CnbApi();
var_dump($cnb->convertToCzk('EUR'));