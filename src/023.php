<?php
declare(strict_types=1);
error_reporting(-1);

/* スコープ定義演算子 */
// クラス定数にアクセスできます
class MyClass
{
    public const STR = 'string';
}
var_dump( MyClass::STR );

// 継承の時、親クラスのメソッドにアクセスする parent:: があります
class Hoge
{
    public function f() {
        echo __METHOD__ , "\n";
    }
    public function g() {
        echo __METHOD__ , "\n";
    }
}
class Foo extends Hoge
{
    public function f() {
        echo __METHOD__ , "\n";
        parent::f();
        parent::g(); // 注)「自メソッド以外」も呼び出しは可能です
    }
    public function g() {
        echo __METHOD__ , "\n";
    }
}
//
$object = new Foo();
$object->f();

/* static キーワード */
class StaticClass
{
    public static string $str = '';
    private static int $num = 999;

    public static function staticFunction()
    {
        echo __METHOD__ , "\n";
        // 内部からstaticなプロパティにアクセスする時は、以下の3種類があります
        // (`self::`、`static::` については、「024 遅延静的束縛」で解説します)
        var_dump( StaticClass::$num );
        var_dump( self::$num );
        var_dump( static::$num );
    }

    public function nonStaticFunction()
    {
        echo __METHOD__ , "\n";
    }
}
// staticなメソッドにアクセスできます
StaticClass::staticFunction();

// staticなプロパティにアクセスできます
StaticClass::$str = 'string';
var_dump( StaticClass::$str );

// 「staticではないメソッド」をスコープ定義演算子で呼びだそうとすると、エラー(Fatal error)になります。  
StaticClass::nonStaticFunction();
