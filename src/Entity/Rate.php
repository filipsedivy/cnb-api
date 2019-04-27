<?php

declare(strict_types=1);

namespace CnbApi\Entity;

class Rate
{
    /** @var Country */
    private $country;


    /** @var Currency */
    private $currency;


    /** @var int */
    private $amount;


    /** @var float */
    private $rate;


    /**
     * @return Country
     */
    public function getCountry(): Country
    {
        return $this->country;
    }


    /**
     * @param Country $country
     *
     * @return Rate
     */
    public function setCountry(Country $country): Rate
    {
        $this->country = $country;

        return $this;
    }


    /**
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }


    /**
     * @param Currency $currency
     *
     * @return Rate
     */
    public function setCurrency(Currency $currency): Rate
    {
        $this->currency = $currency;

        return $this;
    }


    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }


    /**
     * @param int $amount
     *
     * @return Rate
     */
    public function setAmount(int $amount): Rate
    {
        $this->amount = $amount;

        return $this;
    }


    /**
     * @return float
     */
    public function getRate(): float
    {
        return $this->rate;
    }


    /**
     * @param float $rate
     *
     * @return Rate
     */
    public function setRate(float $rate): Rate
    {
        $this->rate = $rate;

        return $this;
    }


    /**
     * @return float
     */
    public function getOneRateAmount(): float
    {
        return $this->getRate() / $this->getAmount();
    }


    /**
     * @param float $amount
     *
     * @return float
     */
    public function getRateByAmount(float $amount): float
    {
        return $this->getOneRateAmount() * $amount;
    }
}