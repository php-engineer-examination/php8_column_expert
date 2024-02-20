<?php
declare(strict_types=1);
error_reporting(-1);

// 組み込みの Exception クラスを拡張することで、例外クラスをユーザーが 定義することが可能です。
class HogeException extends Exception
{
}
class FooException extends Exception
{
}

$e_hoge = new HogeException();
$e_foo = new FooException();
var_dump($e_hoge, $e_foo);

/*
// ただし、Throwable インターフェイスを直接実装することはできません。
// Fatal error: Class BarException cannot implement interface Throwable, extend Exception or Error instead in ...
class BarException implements Throwable
{
}
*/

// 例外を複製することはできません。Exception を clone しようとすると 致命的な E_ERROR エラーが発生します。 
$e = new HogeException();
// $e2 = clone $e; // Fatal error: Uncaught Error: Trying to clone an uncloneable object of class ...
// $e2 = unserialize(serialize($e)); // [memo]一応この方法なら複製が(今のところ)作成可能だが、好ましくはないと思われる
