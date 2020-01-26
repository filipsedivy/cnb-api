<?php declare(strict_types=1);

namespace CnbApi;

use CnbApi\Entity;
use CnbApi\Exceptions;
use CnbApi\Factory;
use CnbApi\Source;
use CnbApi\Utils;
use DateTimeInterface;

class Application
{
    /** @var Source\ISource */
    private $source;

    /** @var Factory\EntityFactory */
    private $entityFactory;

    public function __construct(Source\ISource $source)
    {
        $this->source = $source;
        $this->entityFactory = new Factory\EntityFactory;
    }

    public function findRateByCountry(string $country, ?DateTimeInterface $date = null): Entity\Rate
    {
        $entity = $this->getEntity($date);
        $rates = $entity->getRates();
        $country = Utils\Strings::toUpper($country);

        foreach ($rates as $rate) {
            if (Utils\Strings::toUpper($rate->getCountry()->getName()) === $country) {
                return $rate;
            }
        }

        throw new Exceptions\InvalidArgumentException("Country '$country' not found");
    }

    public function findRateByCode(string $code, ?DateTimeInterface $date = null): Entity\Rate
    {
        $entity = $this->getEntity($date);
        $rates = $entity->getRates();

        foreach ($rates as $rate) {
            if ($rate->getCurrency()->getCode() === Utils\Strings::toUpper($code)) {
                return $rate;
            }
        }

        throw new Exceptions\InvalidArgumentException("Code '$code' not found");
    }

    public function getEntity(?DateTimeInterface $date = null): Entity\ExchangeRate
    {
        return $this->entityFactory->create($this->getSource(), $date);
    }

    public function getSource(): Source\ISource
    {
        return $this->source;
    }
}
