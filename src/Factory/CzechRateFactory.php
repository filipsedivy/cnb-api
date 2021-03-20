<?php declare(strict_types=1);

namespace CnbApi\Factory;

use CnbApi\Model\Entity;

final class CzechRateFactory
{
    public static function createEntity(): Entity\Rate
    {
        return new Entity\Rate('Česko', 'koruna', 'CZK', 1, 1.0);
    }

    public static function createArray(): array
    {
        $entity = self::createEntity();

        return [
            'code' => $entity->getCode(),
            'currency' => $entity->getCurrency(),
            'amount' => $entity->getAmount(),
            'rate' => $entity->getRate(),
            'country' => $entity->getCountry()
        ];
    }
}
