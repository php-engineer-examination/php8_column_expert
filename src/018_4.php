<?php
declare(strict_types=1);
error_reporting(-1);

/* マジックメソッド */
class TestClass
{
    // プロパティ
    private string $str = '';

    // コンストラクタ
    public function __construct($str)
    {
        $this->str = $str;
    }
    // デストラクタ
    public function __destruct()
    {
        echo __METHOD__ , "\n";
    }
    // 「アクセス不能プロパティ」への代入
    public function __set(string $name, mixed $value): void
    {
        echo "アクセス不能プロパティ{$name}に以下の値を代入しようとしました\n";
        var_dump($value);
    }
    // 「アクセス不能プロパティ」への参照
    public function __get(string $name)
    {
        echo "アクセス不能プロパティ{$name}の値を取得しようとしました\n";
    }
    // 「アクセス不能メソッド」のcall
    public function __call(string $name, array $arguments)
    {
        echo "アクセス不能メソッド{$name}を呼び出しました。引数は以下の通り\n";
        var_dump($arguments);
    }
    // 検証用のprivateメソッド
    private function privateFunc()
    {
        echo __METHOD__ , "\n";
    }
}
// インスタンス(オブジェクト)の生成
$object = new TestClass('unchanged value');
// 未定義のプロパティへのアクセス
$object->hoge = 10;
echo $object->hoge;
// privateプロパティへのアクセス
$object->str = 'abc';
echo $object->str;

// 未定義メソッドのcall
$object->hoge(1, '2nd', false);

// privateメソッドのcall
$object->privateFunc();

// コンストラクタはマジックメソッドであるため結局は「メソッド」なので、callしようと思えばcall出来てしまう
var_dump($object);
$object->__construct('CHANGED VALUE');
var_dump($object);
