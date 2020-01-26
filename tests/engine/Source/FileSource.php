<?php declare(strict_types=1);

namespace Tests\Engine\Source;

use CnbApi;
use CnbApi\Translator;
use DateTimeInterface;

class FileSource implements CnbApi\Source\ISource
{
    public function getByDate(DateTimeInterface $dateTime): string
    {
        // [PHPStan] Fix unused parameter
        $dateTime->format('c');

        return file_get_contents($this->getBaseUrl());
    }

    public function getBaseUrl(): string
    {
        return DATA_DIR . '/denni_kurz.txt';
    }

    public function getTranslator(): string
    {
        return Translator\CnbTranslator::class;
    }
}
