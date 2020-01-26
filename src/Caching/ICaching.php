<?php declare(strict_types=1);

namespace CnbApi\Caching;

use CnbApi\Entity;
use DateTimeInterface;

interface ICaching
{
    public function load(DateTimeInterface $dateTime): Entity\ExchangeRate;

    public function save(DateTimeInterface $dateTime): void;
}
