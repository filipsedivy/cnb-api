<?php declare(strict_types=1);

namespace CnbApi\Model;

use ArrayIterator;
use CnbApi\Model;
use Countable;
use IteratorAggregate;

final class Collection implements IteratorAggregate, Countable
{
    private array $data;

    public function add(Model\Entity\Rate $rate): void
    {
        $this->data[] = $rate;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->data);
    }

    public function count(): int
    {
        return count($this->data);
    }
}
