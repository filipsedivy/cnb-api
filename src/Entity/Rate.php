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

    public function __construct(Country $country, Currency $currency, int $amount, float $rate)
    {
        $this->country = $country;
        $this->currency = $currency;
        $this->amount = $amount;
        $this->rate = $rate;
    }

    public function getCountry(): Country
    {
        return $this->country;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getRate(): float
    {
        return $this->rate;
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
