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

namespace CnbApi\Loader;

use CnbApi\Entity\ExchangeRate;
use CnbApi\Entity\Country;
use CnbApi\Entity\Currency;

class Convertor
{
    private $content;


    public function __construct($content)
    {
        $this->content = $content;
    }


    /**
     * @return ExchangeRate[]|array
     */
    public function toEntities()
    {
        $entities = array();
        $data = $this->toArray();

        foreach ($data as $row)
        {
            $country = Country::create($row['countryName']);
            $currency = Currency::create($row['currencyName'], $row['currencyCode']);

            $entities[] = ExchangeRate::create(
                $country,
                $currency,
                $row['amount'],
                $row['rate']
            );
        }

        return $entities;
    }


    public function toArray()
    {
        $lines = explode("\n", $this->content);
        unset($lines[0], $lines[1]);

        $data = array();

        foreach ($lines as $line)
        {
            if (empty($line)) continue;

            $columns = explode('|', $line);
            list($countryName, $currencyName, $amount, $currencyCode, $rate) = $columns;

            $data[] = array(
                'countryName' => $countryName,
                'currencyName' => $currencyName,
                'currencyCode' => $currencyCode,
                'amount' => $amount,
                'rate' => $rate
            );
        }

        return $data;
    }
}