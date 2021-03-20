<?php

namespace CnbApi\Tests\Utils;

use CnbApi\Utils\Date;
use DateTime;
use PHPUnit\Framework\TestCase;

final class DateTest extends TestCase
{
    public function testNormalize(): void
    {
        $expected = '1104537600';

        $values = [
            '2005-01-01',
            '2005-01-01 03:00',
            '2005-01-01 05:00:01',
            '2005-01-01 00:00:03',
            '2005-01-01 10:39:00',
        ];

        foreach ($values as $value) {
            $date = new DateTime($value);
            $normalize = Date::normalize($date);
            self::assertEquals($expected, $normalize->format('U'));
        }
    }
}
