<?php declare(strict_types=1);

namespace Tests\Cases;

use CnbApi;
use Tester\Assert;
use Tester\TestCase;
use Tests\Engine;

require_once __DIR__ . '/../bootstrap.php';

class EntityRateTest extends TestCase
{
    public function testProperties(): void
    {
        $entity = $this->createEntity();

        Assert::type('int', $entity->getAmount());
        Assert::type('float', $entity->getOneRateAmount());
        Assert::type('float', $entity->getRate());
        Assert::type(CnbApi\Entity\Currency::class, $entity->getCurrency());
        Assert::type(CnbApi\Entity\Country::class, $entity->getCountry());
    }

    private function createEntity(): CnbApi\Entity\Rate
    {
        $country = new CnbApi\Entity\Country('Country');
        $currency = new CnbApi\Entity\Currency('Currency', 'CUR');

        return new CnbApi\Entity\Rate($country, $currency, 1, 1.0);
    }
}

(new EntityRateTest)->run();
