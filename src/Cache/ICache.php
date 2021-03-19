<?php declare(strict_types=1);

namespace CnbApi\Cache;

use DateTime;

interface ICache
{
    public function findByDate(DateTime $date): array;

    public function save(DateTime $date, array $value, bool $rewrite = false): void;

    public function clear(): void;
}
