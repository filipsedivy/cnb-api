<?php declare(strict_types=1);

namespace CnbApi\Mock\Entity;

use CnbApi\Entity;

class CzechRate extends Entity\Rate
{
    public function __construct()
    {
        $this->setCountry(new CzechCountry);
        $this->setCurrency(new CzechCurrency);
        $this->setRate(1);
        $this->setAmount(1);
    }
}
