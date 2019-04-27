<?php

declare(strict_types=1);

use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

class ApplicationTest extends \Tester\TestCase
{
    private $application;


    public function __construct()
    {
        $this->application = new \CnbApi\Application(
            new CnbApi\Source\Cnb(),
            new CnbApi\Translator\Cnb()
        );
    }


    public function testResponse()
    {
        Assert::type(\CnbApi\Entity\Rate::class, $this->application->findRateByCode('EUR'));

        Assert::type(\CnbApi\Entity\Rate::class, $this->application->findRateByCountry('Austrálie'));

        Assert::exception(function () {
            $this->application->findRateByCode('BADCODE');
        }, \CnbApi\InvalidArgumentException::class, "Code 'BADCODE' not found");

        Assert::exception(function () {
            $this->application->findRateByCountry('BADCOUNTRY');
        }, \CnbApi\InvalidArgumentException::class, "Country 'BADCOUNTRY' not found");
    }
}

(new ApplicationTest())->run();