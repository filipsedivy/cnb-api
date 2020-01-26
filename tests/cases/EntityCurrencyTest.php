<?php declare(strict_types=1);

namespace Tests\Cases;

use CnbApi;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../bootstrap.php';

class EntityCurrencyTest extends TestCase
{
    public function testProperties(): void
    {
        $entity = new CnbApi\Entity\Currency('Test', 'TST');

        Assert::type('string', $entity->getName());
        Assert::type('string', $entity->getCode());
    }
}

(new EntityCurrencyTest)->run();
