<?php declare(strict_types=1);

namespace CnbApi\Hydrator;

use CnbApi\Model;

final class EntityHydrator implements IHydrator
{
    private array $data;

    public function __construct(array $entryData)
    {
        $this->data = $entryData;
    }

    public function result(): Model\Entity\ExchangeRate
    {
        $header = $this->data['header'];
        $body = $this->data['data'];

        $entity = new Model\Entity\ExchangeRate(
            $header['date'],
            $header['serial'],
        );

        foreach ($body as $_rate) {
            $rate = new Model\Entity\Rate(
                $_rate['country'],
                $_rate['currency'],
                $_rate['code'],
                $_rate['amount'],
                $_rate['rate'],
            );

            $entity->addRate($rate);
        }

        return $entity;
    }
}
