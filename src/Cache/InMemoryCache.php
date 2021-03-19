<?php declare(strict_types=1);

namespace CnbApi\Cache;

use ArrayIterator;
use CnbApi\Exceptions\EntityNotFoundException;
use CnbApi\Utils;
use DateTime;

final class InMemoryCache implements ICache
{
    private array $memory = [];

    public function findByDate(DateTime $date): array
    {
        $date = Utils\Date::normalize($date);

        if (array_key_exists($date->format('U'), $this->memory)) {
            return $this->memory[$date->format('U')];
        }

        throw new EntityNotFoundException(__METHOD__, [$date->format(DateTime::ATOM)]);
    }

    public function save(DateTime $date, array $value, bool $rewrite = false): void
    {
        $date = Utils\Date::normalize($date);

        if ($rewrite === true || !array_key_exists($date->format('U'), $this->memory)) {
            $this->memory[$date->format('U')] = $value;
        }
    }

    public function clear(): void
    {
        $this->memory = [];
    }

    public function count(): int
    {
        return count($this->memory);
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->memory);
    }
}
