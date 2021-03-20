<?php declare(strict_types=1);

namespace CnbApi\Source;

use CnbApi\Helpers;
use CnbApi\Translator;
use DateTimeInterface;

class CnbSource
{
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

    public function getTranslator(): string
    {
        return Translator\CnbTranslator::class;
    }

    private function createUrl(DateTimeInterface $dateTime): string
    {
        $dateValue = $dateTime->format('d.m.Y');

        return $this->getBaseUrl() . '?date=' . $dateValue;
    }
}
