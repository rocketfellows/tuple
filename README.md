# Simple tuple implementation

![Code Coverage Badge](./badge.svg)

This component is simple implementation of immutable ordered sequence of elements with strict types.
Which means that once tuple created it can't be immuted. Tuple also provide elements of the same type.

## Installation

```php
composer require rocketfellows/tuple
```
## Usage example

Typed item class:

```php
class TupleItem
{
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
```

Items tuple implementation:

```php
use rocketfellows\tuple\Tuple;

class Items extends Tuple
{
    public function __construct(TupleItem ...$items)
    {
        parent::__construct(...$items);
    }

    public function current(): ?TupleItem
    {
        return parent::current();
    }
}
```

Load tuple and loop through:

```php
$firstTupleItem = new TupleItem(1);
$secondTupleItem = new TupleItem(2);
$thirdTupleItem = new TupleItem(3);

$items = new Items($firstTupleItem, $secondTupleItem, $thirdTupleItem);

foreach ($items as $item) {
    print_r($item->getId());
}
```

Result:

```php
1
2
3
```

## Contributing

Welcome to pull requests. If there is a major changes, first please open an issue for discussion.

Please make sure to update tests as appropriate.