<?php declare(strict_types=1);

namespace CnbApi\Utils;

use DateTime;

final class Date
{
    public static function normalize(DateTime $date): DateTime
    {
        return $date->setTime(0, 0);
    }
}
