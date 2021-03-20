<?php declare(strict_types=1);

namespace CnbApi\Source;

use CnbApi\Translator\ITranslator;
use DateTime;

interface ISource
{
    public function createUrl(?DateTime $date = null): string;

    public function getUrl(): string;

    public function getTranslator(?DateTime $date = null): ITranslator;
}
