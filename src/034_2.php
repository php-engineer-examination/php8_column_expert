<?php
declare(strict_types=1);
error_reporting(-1);

/* __call() と __callStatic() */
class CallTest
{
    // マジックメソッド動作確認用
    private function priFunc()
    {
        echo __METHOD__ , "\n";
    }
    // マジックメソッド動作確認用
    private static function priStaticFunc()
    {
        echo __METHOD__ , "\n";
    }

    // マジックメソッド
    public function __call(string $name, array $arguments)
    {
        echo "run __call() {$name} \n";
        var_dump($arguments);
        if ('priFunc' === $name) {
            $this->priFunc();
        }
    }
    public static function __callStatic(string $name, array $arguments)
    {
        echo "run __callStatic() {$name} \n";
        var_dump($arguments);
        if ('priStaticFunc' === $name) {
            static::priStaticFunc();
        }
    }
}
// オブジェクト(インスタンス)のコンテキストから呼ばれると `__call()` が起動します。  
$object = new CallTest();
$object->test1();
$object->test2(1, 'str', 3.14);
$object->priFunc();

// static メソッドのコンテキストから呼ばれると `__callStatic()` が起動します。  
CallTest::testStatic1();
CallTest::testStatic2(1, 'str', 3.14);
CallTest::priStaticFunc();


/* __get() と __set() */
class SetGet
{
    private int $num = 0;
    private array $data = [];

    public function __get(string $name): mixed
    {
        echo "run __get() {$name} \n";
        if ('num' === $name) {
            return $this->num;
        } else {
            return $this->data[$name] ?? null;
        }
    }
    public function __set(string $name, mixed $value): void
    {
        echo "run __set() {$name} \n";
        if ('num' === $name) {
            $this->num = $value;
        } else {
            $this->data[$name] = $value;
        }
    }
}
$object = new SetGet();
var_dump($object);
$object->hoge = 'str';
var_dump($object->hoge);
$object->num = 987;
var_dump($object->num);
var_dump($object);

// static なプロパティでは `__get()` や `__set()` は起動しません。
// SetGet::$num2 = 123; //  Access to undeclared static property
// var_dump(SetGet::$num2); //  Access to undeclared static property


/* __isset() と __unset() */
class IsUnSet
{
    private int $num = 0;

    public function __isset(string $name): bool
    {
        echo "run __isset() {$name} \n";
        return true;
    }
    public function __unset(string $name): void
    {
        echo "run __unset() {$name} \n";
    }
}
$object = new IsUnSet();
var_dump( isset($object->num) );
var_dump( isset($object->hoge) );
unset($object->num);
unset($object->hoge);
