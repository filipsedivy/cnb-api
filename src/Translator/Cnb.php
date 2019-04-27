<?php

namespace CnbApi\Translator;

use CnbApi\Entity\Country;
use CnbApi\Entity\Currency;
use CnbApi\Entity\ExchangeRate;
use CnbApi\Entity\Rate;

class Cnb implements ITranslator
{
    /** @var string */
    private $content;


    /**
     * @param string $content
     *
     * @return ITranslator
     */
    public function setContent(string $content): ITranslator
    {
        $this->content = $content;

        return $this;
    }


    public function getEntity(): ExchangeRate
    {
        $lines = explode(PHP_EOL, $this->content);

        preg_match('#([\d]{1,2})\.([\d]{1,2})\.([\d]{4})\ \#([\d]+)#', $lines[0], $matches);

        list($header, $day, $month, $year, $index) = $matches;

        $date = new \DateTime();
        $date->setDate($year, $month, $day);
        $date->setTime(0, 0);

        $entity = new ExchangeRate();
        $entity->setDate($date);


        foreach (array_slice($lines, 2) as $line)
        {
            if ($line !== '')
            {
                list($country, $currency, $amount, $code, $rate) = array_map('trim', explode('|', $line));

                $countryEntity = new Country();
                $countryEntity->setName($country);

                $currencyEntity = new Currency();
                $currencyEntity->setName($currency);
                $currencyEntity->setCode($code);

                $rateEntity = new Rate();
                $rateEntity->setCountry($countryEntity);
                $rateEntity->setCurrency($currencyEntity);
                $rateEntity->setAmount((int)$amount);
                $rateEntity->setRate((float)str_replace(',', '.', $rate));

                $entity->addRate($rateEntity);
            }
        }

        return $entity;
    }
}