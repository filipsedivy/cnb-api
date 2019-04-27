<?php

declare(strict_types=1);

namespace CnbApi\Translator;

use CnbApi\Entity\ExchangeRate;

interface ITranslator
{
    /**
     * @param string $content
     *
     * @return ITranslator
     */
    public function setContent(string $content): self;


    /**
     * @return ExchangeRate
     */
    public function getEntity(): ExchangeRate;
}