<?php
declare(strict_types=1);
error_reporting(-1);

/* selfキーワード */
class SelfClass
{
    public const STR = 'string';
    private static int $num = 999;
    
    protected static function tested()
    {
        echo __METHOD__ , "\n";
    }
    public static function test()
    {
        // クラス名を使ってcallする
        SelfClass::tested();

        // selfキーワードを使ってcallする
        self::tested();
        // 定数やプロパティも同様にアクセスできる
        var_dump(self::STR);
        var_dump(self::$num);
    }
}
//
SelfClass::test();

/* 遅延静的束縛 */
/* staticではないクラスでの継承(意図通り、を想定) */
class DynamicHoge
{
    protected function tested()
    {
        echo __METHOD__ , "\n";
    }
    public function test()
    {
        $this->tested();
    }
}
class DynamicFoo extends DynamicHoge
{
    protected function tested()
    {
        echo __METHOD__ , "\n";
    }
}
// test()メソッドで呼ばれるtestedは、DynamicHogeクラス側の実装
(new DynamicHoge())->test();
// test()メソッドで呼ばれるtestedは、DynamicFooクラス側の実装
(new DynamicFoo())->test();


/* staticなクラスでの継承(意図通りではない、を想定) */
class SelfHoge
{
    protected static function tested()
    {
        echo __METHOD__ , "\n";
    }
    public static function test()
    {
        // XXX selfなので「常に自クラス(SelfHoge)」を指し示す
        self::tested();
    }
}
class SelfFoo extends SelfHoge
{
    protected static function tested()
    {
        echo __METHOD__ , "\n";
    }
}
// test()メソッドで呼ばれるtestedは、SelfHogeクラス側の実装(こちらは意図通り)
SelfHoge::test();
// test()メソッドで呼ばれるtestedは、(SelfFooではなく)SelfHogeクラス側の実装(こちらが意図通りではない可能性)
SelfFoo::test();


/* staticなクラスでの継承(意図通り、を想定) */
class StaticHoge
{
    protected static function tested()
    {
        echo __METHOD__ , "\n";
    }
    public static function test()
    {
        // XXX staticなので「どのクラスとして呼ばれたか」を判断する
        static::tested();
    }
}
class StaticFoo extends StaticHoge
{
    protected static function tested()
    {
        echo __METHOD__ , "\n";
    }
}
// test()メソッドで呼ばれるtestedは、SelfHogeクラス側の実装
StaticHoge::test();
// test()メソッドで呼ばれるtestedは、SelfFooクラス側の実装
StaticFoo::test();
