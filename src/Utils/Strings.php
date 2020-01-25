<?php declare(strict_types=1);

namespace CnbApi\Utils;

class Strings
{
    public static function toUpper(string $value): string
    {
        return mb_strtoupper($value, 'UTF-8');
    }
}
