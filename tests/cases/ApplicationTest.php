<?php declare(strict_types=1);

namespace Tests\Cases;

use CnbApi;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../bootstrap.php';

class ApplicationTest extends TestCase
{
    private $application;

    public function __construct()
    {
        $source = new CnbApi\Source\CnbSource;

        $this->application = new CnbApi\Application($source);
    }

    public function testGetEntity(): void
    {
        Assert::type(CnbApi\Entity\ExchangeRate::class, $this->application->getEntity());
    }

    public function testRateByCountry(): void
    {
        Assert::type(CnbApi\Entity\Rate::class, $this->application->findRateByCountry('USA'));

        Assert::exception(function () {
            $this->application->findRateByCountry('NotExists');
        }, CnbApi\Exceptions\InvalidArgumentException::class, "Country 'NOTEXISTS' not found");
    }
}

(new ApplicationTest)->run();
