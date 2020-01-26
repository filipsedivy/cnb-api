<?php declare(strict_types=1);

namespace CnbApi\Source;

use DateTimeInterface;

interface ISource
{
    public function getByDate(DateTimeInterface $dateTime): string;

    public function getBaseUrl(): string;

    public function getTranslator(): string;
}
