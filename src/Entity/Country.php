<?php declare(strict_types=1);

namespace CnbApi\Entity;

class Country
{
    /** @var string */
    private $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Country
    {
        $this->name = $name;

        return $this;
    }
}
