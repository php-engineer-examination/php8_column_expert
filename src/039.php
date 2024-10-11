<?php
declare(strict_types=1);

class FizzBuzzIterator implements Iterator
{
    private int $position = 1;

    public function __construct(
        private int $limit,
    ){}

    // 現在のFizzBuzzの結果を返す
    public function current(): string
    {
        $value = '';
        if ($this->position % 3 === 0) {
            $value .= 'Fizz';
        }
        if ($this->position % 5 === 0) {
            $value .= 'Buzz';
        }
        return $value === '' ? (string)$this->position : $value;
    }

    // 現在のキー（位置）を返す
    public function key(): int
    {
        return $this->position;
    }

    // 次の要素に進む
    public function next(): void
    {
        ++$this->position;
    }

    // イテレーションを最初から開始
    public function rewind(): void
    {
        $this->position = 1;
    }

    // 現在の位置が有効かどうかを確認（終了条件）
    public function valid(): bool
    {
        return $this->position <= $this->limit;
    }
}

//
$fizzBuzz = new FizzBuzzIterator(20);
foreach ($fizzBuzz as $key => $value) {
    echo "$key: $value\n";
}
echo "\n";

// -----------------------
class FizzBuzzCollection implements IteratorAggregate
{
    public function __construct(
        private int $limit,
    ){}

    // Iteratorを返すメソッドを実装
    public function getIterator(): Traversable
    {
        return new FizzBuzzIterator($this->limit);
    }
}

// 使用例
$fizzBuzz = new FizzBuzzCollection(20);
foreach ($fizzBuzz as $key => $value) {
    echo "$key: $value\n";
}
echo "\n";

// -----------------------
class MyOuterIterator implements OuterIterator
{
    public function __construct(
        private Iterator $iterator,
    ){}

    public function getInnerIterator(): Iterator
    {
        return $this->iterator;
    }

    public function current(): mixed
    {
        return $this->iterator->current();
    }

    public function key(): mixed
    {
        return $this->iterator->key();
    }

    public function next(): void
    {
        $this->iterator->next();
    }

    public function rewind(): void
    {
        $this->iterator->rewind();
    }

    public function valid(): bool
    {
        return $this->iterator->valid();
    }
}

// 元のイテレータ
$iterator = new FizzBuzzIterator(20);
// OuterIteratorでラップ
$outerIterator = new MyOuterIterator($iterator);
foreach ($outerIterator as $key => $value) {
    echo "$key: $value\n";
}
echo "\n";

// 別のイテレータ
$iterator = new ArrayIterator([1, 2, 3, 4, 5]);
// OuterIteratorでラップ
$outerIterator = new MyOuterIterator($iterator);
foreach ($outerIterator as $key => $value) {
    echo "$key: $value\n";
}
echo "\n";


// -----------------------
class FizzBuzzIterator2 implements SeekableIterator
{
    private int $position = 1;

    public function __construct(
        private int $limit,
    ){}

    public function current(): string
    {
        $value = '';
        if ($this->position % 3 === 0) {
            $value .= 'Fizz';
        }
        if ($this->position % 5 === 0) {
            $value .= 'Buzz';
        }
        return $value === '' ? (string)$this->position : $value;
    }

    public function seek(int $offset): void
    {
        if ($this->limit < $offset) {
            throw new OutOfBoundsException("invalid seek position ($offset)");
        }

        $this->position = $offset;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function rewind(): void
    {
        $this->position = 1;
    }

    public function valid(): bool
    {
        return $this->position <= $this->limit;
    }
}

//
$fizzBuzz = new FizzBuzzIterator2(20);

$fizzBuzz->seek(10);
echo "{$fizzBuzz->key()}: {$fizzBuzz->current()} \n";

$fizzBuzz->seek(15);
echo "{$fizzBuzz->key()}: {$fizzBuzz->current()} \n";

echo "\n";

$fizzBuzz = new FizzBuzzIterator2(20);
foreach ($fizzBuzz as $key => $value) {
    echo "$key: $value\n";
}
echo "\n";
