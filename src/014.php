<?php
declare(strict_types=1);
error_reporting(-1);

// 引数の基本は値渡し
function func($num)
{
    echo "in func {$num}\n";
    $num *= 10;
    echo "out func {$num}\n";
}
$global_value = 10;
func($global_value);
var_dump($global_value);

// リファレンス渡しの書式
function funcRef(&$num)
{
    echo "in funcRef {$num}\n";
    $num *= 10;
    echo "out funcRef {$num}\n";
}
$global_value = 10;
funcRef($global_value);
var_dump($global_value);

// オブジェクトは常にリファレンス渡しになる
function funcObject($obj)
{
    $obj->funcAdd = true;
}
$global_object = new stdClass();
var_dump($global_object);
funcObject($global_object);
var_dump($global_object);

// 名前付き引数
function funcNamed($hoge, $foo, $bar)
{
    var_dump($hoge, $foo, $bar);
}
funcNamed(bar: 'bar_val', hoge: 'hoge_val', foo: 'foo_val');

// 3点リーダによるアンパック
function funcUnpacking($i, $j, $k)
{
    var_dump($i, $j, $k);
}
$param = [1, 2, 3];
funcUnpacking(...$param);
// アンパックは全部でなくてもよい
$param2 = [22, 33];
funcUnpacking(11, ...$param2);

