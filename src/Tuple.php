<?php

namespace rocketfellows\tuple;

use Countable;
use Iterator;

abstract class Tuple implements Countable, Iterator
{
    protected $data = [];
    public $position;

    public function __construct(...$items)
    {
        foreach ($items as $item) {
            $this->data[] = $item;
        }

        $this->position = (!$this->isEmpty()) ? 0 : $this->position;
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return count($this->data);
    }

    /**
     * @inheritDoc
     */
    public function current()
    {
        return (!$this->isEmpty() && $this->valid()) ? $this->data[$this->position] : null;
    }

    /**
     * @inheritDoc
     */
    public function next(): ?int
    {
        $positionDump = (!$this->isEmpty() && $this->valid()) ? ++$this->position : null;
        $positionDump = ($this->valid()) ? $positionDump : null;
        $this->position = $positionDump;

        return $this->position;
    }

    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }

    /**
     * @inheritDoc
     */
    public function key(): ?int
    {
        return $this->position;
    }

    /**
     * @inheritDoc
     */
    public function valid(): bool
    {
        return isset($this->data[$this->position]);
    }

    /**
     * @inheritDoc
     */
    public function rewind(): void
    {
        $this->position = !$this->isEmpty() ? 0 : null;
    }
}
