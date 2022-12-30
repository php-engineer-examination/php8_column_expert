<?php
declare(strict_types=1);
error_reporting(-1);

/* Callable */
function callbackFunction()
{
    echo __METHOD__ , "\n";
}
class CallbackClass
{
    public static function staticMethod()
    {
        echo __METHOD__ , "\n";
    }
    public function method()
    {
        echo __METHOD__ , "\n";
    }
    public function __invoke()
    {
        echo __METHOD__ , "\n";
    }
}
// Callableな型を引数にする関数
function call(callable $callback)
{
    return call_user_func($callback);
}
// stringの関数名
call('callbackFunction');
// クラス名とメソッド名(string)の配列
call(['CallbackClass', 'staticMethod']);
// クラスオブジェクトとメソッド名(string)の配列
call([new CallbackClass(), 'method']);
// "クラス名::メソッド名"のフォーマットの文字列
call('CallbackClass::staticMethod');
// 無名関数やアロー関数
call(function() { echo __METHOD__ , "\n"; });
var_dump(call(fn() => 2*4));
// __invoke()を実装したクラスのオブジェクト
call(new CallbackClass());

// void
function voidFunction(): void
{
    echo __METHOD__, "\n";
}
var_dump( voidFunction() );

// union型
function unionTypeFunction(int|float $numerical_value)
{
    var_dump($numerical_value);
}
unionTypeFunction(123);
unionTypeFunction(3.141592);
// 
function nullableTypeFunction(?string $nullable_string_value)
{
    var_dump($nullable_string_value);
}
nullableTypeFunction('string');
nullableTypeFunction(null);

// Iterable
function iterableTypeFunction(Iterable $itr)
{
    var_dump($itr);
}
iterableTypeFunction([1, 2, 3]);
iterableTypeFunction(new ArrayObject());

//
function mixedTypeFunction(mixed $value)
{
    var_dump($value);
}
mixedTypeFunction(123);
mixedTypeFunction(1.4142);
mixedTypeFunction('string');
mixedTypeFunction(true);
mixedTypeFunction(null);
mixedTypeFunction(new stdClass());
mixedTypeFunction([]);
mixedTypeFunction(fopen(__FILE__, 'r'));
