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

class CnbApi
{

    /**
     * @param DateTime|null $date
     *
     * @return ExchangeRateIterator
     */
    public function getExchangeRates($date = null)
    {
        $date = Helper::fixDateTime($date);
        return ExchangeRateService::getRates($date);
    }

}