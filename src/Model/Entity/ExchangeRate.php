<?php declare(strict_types=1);

namespace CnbApi\Model\Entity;

use ArrayIterator;
use CnbApi\Model\Collection;
use Countable;
use DateTime;
use IteratorAggregate;

final class ExchangeRate implements IteratorAggregate, Countable
{
    private DateTime $date;

    private int $serialNumber;

    private Collection $rates;

    public function __construct(DateTime $date, int $serialNumber)
    {
        $this->date = $date;
        $this->serialNumber = $serialNumber;
        $this->rates = new Collection;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function getSerialNumber(): int
    {
        return $this->serialNumber;
    }

    public function getRates(): Collection
    {
        return $this->rates;
    }

    public function addRate(Rate $rate): void
    {
        $this->rates->add($rate);
    }

    public function getIterator(): ArrayIterator
    {
        return $this->getRates()->getIterator();
    }

    public function count(): int
    {
        return $this->getRates()->count();
    }
}
