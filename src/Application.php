<?php

declare(strict_types=1);

namespace CnbApi;

use CnbApi\Entity\ExchangeRate;
use CnbApi\Entity\Rate;
use CnbApi\Source\ISource;
use CnbApi\Translator\ITranslator;
use Nette\Caching\Cache;
use Nette\Caching\Storages\FileStorage;
use Nette\Utils\Strings;

class Application
{
    /** @var ISource */
    private $source;


    /** @var ITranslator */
    private $translator;


    /** @var FileStorage|null */
    private $storage;


    /**
     * @param ISource $source
     * @param ITranslator $translator
     * @param string|null $tempDirectory
     */
    public function __construct(ISource $source, ITranslator $translator, string $tempDirectory = null)
    {
        $this->source = $source;
        $this->translator = $translator;

        if ($tempDirectory !== null)
        {
            $this->storage = new FileStorage($tempDirectory);
        }
    }


    /**
     * @param \DateTime|null $date
     *
     * @return ExchangeRate
     *
     * @throws DateTimeException
     */
    public function getEntity(\DateTime $date = null)
    {
        if ($date === null)
        {
            try
            {
                $date = new \DateTime('now');
            }
            catch (\Exception $e)
            {
                throw new DateTimeException($e->getMessage(), $e->getCode(), $e->getPrevious());
            }
        }

        $content = $this->source->getByDate($date);
        $this->translator->setContent($content);

        return $this->loadEntity($date);
    }


    /**
     * @param string $country
     * @param \DateTime|null $date
     *
     * @return Rate
     *
     * @throws InvalidArgumentException
     * @throws DateTimeException
     */
    public function findRateByCountry(string $country, \DateTime $date = null): Rate
    {
        $entity = $this->getEntity($date);
        $rates = $entity->getRates();
        $country = Strings::upper($country);

        foreach ($rates as $rate)
        {
            if (Strings::upper($rate->getCountry()->getName()) === $country)
            {
                return $rate;
            }
        }

        throw new InvalidArgumentException("Country '$country' not found");
    }


    /**
     * @param string $code
     * @param \DateTime|null $date
     *
     * @return Rate
     *
     * @throws InvalidArgumentException
     * @throws DateTimeException
     */
    public function findRateByCode(string $code, \DateTime $date = null): Rate
    {
        $entity = $this->getEntity($date);
        $rates = $entity->getRates();

        foreach ($rates as $rate)
        {
            if ($rate->getCurrency()->getCode() === Strings::upper($code))
            {
                return $rate;
            }
        }

        throw new InvalidArgumentException("Code '$code' not found");
    }


    /**
     * @param \DateTime $date
     *
     * @return ExchangeRate
     */
    private function loadEntity(\DateTime $date)
    {
        if ($this->storage instanceof FileStorage)
        {
            $cacheKey = $date->format('Y-m-d');

            $cache = new Cache($this->storage, 'CnbApi.Entity');

            $content = $cache->load($cacheKey, function () use ($date) {
                return [
                    'class' => [
                        'source'     => get_class($this->source),
                        'translator' => get_class($this->translator),
                    ],
                    'data'  => $this->source->getByDate($date),
                ];
            });

            if ($content['class']['source'] !== get_class($this->source))
            {
                $this->source = new $content['class']['source'];
            }


            if ($content['class']['translator'] !== get_class($this->translator))
            {
                $this->translator = $content['class']['translator'];
            }

            $this->translator->setContent($content['data']);
        }
        else
        {
            $this->translator->setContent($this->source->getByDate($date));
        }

        return $this->translator->getEntity();
    }
}