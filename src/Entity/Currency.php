<?php declare(strict_types=1);

namespace CnbApi\Entity;

class Currency
{
    /** @var string */
    private $name;

    /** @var string */
    private $code;

    public function __construct(string $name, string $code)
    {
        $this->name = $name;
        $this->code = $code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCode(): string
    {
        return $this->code;
    }
}
