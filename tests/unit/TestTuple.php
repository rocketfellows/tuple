<?php

namespace rocketfellows\tuple\tests\unit;

use rocketfellows\tuple\Tuple;

class TestTuple extends Tuple
{
    public function __construct(TestTupleItem ...$items)
    {
        parent::__construct(...$items);
    }

    public function current(): ?TestTupleItem
    {
        return parent::current();
    }
}
