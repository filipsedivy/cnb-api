<?php declare(strict_types=1);

namespace CnbApi;

use CnbApi\Entity;
use DateTime;

class Client
{
    /** @var Application */
    private $application;

    public function __construct(?Source\ISource $source = null)
    {
        $source = $source ?? new Source\CnbSource;

        $this->application = new Application($source);
    }

    public function getEntity(?DateTime $date = null): Entity\ExchangeRate
    {
        return $this->getApplication()->getEntity($date);
    }

    public function findRateByCode(string $code, ?DateTime $date = null): Entity\Rate
    {
        return $this->getApplication()->findRateByCode($code, $date);
    }

    public function findRateByCountry(string $country, ?DateTime $date = null): Entity\Rate
    {
        return $this->getApplication()->findRateByCountry($country, $date);
    }

    public function rate(string $from, string $to, float $amount, ?DateTime $date = null): float
    {
        $fromRate = $this->findRateByCode($from, $date)->getRateByAmount($amount);
        $toRate = $this->findRateByCode($to, $date)->getOneRateAmount();

        return $fromRate / $toRate;
    }

    public function getApplication(): Application
    {
        return $this->application;
    }

    public function getSource(): Source\ISource
    {
        return $this->getApplication()->getSource();
    }
}
