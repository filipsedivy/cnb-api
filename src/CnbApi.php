<?php

declare(strict_types=1);

namespace CnbApi;

use CnbApi\Entity\ExchangeRate;
use CnbApi\Entity\Rate;
use CnbApi\Source;
use CnbApi\Translator;

class CnbApi
{
    /** @var Application */
    private $application;


    /**
     * @param string|null $tempDirectory
     */
    public function __construct(string $tempDirectory = null)
    {
        $source = new Source\Cnb();
        $translator = new Translator\Cnb();

        $this->application = new Application($source, $translator, $tempDirectory);
    }


    /**
     * @param \DateTime|null $date
     *
     * @return ExchangeRate
     *
     * @throws DateTimeException
     */
    public function getEntity(\DateTime $date = null): ExchangeRate
    {
        return $this->application->getEntity($date);
    }


    /**
     * @param string $code
     * @param \DateTime|null $date
     *
     * @return Rate
     *
     * @throws DateTimeException
     * @throws InvalidArgumentException
     */
    public function findRateByCode(string $code, \DateTime $date = null): Rate
    {
        return $this->application->findRateByCode($code, $date);
    }


    /**
     * @param string $country
     * @param \DateTime|null $date
     *
     * @return Rate
     *
     * @throws DateTimeException
     * @throws InvalidArgumentException
     */
    public function findRateByCountry(string $country, \DateTime $date = null): Rate
    {
        return $this->application->findRateByCountry($country, $date);
    }


    /**
     * @param string $code
     * @param float $amount
     * @param \DateTime|null $date
     *
     * @return float
     *
     * @throws DateTimeException
     * @throws InvalidArgumentException
     */
    public function convertFromCzk(string $code, float $amount = 1, \DateTime $date = null): float
    {
        $rate = $this->findRateByCode($code, $date);

        return $amount / $rate->getOneRateAmount();
    }


    /**
     * @param string $code
     * @param float $amount
     * @param \DateTime|null $date
     *
     * @return float
     *
     * @throws DateTimeException
     * @throws InvalidArgumentException
     */
    public function convertToCzk(string $code, float $amount = 1, \DateTime $date = null): float
    {
        $rate = $this->findRateByCode($code, $date);

        return $amount * $rate->getOneRateAmount();
    }
}