<?php declare(strict_types=1);

namespace Tests\Cases;

use CnbApi\Utils;
use DateTime;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../bootstrap.php';

class UtilsDateTimeTest extends TestCase
{
    public function testNow()
    {
        $now = new DateTime('now');

        Assert::equal($now->format('c'), Utils\DateTime::now()->format('c'));
    }
}

(new UtilsDateTimeTest)->run();
