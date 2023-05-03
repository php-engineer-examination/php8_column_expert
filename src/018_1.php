<?php
declare(strict_types=1);
error_reporting(-1);

/* クラスの基礎 */
// XXX 「(アクセス権を)指定しない場合のデフォルトはすべて `public`」の確認用にアクセス権をわざと省略していますが、普段書く時は省略しないほうがよいでしょう
class BaseSampleClass
{
    // 定数宣言
    const CONSTANT_VALUE = '定数';

    // 変数(プロパティ)宣言
    // XXX varキーワードが実際に使われることはほとんどありませんが、プロパティの宣言には「少なくともひとつのキーワード」が(型宣言と)変数の宣言の前に必要であるため、「アクセス権を指定しない場合のデフォルト」の確認用に、今回に限り使っています
    var string $str;
    
    // コンストラクタ
    function __construct(string $str_value)
    {
        $this->str = $str_value;
    }

    // 関数(メソッド)宣言
    function testFunc()
    {
        echo __METHOD__, "\n";
        var_dump($this->str);
    }
}
// 定数の使用
var_dump(BaseSampleClass::CONSTANT_VALUE);
// オブジェクト(インスタンス)の作成
$object = new BaseSampleClass('abc');
var_dump($object);
// プロパティへの代入
$object->str = 'test';
// メソッドの呼び出し
$object->testFunc();

/* アクセス権 */
// アクセス権の制限は「定数」「メソッド」「プロパティ」ですべて一緒であるため、プロパティを使って説明します
class CheckPermission
{
    // 各プロパティの宣言
    public int $public_int_value;
    protected int $protected_int_value;
    private int $private_int_value;

    // 「クラス内からプロパティを触る」ためのメソッド
    public function assignVariable()
    {
        // すべてのプロパティをあつかう事ができる
        $this->public_int_value =1;
        $this->protected_int_value =2;
        $this->private_int_value =3;
    }
    // 「同じクラスの別インスタンスからprivateの値をあつかう」ための確認コード
    public function sameClassAnotherInstance(CheckPermission $obj)
    {
        $obj->private_int_value = 123;
    }
}
class CheckPermissionExtends extends CheckPermission
{
    // 「クラス内からプロパティを触る」ためのメソッド
    public function assignVariableExtends()
    {
        // private以外のすべてのプロパティをあつかう事ができる
        $this->public_int_value =111;
        $this->protected_int_value =222;
        // $this->private_int_value =333;
    }
}
// オブジェクト(インスタンス)の作成
$object = new CheckPermission();
// 内部からはすべてのアクセス権をあつかう事ができる
$object->assignVariable();
var_dump($object);
// 外部から触れるのはpublicのみ
$object->public_int_value =11;
// $object->protected_int_value =22; // Fatal error: Uncaught Error: Cannot access protected property CheckPermission::$protected_int_value in ...
// $object->private_int_value =33; // Fatal error: Uncaught Error: Cannot access private property CheckPermission::$private_int_value in
var_dump($object);
// privateは「同じクラス」からならあつかう事ができるので、別インスタンスでもあつかえる
$object2nd = new CheckPermission();
$object2nd->sameClassAnotherInstance($object);
var_dump($object);

// protectedは「自分または継承先のクラス」からあつかう事ができる
$object_extends = new CheckPermissionExtends();
$object_extends->assignVariable();
var_dump($object_extends);
$object_extends->assignVariableExtends();
var_dump($object_extends);


/* コンストラクタとデストラクタ */
class ConstDestTest
{
    public function __construct()
    {
        echo "start \n";
    }
    public function __destruct()
    {
        echo "end \n";
    }
}
// オブジェクト(インスタンス)の作成: コンストラクタの起動タイミング
$object = new ConstDestTest();
sleep(1);
// オブジェクト(インスタンス)を破棄する: デストラクタの起動タイミング
unset($object);
