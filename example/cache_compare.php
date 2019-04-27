<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

\Nette\Utils\FileSystem::createDir(__DIR__ . '/temp');

$withoutCache = new \CnbApi\CnbApi();

$start = microtime(true);
$withoutCache->findRateByCode('EUR');
$end = microtime(true) - $start;

print '-- WITHOUT CACHE --' . PHP_EOL;
print number_format($end, 3, '.', '') . 'ms' . PHP_EOL;
$firstLoad = $end;

print '-- WITH CACHE --' . PHP_EOL;

$withCache = new \CnbApi\CnbApi(__DIR__ . '/temp/');

$start = microtime(true);
$withCache->findRateByCode('EUR');
$end = microtime(true) - $start;

print '[1] ' . number_format($end, 3, '.', '') . 'ms' . PHP_EOL;

$start = microtime(true);
$withCache->findRateByCode('EUR');
$end = microtime(true) - $start;

$load = $firstLoad - $end;

print '[2] ' . number_format($end, 3, '.', '') . 'ms' . PHP_EOL;
print 'Time saving with cache: ' . number_format($load, 3, '.', '') . 'ms';
print PHP_EOL;