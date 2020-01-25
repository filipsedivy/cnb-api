<?php declare(strict_types=1);

namespace CnbApi\Utils;

class DateTime extends \DateTime
{
    public static function now(?\DateTimeZone $dateTimeZone = null): DateTime
    {
        return new self('now', $dateTimeZone);
    }
}
