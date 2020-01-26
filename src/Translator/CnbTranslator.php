<?php declare(strict_types=1);

namespace CnbApi\Translator;

use CnbApi\Entity\Country;
use CnbApi\Entity\Currency;
use CnbApi\Entity\ExchangeRate;
use CnbApi\Entity\Rate;
use CnbApi\Factory;
use DateTime;

class CnbTranslator implements ITranslator
{
    /** @var string|null */
    private $content;

    /** @var ExchangeRate */
    private $entity;

    private $czechRateFactory;

    public function __construct(string $content)
    {
        $this->content = $content;
        $this->czechRateFactory = new Factory\CzechRateFactory;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function isContentEmpty(): bool
    {
        return $this->getContent() === '' || $this->getContent() === null;
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

        $dateTime = DateTime::createFromFormat('d.m.Y', $date)->setTime(0, 0, 0);
        $entity = new ExchangeRate($dateTime, (int)$serialNumber);

        foreach (array_slice($lines, 2) as $line) {
            [$country, $currency, $amount, $code, $rate] = array_map('trim', explode('|', $line));

            $countryEntity = new Country($country);
            $currencyEntity = new Currency($currency, $code);

            $amountValue = (int)$amount;
            $floatValue = (float)str_replace(',', '.', $rate);
            $rateEntity = new Rate($countryEntity, $currencyEntity, $amountValue, $floatValue);

            $entity->addRate($rateEntity);
        }

        // Create czech rate
        $entity->addRate($this->czechRateFactory->create());

        $this->entity = $entity;
    }
}
