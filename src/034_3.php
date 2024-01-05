<?php
declare(strict_types=1);
error_reporting(-1);

/* __clone() */
class Clone1
{
    public function __construct(
        private int $num,
        private string $str,
    ){}

    public function __clone(): void
    {
        $this->num += 456;
        $this->str .= ' add';
    }
}
$object = new Clone1(123, 'str');
$object2 = clone $object;
var_dump($object, $object2);

// 「外からcloneさせたくない」といった意図で、アクセス権を public 以外にする事もできます。
class Clone2
{
    public function __construct(
        private int $num,
        private string $str,
    ){}

    private function __clone(): void
    {
    }

    public function copy(): static
    {
        return clone $this;
    }
}
$object = new Clone2(123, 'str');
// $object2 = clone $object; // Fatal error: Uncaught Error: Call to private Clone2::__clone() from global scope
$object2 = $object->copy();
var_dump($object, $object2);


/* __sleep() と __wakeup() 、__serialize() と __unserialize() */
class SleepWakeup
{
    public function __construct(
        private int $num,
        private float $f,
        private bool $b,
    ){}

    //
    public function __sleep(): array
    {
        return ['num', 'b'];
    }
    public function __wakeup(): void
    {
        $this->f = $this->num / 10;
    }
}
$object = new SleepWakeup(123, 3.14, true);
$object_string = serialize($object);
$object2 = unserialize($object_string);
var_dump($object, $object_string, $object2);

class SerializeUnserialize
{
    public function __construct(
        private int $num,
        private float $f,
        private bool $b,
    ){}

    //
    public function __serialize(): array
    {
        return [
            'num' => $this->num,
            'b' => $this->b,
        ];
    }
    public function __unserialize(array $data): void
    {
        $this->num = $data['num'];
        $this->b = $data['b'];
        $this->f = $this->num / 10;
    }
}
$object = new SerializeUnserialize(123, 3.14, true);
$object_string = serialize($object);
$object2 = unserialize($object_string);
var_dump($object, $object_string, $object2);

// `__sleep()` と `__serialize()` は基本的に「どちらか片方のみが定義されている」事が期待されています。両方とも定義されている場合、`__serialize()` のみが起動します。  
// `__wakeup()` と `__unserialize()` は基本的に「どちらか片方のみが定義されている」事が期待されています。両方とも定義されている場合、`__unserialize()` のみが起動します。  
class SleepWakeupSerializeUnserialize
{
    public function __construct(
        private int $num,
        private float $f,
        private bool $b,
    ){}

    //
    public function __sleep(): array
    {
        echo "run __sleep() \n";
        return ['num', 'b'];
    }
    public function __wakeup(): void
    {
        echo "run __wakeup() \n";
        $this->f = $this->num / 10;
    }

    //
    public function __serialize(): array
    {
        echo "run __serialize() \n";
        return [
            'num' => $this->num,
            'b' => $this->b,
        ];
    }
    public function __unserialize(array $data): void
    {
        echo "run __unserialize() \n";
        $this->num = $data['num'];
        $this->b = $data['b'];
        $this->f = $this->num / 10;
    }
}
echo "serialize start \n";
$object = new SleepWakeupSerializeUnserialize(123, 3.14, true);
$object_string = serialize($object);
$object2 = unserialize($object_string);
echo "end \n";
