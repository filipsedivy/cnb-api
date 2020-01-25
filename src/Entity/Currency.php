<?php declare(strict_types=1);

namespace CnbApi\Entity;

class Currency
{
    /** @var string */
    private $name;

    /** @var string */
    private $code;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Currency
    {
        $this->name = $name;

        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): Currency
    {
        $this->code = $code;

        return $this;
    }
}
