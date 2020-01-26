<?php declare(strict_types=1);

namespace Tests\Cases;

use CnbApi;
use Tester\Assert;
use Tester\TestCase;
use Tests\Engine;

require_once __DIR__ . '/../bootstrap.php';

class CnbTranslatorTest extends TestCase
{
    public function testEmptyContent(): void
    {
        $translator = new CnbApi\Translator\CnbTranslator('');

        Assert::true($translator->isContentEmpty());
    }

    public function testContent(): void
    {
        $translator = new CnbApi\Translator\CnbTranslator('...');

        Assert::false($translator->isContentEmpty());
    }
}

(new CnbTranslatorTest)->run();
