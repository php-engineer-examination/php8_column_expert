<?php
declare(strict_types=1);
error_reporting(-1);

// 可変変数
$hello = 'string hello';
$variable_name = 'hello';
// 波括弧なし
var_dump($$variable_name);
// 波括弧あり
var_dump(${$variable_name});

// プロパティを可変にする
class A
{
    public $hello = 'class hello';
}
$object = new A();
var_dump($object->$variable_name);
var_dump($object->{$variable_name});

// ネストさせる事もできる
$nest_variable_name = 'variable_name';
var_dump(${${$nest_variable_name}});

// 波括弧の中が最終的に文字列であればよい
$array_value = ['variable', 'name'];
//
var_dump(${${"{$array_value[0]}_{$array_value[1]}"}});
var_dump(${${implode('_', $array_value)}});
