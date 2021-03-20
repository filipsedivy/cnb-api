<?php declare(strict_types=1);

namespace CnbApi\Tests\Cache;

use CnbApi\Cache\InMemoryCache;
use CnbApi\Exceptions\EntityNotFoundException;
use DateTime;
use PHPUnit\Framework\TestCase;

final class InMemoryCacheTest extends TestCase
{
    private InMemoryCache $inMemoryCache;

    public function setUp(): void
    {
        $this->inMemoryCache = new InMemoryCache;
        self::assertCount(0, $this->inMemoryCache->getIterator());
        self::assertEquals(0, $this->inMemoryCache->count());
    }

    public function tearDown(): void
    {
        $this->inMemoryCache->clear();
        self::assertCount(0, $this->inMemoryCache->getIterator());
        self::assertEquals(0, $this->inMemoryCache->count());
    }

    public function testSave(): void
    {
        $dates = [
            '2010-05-01',
            '2010-05-01 00:00',
            '2010-05-01 01:00',
            '2010-05-01 05:00',
            '2010-05-01 00:00:01',
        ];

        $this->inMemoryCache->save(new DateTime('2010-05-01 08:00'), ['test']);

        self::assertCount(1, $this->inMemoryCache->getIterator());
        self::assertEquals(1, $this->inMemoryCache->getIterator());

        foreach ($dates as $date) {
            $_date = new DateTime($date);
            self::assertIsArray($this->inMemoryCache->findByDate($_date));
        }
    }

    public function testFindByDate(): void
    {
        $referenceValue = new DateTime('2012-05-01 08:00:04');
        $this->inMemoryCache->save($referenceValue, ['test']);

        $date = new DateTime('2012-05-01');
        self::assertIsArray($this->inMemoryCache->findByDate($date));

        $this->expectException(EntityNotFoundException::class);
        $date = new DateTime('2012-05-02');
        $this->inMemoryCache->findByDate($date);
    }
}
