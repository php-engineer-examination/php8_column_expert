<?php
declare(strict_types=1);
error_reporting(-1);

/* クラスの基礎 */
class TestClass
{
    public function method()
    {
        echo __METHOD__ , "\n";
    }
}

// クラスをnewする際に、コンストラクタに引数を渡さない時はクラス名の後の括弧を省略する事もできます。  
$object = new TestClass;
var_dump($object);

// また、クラス名には変数を使う事もできます。  
$class_name = 'TestClass';
$object = new $class_name;
$object2 = new $class_name();
var_dump($object, $object2);

// new を任意の式と一緒に使う機能がサポートされました。式は括弧で囲まなければいけません。  
// 1. 「クラス名をreturnする」関数(メソッド)を使う
function getClassName() {
    return 'TestClass';
}
$object = new (getClassName());
var_dump($object);

// 2. 文字列連結を使う
$object = new ('Test' . 'Class');
var_dump($object);


/* プロパティ */
// static でないメソッドを static メソッドとしてコールすると、 Error がスローされるようになりました。  
try {
    TestClass::method();
} catch(\Error $e) {
    echo $e->getMessage();
}

// クラスのプロパティとメソッドは、それぞれ別の "名前空間" に存在するので、 同じ名前のプロパティとメソッドを共存させることもできます。  
class TestClass_2
{
    // プロパティ
    public string $email = '';

    // メソッド
    public function email()
    {
        echo __METHOD__ , "\n";
    }
}
// インスタンスを生成
$object = new TestClass_2();
// メソッドを呼ぶ
$object->email();
// プロパティに代入する
var_dump($object);
$object->email = 'email';
var_dump($object);


/* プロパティの宣言 */
class TestClass_3
{
    // アクセス権 + 型宣言 + 変数の宣言
    private int $accessType;
    // アクセス権 + staticキーワード + 型宣言 + 変数の宣言
    public static int $accessStatickeywordType;

    // アクセス権 + 型宣言 + 変数の宣言 + 初期値
    private int $accessTypeDefault = 0;
    // アクセス権 + staticキーワード + 型宣言 + 変数の宣言 + 初期値
    private static int $accessStatickeywordTypeDefault = 1;

    // アクセス権 + 変数の宣言
    private $access;

    // staticキーワード + 変数の宣言(アクセス権未指定の場合、publicになります)
    static $statickeyword;
    // staticキーワード + 型宣言 + 変数の宣言(アクセス権未指定の場合、publicになります)
    static int $statickeywordType;

    // varキーワード + 変数の宣言(アクセス権未指定の場合、publicになります)
    var $varkeyword;
}
// インスタンスを生成
$object = new TestClass_3();
// staticではないプロパティはこれで確認する
var_dump($object);

// staticなプロパティはこれで確認する
var_dump((new ReflectionClass(TestClass_3::class))->getStaticProperties());

// staticなプロパティは「型宣言がある」かつ「初期値なし」だと表示されないので、ダミーのデータを入れて改めて確認する
TestClass_3::$accessStatickeywordType = -1;
TestClass_3::$statickeywordType = -2;
var_dump((new ReflectionClass(TestClass_3::class))->getStaticProperties());


/* プロパティへのアクセス */
class TestClass_4
{
    public int $number = 0;
}
// インスタンスを生成
$object = new TestClass_4();

// クラスのメソッドからstatic でないプロパティにアクセスするには -> (オブジェクト演算子) を使ってアクセスします
var_dump($object->number);
$object->number = 123;
var_dump($object->number);

// 動的なプロパティ
$object->dynamic = 'add';
var_dump($object->dynamic);

// 動的なプロパティは、 そのインスタンスでのみ使える(他のインスタンスでは使えない)
$object2 = new TestClass_4();
var_dump(isset($object->dynamic), isset($object2->dynamic));
