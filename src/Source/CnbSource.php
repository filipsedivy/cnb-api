<?php declare(strict_types=1);

namespace CnbApi\Source;

use CnbApi\Helpers;
use CnbApi\Translator;
use DateTimeInterface;

class CnbSource implements ISource
{
    /** @var Translator\ITranslator */
    private $translator;

    public function getByDate(DateTimeInterface $dateTime): string
    {
        $url = $this->createUrl($dateTime);

        $http = Helpers\Http::createWithDefaultContextOptions($url);

        return $http->getContent();
    }

    public function getBaseUrl(): string
    {
        return 'https://www.cnb.cz/cs/financni-trhy/devizovy-trh/kurzy-devizoveho-trhu/kurzy-devizoveho-trhu/denni_kurz.txt';
    }

    public function getTranslator(): Translator\ITranslator
    {
        if (!$this->translator instanceof Translator\ITranslator) {
            $this->translator = new Translator\CnbTranslator;
        }

        return $this->translator;
    }

    private function createUrl(DateTimeInterface $dateTime): string
    {
        $dateValue = $dateTime->format('d.m.Y');

        return $this->getBaseUrl() . '?date=' . $dateValue;
    }
}
