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
use Nette\Caching\Cache;

class ExchangeRateService
{
    /**
     * @param null|DateTime $date
     * @param Cache|null    $cache
     *
     * @return ExchangeRateIterator
     */
    public static function getRates($date = null, Cache $cache = null)
    {
        $date = Helper::fixDateTime($date);

        $content = self::getRatesContent($date, $cache);
        $convertor = new Convertor($content);

        return ExchangeRateIterator::create($convertor->toEntities());
    }


    /**
     * @param null       $date
     * @param Cache|null $cache
     *
     * @return bool|mixed|null|string
     */
    private static function getRatesContent($date = null, Cache $cache = null)
    {
        $date = Helper::fixDateTime($date);

        $key = 'exchange_rates_' . Helper::getDateString($date);

        $value = null;

        if ($cache instanceof Cache)
        {
            $value = $cache->load($key, function (&$dependencies) use ($date) {
                $dependencies[Cache::EXPIRE] = Helper::getTomorrowMidnight($date)->getTimestamp();
                return self::getRatesContent($date);
            });
        }
        else
        {
            $request = new Request($date);
            $loader = new Loader($request);
            $value = $loader->getContent();
        }

        return $value;
    }
}