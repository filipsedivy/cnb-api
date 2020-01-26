<?php declare(strict_types=1);

namespace CnbApi\Caching;

use CnbApi\Entity;
use DateTimeInterface;

class NullCaching implements ICaching
{
    public function load(DateTimeInterface $dateTime): ?Entity\ExchangeRate
    {
        // [FIX] PHPStan, PHPCB
        $dateTime->format('c');

        return null;
    }

    public function save(DateTimeInterface $dateTime, Entity\ExchangeRate $entity): void
    {
        // [FIX] PHPStan, PHPCB
        $dateTime->format('c');
        $entity->getSerialNumber();
    }
}
