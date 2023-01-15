<?php
declare(strict_types=1);
error_reporting(-1);

// 可変関数
function hoge()
{
    echo __FUNCTION__ , "\n";
}
$function_name = 'hoge';
// 関数の呼び出し(波括弧をつけるとParse errorになる)
$function_name();

// メソッドを可変にする
class A
{
    public function hoge()
    {
        echo __METHOD__ , "\n";
    }
    public static function foo()
    {
        echo __METHOD__ , "\n";
    }
}
$object = new A();
$method_name = 'hoge';
$static_method_name = 'foo';
// メソッドの呼び出し(波括弧をつけてもよい)
$object->$method_name();
$object->{$method_name}();
A::$static_method_name();
A::{$static_method_name}();
