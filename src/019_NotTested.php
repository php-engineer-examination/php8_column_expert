<?php
declare(strict_types=1);
error_reporting(-1);

/* 読み取り専用プロパティ(PHP 8.1.0 以降) */
class TestClass
{
    // 読み取り専用プロパティに対して、 明示的にデフォルト値を設定することはできません
    // public readonly string $hoge = 'hoge';

    // readonly は、 型付きプロパティ に対してのみ指定できます
    // public readonly $foo;

    // 読み取り専用の static プロパティはサポートされていません
    // public static readonly string $staticHoge;

    public readonly mixed $foo;
    public readonly string $hoge;

    // readonlyプロパティへのデータの代入
    public function init()
    {
        $this->hoge = 'test';
        $this->foo = new stdClass;
    }
}
// イン寸タンスの生成
$object = new TestClass();
// $object->hoge = 'test'; // 初期化できるのは、そのプロパティが宣言された場所と同じスコープに限られます。
$object->init();
var_dump($object->hoge);
// $object->init(); // 「プロパティを初期化した後に値が変更されることを防止」するため、二度目以降の代入はFatal errorになります

// 「宣言と違うスコープ」かつ「二度目以降の代入」なので、二重の意味でエラーになる
// $object->foo = new stdClass;

// しかし「そのオブジェクトの中味」は変更する事ができます
var_dump($object);
$object->foo->bar = 3.14;
var_dump($object);


/* 読み取り専用クラス(PHP 8.2.0 以降) */
// #[\AllowDynamicProperties] // 動的なプロパティは付けられない(このアトリビュートについては下記「動的なプロパティ」参照)
readonly class TestClass2
{
    public mixed $foo;
    public string $hoge;
    // public $bar; // 型宣言がないと「readonlyに出来ない」ので、コンパイル時にFatal errorになる

    // readonlyプロパティへのデータの代入
    public function __construct(string $s)
    {
        $this->hoge = $s;
        $this->foo = new stdClass;
    }
}
// イン寸タンスの生成
$object = new TestClass2('test');
var_dump($object);


/* 動的なプロパティ(PHP 8.2.0 以降) */
class TestClass3
{
}
// イン寸タンスの生成
$object = new TestClass3();
// $object->hoge = 123; // 動的なプロパティをなんの準備もなく作成しようとすると Deprecated エラーとなります

// アトリビュート #[\AllowDynamicProperties] でクラスをマークすると、動的なプロパティが作成できます
#[\AllowDynamicProperties]
class TestClass4
{
}
// イン寸タンスの生成
$object = new TestClass4();
$object->hoge = 123;
var_dump($object);

// stdClassを継承すると、動的なプロパティが作成できます
class TestClass5 extends stdClass
{
}
// イン寸タンスの生成
$object = new TestClass5();
$object->hoge = 456;
var_dump($object);
