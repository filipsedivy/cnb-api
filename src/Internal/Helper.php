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

namespace CnbApi\Internal;

use DateTime;

class Helper
{
    /**
     * @var string
     */
    const DATE_FORMAT = 'j.n.Y';


    /**
     * @var string
     */
    const DATE_FORMAT_FILE = 'j_n_Y';


    /**
     * @var string
     */
    const URL = 'http://www.cnb.cz/cs/financni_trhy/devizovy_trh/kurzy_devizoveho_trhu/denni_kurz.txt';


    /**
     * @param DateTime|null $date
     *
     * @return DateTime
     */
    public static function getTomorrowMidnight($date = null)
    {
        $date = self::fixDateTime($date);
        $date->setTime(0, 0, 0);
        $date->modify('+ 1 day');
        return $date;
    }


    /**
     * @param mixed $input
     *
     * @return DateTime
     */
    public static function fixDateTime($input)
    {
        if (!$input instanceof DateTime)
        {
            $input = new DateTime();
        }

        return $input;
    }


    /**
     * @param mixed  $input
     * @param string $format
     *
     * @return string
     */
    public static function getDateString($input, $format = self::DATE_FORMAT_FILE)
    {
        $date = self::fixDateTime($input);

        return $date->format($format);
    }

}