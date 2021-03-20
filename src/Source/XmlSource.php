<?php declare(strict_types=1);

namespace CnbApi\Source;

use CnbApi\Helpers\Http;
use CnbApi\Translator\ITranslator;
use CnbApi\Translator\XmlTranslator;
use DateTime;

final class XmlSource implements ISource
{
    public function createUrl(?DateTime $date = null): string
    {
        $url = $this->getUrl();

        if ($date) {
            $dateValue = $date->format('d.m.Y');
            $url .= sprintf('?date=%s', $dateValue);
        }

        return $url;
    }

    public function getUrl(): string
    {
        return 'https://www.cnb.cz/cs/financni-trhy/devizovy-trh/kurzy-devizoveho-trhu/kurzy-devizoveho-trhu/denni_kurz.xml';
    }

    public function getContent(?DateTime $date = null): string
    {
        $url = $this->createUrl($date);
        $http = Http::createWithDefaultContextOptions($url);

        return $http->getContent();
    }

    public function getTranslator(?DateTime $date = null): ITranslator
    {
        $content = $this->getContent($date);

        return new XmlTranslator($content);
    }

}
