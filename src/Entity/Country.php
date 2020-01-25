<?php declare(strict_types=1);

namespace CnbApi\Entity;

class Country
{
    /** @var string */
    private $name;


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @param string $name
     *
     * @return Country
     */
    public function setName($name): Country
    {
        $this->name = $name;

        return $this;
    }
}