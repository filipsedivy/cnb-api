<?php declare(strict_types=1);

namespace CnbApi\Source;

use CnbApi\Translator;
use DateTimeInterface;

interface ISource
{
    public function getByDate(DateTimeInterface $dateTime): string;

    public function getBaseUrl(): string;

    public function getTranslator(): Translator\ITranslator;
}
