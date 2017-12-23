<?php
/**
 * This file is part of the CnbApi package.
 *
 * (c) Filip Sedivy <mail@filipsedivy.cz>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT
 * @author  Filip Sedivy <mail@filipsedivy.cz>
 */

namespace CnbApi\Entity;

class ExchangeRate
{
    /**
     * @var Country
     */
    private $country;


    /**
     * @var Currency
     */
    private $currency;


    /**
     * @var int
     */
    private $amount;


    /**
     * @var float
     */
    private $rate;


    /**
     * @return Country
     */
    public function getCountry()
    {
        return $this->country;
    }


    /**
     * @param Country $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }


    /**
     * @return Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }


    /**
     * @param Currency $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }


    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }


    /**
     * @param int $amount
     */
    public function setAmount($amount)
    {
        $this->amount = intval($amount);
    }


    /**
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }


    /**
     * @param float $rate
     */
    public function setRate($rate)
    {
        $this->rate = $this->fixRate($rate);
    }


    /**
     * @return float|int
     */
    public function getOneRateAmount()
    {
        return $this->getRate() / $this->getAmount();
    }


    /**
     * @param int|float $amount
     *
     * @return float|int
     */
    public function getRateByAmount($amount)
    {
        return $this->getOneRateAmount() * $amount;
    }


    /**
     * @param $value
     *
     * @return float
     */
    private function fixRate($value)
    {
        return floatval(trim(str_replace(',', '.', $value)));
    }


    /**
     * @param Country  $country
     * @param Currency $currency
     * @param          $amount
     * @param          $rate
     *
     * @return ExchangeRate
     */
    public static function create(Country $country, Currency $currency, $amount, $rate)
    {
        $object = new self();
        $object->setCountry($country);
        $object->setCurrency($currency);
        $object->setAmount($amount);
        $object->setRate($rate);
        return $object;
    }


    /**
     * @param array $data
     *
     * @return ExchangeRate
     */
    public static function createFromArray(array $data)
    {
        return self::create(
            $data['country'],
            $data['currency'],
            $data['amount'],
            $data['rate']
        );
    }
}