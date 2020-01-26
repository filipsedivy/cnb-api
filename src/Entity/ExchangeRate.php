<?php declare(strict_types=1);

namespace CnbApi\Entity;

use DateTimeInterface;

class ExchangeRate
{
    /** @var DateTimeInterface */
    private $date;

    /** @var int */
    private $serialNumber;

    /** @var array<Rate> */
    private $rates;

    public function __construct(DateTimeInterface $date, int $serialNumber, array $rates = [])
    {
        $this->date = $date;
        $this->serialNumber = $serialNumber;
        $this->rates = $rates;
    }

    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    public function getSerialNumber(): int
    {
        return $this->serialNumber;
    }

    /**
     * @return array<Rate>
     */
    public function getRates(): array
    {
        return $this->rates;
    }

    public function addRate(Rate $rate): void
    {
        $this->rates[] = $rate;
    }
}
