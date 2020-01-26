<?php declare(strict_types=1);

namespace CnbApi\Factory;

use CnbApi\Entity;
use CnbApi\Source;
use CnbApi\Utils;
use DateTimeInterface;

class EntityFactory
{
    /** @var Entity\ExchangeRate|null */
    private $lastExchangeRate;

    public function create(Source\ISource $source, ?DateTimeInterface $dateTime = null): Entity\ExchangeRate
    {
        if ($dateTime === null) {
            $dateTime = Utils\DateTime::now();
        }

        if ($this->lastExchangeRate instanceof Entity\ExchangeRate && $dateTime->format('Y-m-d') === $this->lastExchangeRate->getDate()->format('Y-m-d')) {
            return $this->lastExchangeRate;
        }

        $content = $source->getByDate($dateTime);
        $source->getTranslator()->setContent($content);

        $this->lastExchangeRate = $source->getTranslator()->getEntity();

        return $this->lastExchangeRate;
    }
}
