<?php declare(strict_types=1);

namespace CnbApi\Translator;

use CnbApi\Entity\Country;
use CnbApi\Entity\Currency;
use CnbApi\Entity\ExchangeRate;
use CnbApi\Entity\Rate;
use DateTime;

class CnbTranslator implements ITranslator
{
    /** @var string */
    private $content;

    /** @var ExchangeRate */
    private $entity;

    public function setContent(string $content): ITranslator
    {
        $this->content = $content;

        return $this;
    }

    public function getEntity(): ExchangeRate
    {
        if (!$this->entity instanceof ExchangeRate) {
            $this->createEntity();
        }

        return $this->entity;
    }

    private function createEntity(): void
    {
        $lines = preg_split("/\r\n|\n|\r/", $this->content, -1, PREG_SPLIT_NO_EMPTY);

        preg_match('#([\d]{1,2}\.[\d]{1,2}\.[\d]{4})\W*([\d]{1,3})#', $lines[0], $matches);

        [, $date, $serialNumber] = $matches;

        $entity = new ExchangeRate;
        $entity->setDate(DateTime::createFromFormat('d.m.Y', $date)->setTime(0, 0, 0));
        $entity->setSerialNumber((int)$serialNumber);

        foreach (array_slice($lines, 2) as $line) {
            [$country, $currency, $amount, $code, $rate] = array_map('trim', explode('|', $line));

            $countryEntity = new Country;
            $countryEntity->setName($country);

            $currencyEntity = new Currency;
            $currencyEntity->setName($currency);
            $currencyEntity->setCode($code);

            $rateEntity = new Rate;
            $rateEntity->setCountry($countryEntity);
            $rateEntity->setCurrency($currencyEntity);
            $rateEntity->setAmount((int)$amount);
            $rateEntity->setRate((float)str_replace(',', '.', $rate));

            $entity->addRate($rateEntity);
        }

        $this->entity = $entity;
    }
}
