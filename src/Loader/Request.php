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

use CnbApi\Internal\Helper;
use DateTime;

class Request
{
    /**
     * @var DateTime|null $date
     */
    private $date = null;


    /**
     * @param DateTime|null $date
     */
    public function __construct($date = null)
    {
        $date = Helper::fixDateTime($date);
        $this->setDate($date);
    }


    /**
     * @param DateTime $value
     *
     * @return $this
     */
    public function setDate($value)
    {
        if (!$value instanceof DateTime)
        {
            throw new \InvalidArgumentException('Date is not instance of DateTime');
        }

        $this->date = $value;
        return $this;
    }


    /**
     * @return string
     */
    public function getUrl()
    {
        $url = Helper::URL;
        if ($this->date instanceof DateTime)
        {
            $date = $this->date->format(Helper::DATE_FORMAT);
            $url .= '?date=' . $date;
        }

        return $url;
    }
}