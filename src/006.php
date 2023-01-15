<?php
declare(strict_types=1);
error_reporting(-1);

// global変数とlocal変数
$global_value = 'global'; // global変数
function sampleFunc()
{
    $local_value = 'local'; // local変数
}
// 以下はいずれもエラー(Warning)になる
var_dump($local_value); // Warning: Undefined variable
function sampleFunc2()
{
    var_dump($global_value); // Warning: Undefined variable
}
sampleFunc2();

// globalキーワードと$GLOBALSスーパーグローバル変数
function sampleFunc3()
{
    // $GLOBALSスーパーグローバル変数
    var_dump($GLOBALS['global_value']);
    $GLOBALS['global_value'] = 'global2';
    var_dump($GLOBALS['global_value']);

    // globalキーワード
    $global_value = 'local';
    var_dump($global_value);
    global $global_value; // ここから「グローバル変数の$global_value」を指すようになる
    var_dump($global_value);
    $global_value = 'global3';
    var_dump($global_value);
}
$global_value = 'global'; // global変数
sampleFunc3();
var_dump($global_value);

// static変数
function staticVariable()
{
    // 通常のlocal変数とstatic変数を用意する
    $count_i = 0;
    static $count_j = 0;

    // それぞれインクリメントする
    $count_i ++;
    $count_j ++;
    
    // 表示
    echo "i:{$count_i}, j:{$count_j} \n";
}
staticVariable();
staticVariable();
staticVariable();
// クラスのコンストラクタとデストラクタを使うと、生成と破棄のタイミングがわかりやすいかもしれません
class A
{
    public function __construct()
    {
        echo __METHOD__ , "\n";
    }
    public function __destruct()
    {
        echo __METHOD__ , "\n";
    }
}
// 通常のlocal変数
function nonStaticObject()
{
    $object = null;
    if ($object === null) {
        $object = new A();
    }
}
echo "nonStaticObject start \n";
nonStaticObject();
nonStaticObject();
nonStaticObject();
echo "nonStaticObject end \n";
// static変数
function staticObject()
{
    static $object = null;
    if ($object === null) {
        $object = new A();
    }
}
echo "staticObject start \n";
staticObject();
staticObject();
staticObject();
echo "staticObject end \n";

// 継承されたメソッドのstatic変数を使う場合
class Hoge
{
    public function counter()
    {
        static $count = 0;
        $count ++;
        echo $count , "\n";
    }
}
class Foo extends Hoge
{
}
//
$hoge_object = new Hoge();
$hoge_object->counter();
$hoge_object->counter();
// PHP 8.1未満だと「1，2」、PHP 8.1以降だと「3，4」となる
$foo_object = new Foo();
$foo_object->counter();
$foo_object->counter();
