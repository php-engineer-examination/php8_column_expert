<?php
declare(strict_types=1);
error_reporting(-1);
/* このコードはPHP8.0では動かないので、試験対象外です */

/* Callable */
// Callableな型を引数にする関数
function call(callable $callback)
{
    return call_user_func($callback);
}
// 三点リーダー/三点ドットを使った無名関数の生成
var_dump(call(mt_rand(...)));

// 交差型
function intersectionTypeFunction(IteratorAggregate&ArrayAccess&Countable $object)
{
    var_dump($object);
}
// ArrayObject クラス については https://www.php.net/manual/ja/class.arrayobject.php を参照
// -> class ArrayObject implements IteratorAggregate, ArrayAccess, Serializable, Countable 
intersectionTypeFunction(new ArrayObject([1, 2, 3]));

// never型
function neverTypeFunction(): never
{
    throw new Exception('例外発生');
}
try {
    neverTypeFunction();
    echo "ここは通らない\n";
} catch(Throwable $e) {
    var_dump($e->getMessage());
}

