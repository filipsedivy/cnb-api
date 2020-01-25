<?php declare(strict_types=1);

namespace CnbApi\Mock\Entity;

use CnbApi\Entity;

class CzechCurrency extends Entity\Currency
{
    public function __construct()
    {
        $this->setName('koruna');
        $this->setCode('CZK');
    }
}
