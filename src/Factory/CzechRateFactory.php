<?php declare(strict_types=1);

namespace CnbApi\Factory;

use CnbApi\Entity;

class CzechRateFactory
{
    public function create(): Entity\Rate
    {
        return new Entity\Rate($this->createCountry(), $this->createCurrency(), 1, 1.0);
    }

    public function createCurrency(): Entity\Currency
    {
        return new Entity\Currency('koruna', 'CZK');
    }

    public function createCountry(): Entity\Country
    {
        return new Entity\Country('Česko');
    }
}
