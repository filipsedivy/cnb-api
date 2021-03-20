<?php declare(strict_types=1);

namespace CnbApi\Model\Entity;

final class Rate
{
    private string $country;

    private string $currency;

    private int $amount;

    private float $rate;

    private string $code;

    public function __construct(string $country, string $currency, string $code, int $amount, float $rate)
    {
        $this->country = $country;
        $this->currency = $currency;
        $this->amount = $amount;
        $this->rate = $rate;
        $this->code = $code;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCurrency(): string
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

    public function getCode(): string
    {
        return $this->code;
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
