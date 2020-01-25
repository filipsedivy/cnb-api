<?php declare(strict_types=1);

namespace CnbApi\Entity;

class ExchangeRate
{
    /** @var \DateTime */
    private $date;

    /** @var Rate[] */
    private $rates = [];


    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }


    /**
     * @param \DateTime $date
     *
     * @return ExchangeRate
     */
    public function setDate(\DateTime $date): ExchangeRate
    {
        $this->date = $date;

        return $this;
    }


    /**
     * @return Rate[]
     */
    public function getRates(): array
    {
        return $this->rates;
    }


    /**
     * @param array $rates
     *
     * @return ExchangeRate
     */
    public function setRates(array $rates): ExchangeRate
    {
        $this->rates = $rates;

        return $this;
    }


    /**
     * @param Rate $rate
     *
     * @return ExchangeRate
     */
    public function addRate(Rate $rate): ExchangeRate
    {
        $this->rates[] = $rate;

        return $this;
    }
}