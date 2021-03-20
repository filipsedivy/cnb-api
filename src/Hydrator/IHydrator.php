<?php declare(strict_types=1);

namespace CnbApi\Hydrator;

interface IHydrator
{
    public function __construct(array $entryData);

    public function result();
}
