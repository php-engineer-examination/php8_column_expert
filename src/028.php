<?php
declare(strict_types=1);
error_reporting(-1);

/* インターフェイス */
// インタフェースは `interface` キーワードを使って宣言します。
interface HogeInterface
{
    // 定数
    public const PUBLIC_CONST = 'public const';
    // アクセス権は、すべて `public` である必要があります
    // protected const PROTECTED_CONST = 'protected const';
    // private const PRIVATE_CONST = 'private const';

    // プロパティ
    // プロパティは書く事ができません
    // public $public_variable = 'public variable';
    // protected $protected_variable = 'protected variable';
    // private $private_variable = 'private variable';

    // メソッド
    // インタフェースに実装を書く事はできません。 
    public function publicFunction(int $num): int|float;
    // アクセス権は、すべて `public` である必要があります
    // protected function protectedFunction(): void;
    // private function privateFunction(): void;
}
interface FooInterface
{
    public function publicFunction(int $num): int|float;
}
// インタフェースを使う時は `implements` 演算子を使います。  
// 複数のインタフェースを継承する場合は、カンマ区切りでの指定になります。
class Hoge implements HogeInterface, FooInterface
{
    // 複数のインタフェースで「同じ名前のメソッド」がある場合、実装を含めて「シグネチャの互換性」のルールに従う必要があります。
    public function publicFunction(int|float $num): int
    {
        echo __METHOD__ , "\n";
        return (int) $num;
    }
}

var_dump(Hoge::PUBLIC_CONST);
$object = new Hoge();
$r = $object->publicFunction(3.14);
var_dump($r);


/* 継承 */
interface HogeExtendsInterface
{
    // 定数
    public const PUBLIC_CONST = 'public const';
}
// インタフェースは、 `extends` 演算子を使って継承する事ができます。  
interface FooExtendsInterface extends HogeExtendsInterface
{
    public function publicFunction(int $num): int|float;
}

class Hoge2
{
    public function func()
    {
        echo __METHOD__ , "\n";
    }
}
// 「インタフェースを使いつつクラスを継承する(`extends` と `implements` を組み合わせる)」事は、可能です。
class Foo2 extends Hoge2 implements FooExtendsInterface
{
    public function publicFunction(int|float $num): int
    {
        echo __METHOD__ , "\n";
        return (int) $num;
    }
}

var_dump( Foo2::PUBLIC_CONST );
$object = new Foo2();
$r = $object->publicFunction(1.4142);
var_dump($r);
$object->func();
