<?php

declare(strict_types=1);

use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

class SourceTest extends \Tester\TestCase
{
    /** @var \CnbApi\Source\Cnb */
    private $source;


    public function __construct()
    {
        $this->source = new \CnbApi\Source\Cnb();
    }


    public function testResponseIsNotEmpty()
    {
        $content = $this->source->getByDate(new DateTime());

        Assert::type('string', $content);
    }
}

(new SourceTest())->run();