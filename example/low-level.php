<?php

/*
 * Example low level access
 */

ini_set('display_errors', 'on');

require_once __DIR__ . '/../vendor/autoload.php';

$request = new \CnbApi\Loader\Request();
$loader = new \CnbApi\Loader\Loader($request);
$convertor = new \CnbApi\Loader\Convertor($loader->getContent());

/* Get content */
echo '<pre>';
echo $loader->getContent();
echo '</pre>';

echo '<hr>';


/* Array convertor */

echo '<pre>';
print_r($convertor->toArray());
echo '</pre>';

echo '<hr>';

/* Entity convertor */
echo '<pre>';
print_r($convertor->toEntities());
echo '</pre>';