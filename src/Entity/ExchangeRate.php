<?php declare(strict_types=1);

namespace CnbApi\Entity;

use DateTime;

class ExchangeRate
{
    /** @var DateTime */
    private $date;

    /** @var int */
    private $serialNumber;

    /** @var array<Rate> */
    private $rates = [];

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $date): ExchangeRate
    {
        $this->date = $date;

        return $this;
    }

    public function getSerialNumber(): int
    {
        return $this->serialNumber;
    }

    public function setSerialNumber(int $serialNumber): ExchangeRate
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }

    /**
     * @return array<Rate>
     */
    public function getRates(): array
    {
        return $this->rates;
    }

    /**
     * @param array<Rate> $rates
     * @return ExchangeRate
     */
    public function setRates(array $rates): ExchangeRate
    {
        $this->rates = $rates;

        return $this;
    }

    public function addRate(Rate $rate): ExchangeRate
    {
        $this->rates[] = $rate;

        return $this;
    }
}
