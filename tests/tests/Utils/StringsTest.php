<?php declare(strict_types=1);

namespace CnbApi\Tests\Utils;

use CnbApi\Utils\Strings;
use PHPUnit\Framework\TestCase;

final class StringsTest extends TestCase
{
    public function testToUpper(): void
    {
        $expected = 'LOREM-IPSUM';

        $values = [
            'lorem-ipsum',
            'LoReM-IpSuM',
            'LOREM-IPSUM',
            'LOrem-Ipsum'
        ];

        foreach ($values as $value) {
            $normalize = Strings::toUpper($value);
            self::assertEquals($expected, $normalize);
        }
    }
}
