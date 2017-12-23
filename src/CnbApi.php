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

use CnbApi\Internal\ExchangeRateIterator;
use CnbApi\Services\ExchangeRateService;
use CnbApi\Internal\Helper;
use Nette\Caching\Cache;

class CnbApi
{
    /**
     * @var null|Cache
     */
    private $cache = null;


    /**
     * @param Cache $cache
     */
    public function setCache(Cache $cache)
    {
        $this->cache = $cache;
    }


    /**
     * @param DateTime|null $date
     *
     * @return ExchangeRateIterator
     */
    public function getExchangeRates($date = null)
    {
        $date = Helper::fixDateTime($date);
        return ExchangeRateService::getRates($date, $this->cache);
    }

}