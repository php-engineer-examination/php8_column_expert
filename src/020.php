<?php
declare(strict_types=1);
error_reporting(-1);

/* クラス定数 */
interface ConstantInterface
{
    public const PUBLIC_INTERFACE_CONST = 'interface const';
    // インタフェースで定義できるのはpublicのみ
    // private const PRIVATE_INTERFACE_CONST = 'interface const';
}
class ConstantClass implements ConstantInterface
{
    public const PUBLIC_CONST = 'public const';
    private const PRIVATE_CONST = 'private const';
    // 指定しない場合のデフォルトのアクセス範囲は public
    const DEFAULT_CONST = ['default const'];

    // 計算結果は指定できる
    public const CALCULATION_CONST = 1 + 2;
    // 「関数(メソッド)」などは利用できない
    // public const FUNCTION_CONST = random_int(0, 10);

    // この名前は予約されているので定義できない
    // public const class = 'AAA';
}
// 定数へのアクセス
var_dump(ConstantClass::PUBLIC_INTERFACE_CONST);
var_dump(ConstantClass::PUBLIC_CONST);
// var_dump(ConstantClass::PRIVATE_CONST); // privateなので外からはアクセスできない
var_dump(ConstantClass::DEFAULT_CONST);
var_dump(ConstantClass::CALCULATION_CONST);

// ::classによって「完全修飾クラス名」を得る事ができる。特に「名前空間クラス」のクラス名取得に役立つ
var_dump(ConstantClass::class);


/* コンストラクタとデストラクタ */
class TestClass
{
    // コンストラクタ
    public function __construct()
    {
        echo __METHOD__ , "\n";
    }
    // デストラクタ
    public function __destruct()
    {
        echo __METHOD__ , "\n";
    }
}
// インスタンスの生成(とコンストラクタの暗黙的なcall)
$object = new TestClass();
// インスタンスの破棄(とデストラクタの暗黙的なcall)
unset($object);


/* コンストラクタの引数 */
class TestClass2
{
    private int $num;
    public function __construct(int $i)
    {
        $this->num = $i;
    }
}
// インスタンスの生成(とコンストラクタの暗黙的なcall)
$object = new TestClass2(123);
var_dump($object);


/* コンストラクタ引数のプロモーション(昇格) */
class TestClass3
{
    public function __construct(
        private int $num,
    ) {
    }
}
// インスタンスの生成(とコンストラクタの暗黙的なcall)
$object = new TestClass3(456);
var_dump($object);


/* コンストラクタのアクセス権 */
class TestClass4
{
    // 外部からのnewを禁止する
    private function __construct()
    {
    }
    // インスタンス生成方法の提供
    public static function getInstance()
    {
        static $obj = null;
        if ($obj === null) {
            $obj = new static;
        }
        return $obj;
    }
}
// インスタンスの生成
// $object = new TestClass4(); // コンストラクタがprivateなのでこれはエラーになる
$object = TestClass4::getInstance();
var_dump($object);
// いわゆる「Singletonパターン」であることの確認
$object = TestClass4::getInstance();
var_dump($object);


/* 継承とコンストラクタ/デストラクタ */
class TestClass5 extends TestClass
{
    // コンストラクタ
    public function __construct()
    {
        echo __METHOD__ , "\n";
    }
    // デストラクタ
    public function __destruct()
    {
        echo __METHOD__ , "\n";
    }
}
// インスタンスの生成(とコンストラクタの暗黙的なcall: 親コンストラクタは呼ばれない)
$object = new TestClass5();
// インスタンスの破棄(とデストラクタの暗黙的なcall: 親デストラクタは呼ばれない)
unset($object);

// このように parent:: を使って明示的に呼ぶ
class TestClass6 extends TestClass
{
    // コンストラクタ
    public function __construct()
    {
        parent::__construct();
        echo __METHOD__ , "\n";
    }
    // デストラクタ
    public function __destruct()
    {
        echo __METHOD__ , "\n";
        parent::__destruct();
    }
}
// インスタンスの生成(とコンストラクタの暗黙的なcall)
$object = new TestClass6();
// インスタンスの破棄(とデストラクタの暗黙的なcall)
unset($object);


/* 古いスタイルのコンストラクタ */
class TestClass7
{
    public function TestClass7()
    {
        echo __METHOD__ , "\n";
    }
}
// インスタンスの生成(「クラス名と同じメソッド名」はコンストラクタではなくなったので、コンストラクタ無しとなる)
// PHP7までなら、(Deprecatedが出る事もあるが)コンストラクタとして機能していた
$object = new TestClass7();


/* デストラクタ内でのexit() */
class TestClass8
{
    public function __destruct()
    {
        echo __METHOD__ , "\n";
        // デストラクタの内部で exit() をコールすると、 それ以降のシャットダウンルーチンを実行しない
        exit();
    }
}
// インスタンスの生成
$object = new TestClass8();
$object2 = new TestClass();
$object3 = new TestClass();
$object4 = new TestClass8();
// exit() でスクリプトの実行を止めた場合にもデストラクタはコールされる
echo "call exit()\n";
exit();
