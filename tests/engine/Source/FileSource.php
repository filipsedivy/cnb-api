<?php declare(strict_types=1);

namespace Tests\Engine\Source;

use CnbApi;
use CnbApi\Translator;
use DateTimeInterface;

class FileSource implements CnbApi\Source\ISource
{
    private $translator;

    public function getByDate(DateTimeInterface $dateTime): string
    {
        // [PHPStan] Fix unused parameter
        $dateTime->format(DateTimeInterface::ATOM);

        return file_get_contents($this->getBaseUrl());
    }

    public function getBaseUrl(): string
    {
        return DATA_DIR . '/denni_kurz.txt';
    }

    public function getTranslator(): Translator\ITranslator
    {
        if (!$this->translator instanceof Translator\ITranslator) {
            $this->translator = new Translator\CnbTranslator;
        }

        return $this->translator;
    }
}
