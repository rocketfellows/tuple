<?php

namespace rocketfellows\tuple\tests\unit;

use PHPUnit\Framework\TestCase;

class TupleTest extends TestCase
{
    public function testInitEmptyTuple(): void
    {
        $tuple = new TestTuple();

        $this->assertEquals(0, $tuple->count());
        $this->assertNull($tuple->current());
        $this->assertFalse($tuple->valid());
        $this->assertNull($tuple->key());
        $this->assertNull($tuple->current());
        $this->assertTrue($tuple->isEmpty());

        $tupleItems = [];

        foreach ($tuple as $item) {
            $tupleItems[] = $item;
        }

        $this->assertEmpty($tupleItems);
    }

    public function testRewindEmptyTuple(): void
    {
        $tuple = new TestTuple();
        $tuple->rewind();

        $this->assertNull($tuple->key());
        $this->assertNull($tuple->current());
    }

    /**
     * @dataProvider getTupleProvidedData
     */
    public function testFilledTuple(array $items): void
    {
        $tuple = new TestTuple(...$items);

        $actualTupleItems = [];

        foreach ($tuple as $item) {
            $actualTupleItems[] = $item;
        }

        $this->assertEquals($items, $actualTupleItems);
    }

    public function getTupleProvidedData(): array
    {
        return [
            [
                'items' => [(new TestTupleItem(1))],
            ],
            [
                'items' => [(new TestTupleItem(1)), (new TestTupleItem(2)),],
            ],
            [
                'items' => [(new TestTupleItem(1)), (new TestTupleItem(2)), (new TestTupleItem(3)),],
            ],
            [
                'items' => [
                    (new TestTupleItem(1)),
                    (new TestTupleItem(2)),
                    (new TestTupleItem(3)),
                    (new TestTupleItem(4)),
                    (new TestTupleItem(5)),
                    (new TestTupleItem(6)),
                    (new TestTupleItem(7)),
                    (new TestTupleItem(8)),
                    (new TestTupleItem(9)),
                    (new TestTupleItem(10)),
                ],
            ],
        ];
    }

    public function testIterator(): void
    {
        $firstItem = new TestTupleItem(1);
        $secondItem = new TestTupleItem(2);
        $thirdItem = new TestTupleItem(3);

        $tuple = new TestTuple($firstItem, $secondItem, $thirdItem);

        $this->assertEquals($firstItem->getId(), $tuple->current()->getId());

        $tuple->rewind();
        $this->assertEquals($firstItem->getId(), $tuple->current()->getId());
        $this->assertEquals(0, $tuple->key());

        $tuple->next();
        $this->assertEquals($secondItem->getId(), $tuple->current()->getId());
        $this->assertEquals(1, $tuple->key());

        $tuple->rewind();
        $this->assertEquals($firstItem->getId(), $tuple->current()->getId());
        $this->assertEquals(0, $tuple->key());

        $tuple->next();
        $tuple->next();
        $this->assertEquals($thirdItem->getId(), $tuple->current()->getId());
        $this->assertEquals(2, $tuple->key());

        $tuple->next();
        $this->assertNull($tuple->current());
        $this->assertNull($tuple->key());
    }
}
