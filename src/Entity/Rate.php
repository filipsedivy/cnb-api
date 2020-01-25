<?php declare(strict_types=1);

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

    public function getCountry(): Country
    {
        return $this->country;
    }

    public function setCountry(Country $country): Rate
    {
        $this->country = $country;

        return $this;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function setCurrency(Currency $currency): Rate
    {
        $this->currency = $currency;

        return $this;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): Rate
    {
        $this->amount = $amount;

        return $this;
    }

    public function getRate(): float
    {
        return $this->rate;
    }

    public function setRate(float $rate): Rate
    {
        $this->rate = $rate;

        return $this;
    }

    public function getOneRateAmount(): float
    {
        return $this->getRate() / $this->getAmount();
    }

    public function getRateByAmount(float $amount): float
    {
        return $this->getOneRateAmount() * $amount;
    }
}
