<?php declare(strict_types=1);

namespace Tests\Cases;

use CnbApi;
use DateTime;
use Tester\Assert;
use Tester\TestCase;
use Tests\Engine;

require_once __DIR__ . '/../bootstrap.php';

class ApplicationTest extends TestCase
{
    private $application;

    public function __construct()
    {
        $source = new Engine\Source\FileSource;
        $cache = new CnbApi\Caching\NullCaching;

        $this->application = new CnbApi\Application($source, $cache);
    }

    public function testGetEntity(): void
    {
        $date = new DateTime('2019-05-22');
        Assert::type(CnbApi\Entity\ExchangeRate::class, $this->application->getEntity($date));
    }

    public function testRateByCountry(): void
    {
        $date = new DateTime('2019-05-22');
        Assert::type(CnbApi\Entity\Rate::class, $this->application->findRateByCountry('USA', $date));

        Assert::exception(function () use ($date) {
            $this->application->findRateByCountry('NotExists', $date);
        }, CnbApi\Exceptions\InvalidArgumentException::class, "Country 'NOTEXISTS' not found");
    }

    public function testRateByCode(): void
    {
        $date = new DateTime('2019-05-22');
        Assert::type(CnbApi\Entity\Rate::class, $this->application->findRateByCode('CZK', $date));

        Assert::exception(function () use ($date) {
            $this->application->findRateByCode('TEST', $date);
        }, CnbApi\Exceptions\InvalidArgumentException::class, "Code 'TEST' not found");
    }
}

(new ApplicationTest)->run();
