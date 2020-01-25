<?php declare(strict_types=1);

namespace CnbApi\Mock\Entity;

use CnbApi\Entity;

class CzechCountry extends Entity\Country
{
    public function __construct()
    {
        $this->setName('Česko');
    }
}
