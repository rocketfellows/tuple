<?php

namespace rocketfellows\tuple\tests\unit;

class TestTupleItem
{
    private $id;

    public function __construct(?int $id = null)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
