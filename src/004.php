<?php
declare(strict_types=1);
error_reporting(-1);

// null
$null_type_variable = true;
var_dump($null_type_variable);
// nullの定数は「大文字小文字を区別しない」
$null_type_variable = Null;
var_dump($null_type_variable);
// 確認の仕方
var_dump(gettype($null_type_variable));
var_dump(get_debug_type($null_type_variable));
var_dump(is_null($null_type_variable));
var_dump(is_scalar($null_type_variable));

// リソース
$resource_type_variable = fopen(__FILE__, 'r');
// 確認の仕方
var_dump(gettype($resource_type_variable));
var_dump(get_debug_type($resource_type_variable));
var_dump(is_resource($resource_type_variable));
var_dump(get_resource_type($resource_type_variable));
var_dump(is_scalar($resource_type_variable));

// オブジェクト
$object_type_variable = new stdClass();
// 確認の仕方
var_dump(gettype($object_type_variable));
var_dump(get_debug_type($object_type_variable));
var_dump(is_object($object_type_variable));
var_dump(is_scalar($object_type_variable));
// 配列からオブジェクトを作成する
$array_type_variable = [
    'first' => 1,
    'second' => 2,
    'third' => 3
];
$object_type_variable = (object)$array_type_variable;
var_dump($object_type_variable);
var_dump(gettype($object_type_variable));
var_dump(get_debug_type($object_type_variable));

// クラス内での関係を示す相対型
class A
{
    // selfを使った戻り値の指定
    public static function getInstanceSelf(): self
    {
        return new self();
    }
    // staticを使った戻り値の指定
    public static function getInstanceStatic(): static
    {
        return new static();
    }
}
class B extends A
{
    // parentを使った戻り値の指定
    public static function getInstanceParent(): parent
    {
        return new parent();
    }
}
// 上述メソッドの使用
$object_type_variable = A::getInstanceSelf();
var_dump(get_debug_type($object_type_variable));
$object_type_variable = A::getInstanceStatic();
var_dump(get_debug_type($object_type_variable));
//
$object_type_variable = B::getInstanceSelf();
var_dump(get_debug_type($object_type_variable)); // XXX Aクラスのオブジェクトになる点に注意
$object_type_variable = B::getInstanceStatic();
var_dump(get_debug_type($object_type_variable));
$object_type_variable = B::getInstanceParent();
var_dump(get_debug_type($object_type_variable));

