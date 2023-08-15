<?php
declare(strict_types=1);
error_reporting(-1);

/* 継承 */
class ParentClass
{
    // 定数
    public const PUBLIC_CONST = 'public const';
    protected const PROTECTED_CONST = 'protected const';
    private const PRIVATE_CONST = 'private const';

    // プロパティ
    public $public_variable = 'public variable';
    protected $protected_variable = 'protected variable';
    private $private_variable = 'private variable';

    // メソッド
    public function publicFunction(): void
    {
        echo __METHOD__ , "\n";
    }
    protected function protectedFunction(): void
    {
        echo __METHOD__ , "\n";
    }
    private function privateFunction(): void
    {
        echo __METHOD__ , "\n";
    }
}
class ChildClass extends ParentClass
{
    public function protectedTest()
    {
        var_dump(static::PROTECTED_CONST);
        var_dump($this->protected_variable);
        $this->protectedFunction();
    }
}
// 子クラス(サブクラス)は、親クラスから `public` と `protected` の、メソッドや、プロパティや定数をすべて引き継ぎます。  
// そのため、子クラスで定義が無くても親クラスにあれば、使う事ができます。
$object = new ChildClass();
// publicの確認
var_dump(ChildClass::PUBLIC_CONST);
var_dump($object->public_variable);
$object->publicFunction();
// protectedの確認
$object->protectedTest();

/* 上書きの確認 */
class ParentClass2
{
    public function __construct()
    {
    }

    protected function test(int $num, string $str, ChildClass $cobj): int|float|bool
    {
        return true;
    }
}

class ChildClass2_1 extends ParentClass2
{
    // コンストラクタのみ「シグネチャに互換性がある」の例外となります
    public function __construct(int $num, string $str, ChildClass $cobj)
    {
    }

    // 親クラスと子クラスの上書きするメソッドが「同じアクセス権、同じ数、同じ型の引数と戻り値」
    // protected function test(int $num, string $str, ChildClass $cobj): int|float|bool
    protected function test(int $num, string $str, ChildClass $cobj): int|float|bool
    {
        return true;
    }
}

class ChildClass2_2 extends ParentClass2
{
    // アクセス権 に関するルールは、子クラスで緩めることが可能です
    // protected function test(int $num, string $str, ChildClass $cobj): int|float|bool
    public function test(int $num, string $str, ChildClass $cobj): int|float|bool
    {
        return true;
    }
}

class ChildClass2_3 extends ParentClass2
{
    // 共変性とは、子クラスのメソッドが、親クラスの戻り値よりも、より特定の、狭い型を返すことを許すことです。
    // protected function test(int $num, string $str, ChildClass $cobj): int|float|bool
    protected function test(int $num, string $str, ChildClass $cobj): int
    {
        return 0;
    }
}

class ChildClass2_4 extends ParentClass2
{
    // 反変性とは、親クラスのものよりも、より抽象的な、広い型を引数に指定することを許すものです。 
    // protected function test(int $num, string $str, ChildClass $cobj): int|float|bool
    protected function test(int|float $num, string|iterable $data, ParentClass $pobj): int|float|bool
    {
        return true;
    }
}

/* 上書きの確認:NGの例 */
// コメントアウトを外すとエラーになります
class ChildClass2NG extends ParentClass2
{
    // protected function test(int $num, string $str, ChildClass $cobj): int|float|bool

    // 戻り値の指定の有無が異なる場合
    /*
    protected function test(int $num, string $str, ChildClass $cobj)
    {
    }
    */

    // 引数の個数が異なる場合
    /*
    protected function test(int $num): int|float|bool
    {
    }
    protected function test(string $str, ChildClass $cobj, int $num, float $f): int|float|bool
    {
    }
    */

    // 引数の順番が変わる
    /*
    protected function test(int $num, ChildClass $cobj, string $str): int|float|bool
    {
    }
    */

    // アクセス権を狭くする
    /*
    private function test(int $num, string $str, ChildClass $cobj): int|float|bool
    {
    }
    */

    // 共変性(戻り値をより狭くする)の反対
    /*
    protected function test(int $num, string $str, ChildClass $cobj): int|float|bool|array
    {
        return 0;
    }
    */
}
class ChildClass2NG_2 extends ChildClass2_4
{
    // protected function test(int|float $num, string|iterable $data, ParentClass $pobj): int|float|bool

    // 反変性(引数をより広くする)の反対
    /*
    protected function test(int $num, string $str, ChildClass $cobj): int|float|bool
    {
    }
    */
}

/* final */
// クラスをfinal指定
final class FinalParentClass
{
}
/*
// final classを継承する事はできない
class FinaleChildClass extends FinalParentClass
{
}
*/

class FinalParentClass2
{
    // final public const STR = 'str'; // 定数がfinalに出来るのはPHP8.1以降(試験範囲対象外)
    // final public int $num = 0; // プロパティはfinalに出来ない
    final public function test()
    {
    }
}
class FinaleChildClass2 extends FinalParentClass2
{
    // メソッドがfinalなので継承できない
    /*
    public function test()
    {
    }
    */
}
