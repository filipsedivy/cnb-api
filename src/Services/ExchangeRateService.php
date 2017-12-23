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

namespace CnbApi\Services;

use CnbApi\Internal\ExchangeRateIterator;
use CnbApi\Internal\Helper;
use CnbApi\Loader\Convertor;
use CnbApi\Loader\Loader;
use CnbApi\Loader\Request;
use DateTime;

class ExchangeRateService
{
    /**
     * @param null|DateTime $date
     *
     * @return ExchangeRateIterator
     */
    public static function getRates($date = null)
    {
        $date = Helper::fixDateTime($date);

        $request = new Request($date);
        $loader = new Loader($request);
        $content = $loader->getContent();
        $convertor = new Convertor($content);

        return ExchangeRateIterator::create($convertor->toEntities());
    }
}