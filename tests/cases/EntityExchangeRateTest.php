<?php declare(strict_types=1);

namespace Tests\Cases;

use CnbApi;
use DateTimeInterface;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../bootstrap.php';

class EntityExchangeRateTest extends TestCase
{
    public function testProperties(): void
    {
        $entity = new CnbApi\Entity\ExchangeRate(new CnbApi\Utils\DateTime('2019-01-01'), 5);

        Assert::type(DateTimeInterface::class, $entity->getDate());
        Assert::type('int', $entity->getSerialNumber());
        Assert::type('array', $entity->getRates());
        Assert::equal($entity->getDate()->format('Y-m-d'), '2019-01-01');
    }
}

(new EntityExchangeRateTest)->run();
