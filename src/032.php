<?php
declare(strict_types=1);
error_reporting(-1);

// 簡単な無名クラス
$object = new class() {
    public function test()
    {
        var_dump(__METHOD__);
    }
};
$object->test();

// コンストラクタを持つ無名クラス
$object = new class(123, 'str', [1, 2, 3]) {
    public function __construct(
        private int $num,
        private string $str,
        private array $arr,
    ) {
    }
};
var_dump($object);

// 継承
$object = new class() extends arrayObject {
};
var_dump($object instanceof arrayObject);

// interfaceの継承
$object = new class() implements Countable {
    public function count(): int
    {
        return 0;
    }
};
var_dump($object instanceof Countable);

// trait
trait HogeTrait {
    public function hoge()
    {
        var_dump(__METHOD__);
    }
}
$object = new class() {
    use HogeTrait;
};
$object->hoge();

// 例えば `get_class()` で確認すると、クラス名を得る事ができます
var_dump( get_class($object) );
