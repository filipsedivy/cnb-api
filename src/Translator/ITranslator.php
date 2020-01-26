<?php declare(strict_types=1);

namespace CnbApi\Translator;

use CnbApi\Entity\ExchangeRate;

interface ITranslator
{
    public function getContent(): ?string;

    public function isContentEmpty(): bool;

    public function getEntity(): ExchangeRate;
}
