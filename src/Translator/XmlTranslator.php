<?php declare(strict_types=1);

namespace CnbApi\Translator;

use CnbApi\Utils\Strings;
use DateTime;
use DOMDocument;
use DOMElement;

final class XmlTranslator implements ITranslator
{
    private string $data;

    public function __construct(string $data)
    {
        $this->data = $data;
    }

    public function toArray(): array
    {
        $dom = new DOMDocument();
        $dom->loadXML($this->data);

        $domHeader = $dom->getElementsByTagName('kurzy');
        $header = [];

        if ($domHeader->length > 0 && ($elHeader = $domHeader->item(0)) instanceof DOMElement) {
            assert($elHeader instanceof DOMElement);

            if ($elHeader->hasAttribute('datum')) {
                $dateValue = $elHeader->getAttribute('datum');
                $date = DateTime::createFromFormat('d.m.Y', $dateValue)
                    ->setTime(0, 0);

                $header['date'] = $date;
            }

            if ($elHeader->hasAttribute('poradi')) {
                $serialValue = $elHeader->getAttribute('poradi');

                $header['serial'] = (int)$serialValue;
            }
        }

        $domBody = $dom->getElementsByTagName('radek');
        $body = [];

        if ($domBody->length > 0) {
            foreach ($domBody as $elBody) {
                if ($elBody instanceof DOMElement) {
                    $row = [];

                    if ($elBody->hasAttribute('kod')) {
                        $codeValue = $elBody->getAttribute('kod');
                        $row['code'] = Strings::toUpper($codeValue);
                    }

                    if ($elBody->hasAttribute('mena')) {
                        $currencyValue = $elBody->getAttribute('mena');
                        $row['currency'] = $currencyValue;
                    }

                    if ($elBody->hasAttribute('mnozstvi')) {
                        $amountValue = $elBody->getAttribute('mnozstvi');
                        $row['amount'] = (int)$amountValue;
                    }

                    if ($elBody->hasAttribute('kurz')) {
                        $rateValue = $elBody->getAttribute('kurz');
                        $row['rate'] = (float)str_replace(',', '.', $rateValue);
                    }

                    if ($elBody->hasAttribute('zeme')) {
                        $countryValue = $elBody->getAttribute('zeme');
                        $row['country'] = $countryValue;
                    }

                    $body[] = $row;
                }
            }
        }

        return [
            'header' => $header,
            'data' => $body
        ];
    }

    public function getData(): string
    {
        return $this->data;
    }
}
