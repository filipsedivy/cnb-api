<?php declare(strict_types=1);

namespace CnbApi;

use CnbApi\Cache;
use CnbApi\Exceptions;
use CnbApi\Hydrator\EntityHydrator;
use CnbApi\Model;
use CnbApi\Source;
use DateTime;

final class Client
{
    private Source\ISource $source;

    private Cache\ICache $cache;

    public function __construct(?Source\ISource $source = null, ?Cache\ICache $cache = null)
    {
        $source = $source ?? new Source\XmlSource;
        $cache = $cache ?? new Cache\InMemoryCache;

        $this->source = $source;
        $this->cache = $cache;
    }

    public function getExchangeRate(?DateTime $date = null): Model\Entity\ExchangeRate
    {
        if ($date === null) {
            $date = new DateTime('now');
        }

        return $this->loadExchangeRate($date);
    }

    public function getSource(): Source\ISource
    {
        return $this->source;
    }

    private function loadExchangeRate(?DateTime $date): Model\Entity\ExchangeRate
    {
        try {
            $result = $this->cache->findByDate($date);
        } catch (Exceptions\EntityNotFoundException $exception) {
            $translator = $this->getSource()->getTranslator($date);
            $result = $translator->toArray();
            $this->cache->save($date, $result);
        }

        $hydrator = new EntityHydrator($result);

        return $hydrator->result();
    }
}
