<?php
declare(strict_types=1);
error_reporting(-1);

/* トレイト */
// トレイトは `trait` キーワードで宣言します。  
trait HogeTrait
{
    // 定数は PHP8.2.0 以降、書く事ができるようになります(試験範囲対象外)。      
    // const STR = 'str';

    // PHP8より前のバージョンでは記述可能なアクセス権に制限がありましたが、PHP8以降は、すべてのアクセス権、抽象化されたメソッド、staticのすべてを書く事ができます。  
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
trait FooTrait {
    // static
    private static int $num = 999;
    public static function staticFunction(): void
    {
        echo __METHOD__ , "\n";
        var_dump( self::$num );
    }
    
    // 抽象化されたメソッド
    abstract public function abstractFunction(): void;
}
class Hoge
{
    // 使う時は、使用したいクラスの中で `use` キーワードで取り込みます。  
    // 複数のトレイトを使う時は、`use` キーワードを並べる他に、カンマ区切りでの指定もできます。  
    // use HogeTrait, FooTrait;
    use HogeTrait;
    use FooTrait;

    public function abstractFunction(): void
    {
        echo __METHOD__ , "\n";
    }
}

// Hogeクラスの使用
Hoge::staticFunction();
$object = new Hoge();
$object->publicFunction();
$object->abstractFunction();


/* トレイトの優先順位 */
trait Priority_1_Trait
{
    public function func_1()
    {
        echo __METHOD__ , "\n";
    }
    public function func_2()
    {
        echo __METHOD__ , "\n";
    }
    public function func_3()
    {
        echo __METHOD__ , "\n";
    }
    public function func_4()
    {
        echo __METHOD__ , "\n";
    }
}
class Priority_1
{
    use Priority_1_Trait;
    public function func_1()
    {
        echo __METHOD__ , "\n";
    }
    public function func_2()
    {
        echo __METHOD__ , "\n";
    }
    public function func_3()
    {
        echo __METHOD__ , "\n";
    }
}
trait Priority_2_Trait
{
    public function func_1()
    {
        echo __METHOD__ , "\n";
    }
    public function func_2()
    {
        echo __METHOD__ , "\n";
    }
}
class Priority_2 extends Priority_1
{
    use Priority_2_Trait;
    public function func_1()
    {
        echo __METHOD__ , "\n";
    }
}

// 確認
$object = new Priority_2();
// 現在のクラスのメンバー
$object->func_1();
// 自身のクラスでuseしたトレイトのメンバー
$object->func_2();
// 継承元のクラスのメンバー
$object->func_3();
// 継承元のクラスでuseしたトレイトのメンバー
$object->func_4();


/* 衝突の解決 */
trait ConflictHogeTrait
{
    public function func_1()
    {
        echo __METHOD__ , "\n";
    }
    public function func_2()
    {
        echo __METHOD__ , "\n";
    }
}
trait ConflictFooTrait
{
    public function func_2()
    {
        echo __METHOD__ , "\n";
    }
    public function func_3()
    {
        echo __METHOD__ , "\n";
    }
}
trait BarTrait
{
    public function prtectedFunc_1()
    {
        echo __METHOD__ , "\n";
    }
    public function prtectedFunc_2()
    {
        echo __METHOD__ , "\n";
    }
}
class ConflictHoge
{
    use ConflictHogeTrait, ConflictFooTrait, BarTrait {
        // func_2()メソッドは ConflictFooTrait の実装を使う
        ConflictFooTrait::func_2 insteadof ConflictHogeTrait;
        // ConflictHogeTrait::func_2() には aliasFunc_2() という別名を付ける
        ConflictHogeTrait::func_2 as aliasFunc_2;

        // また、`as` 演算子でアクセス権の変更をする事もできます。
        BarTrait::prtectedFunc_1 as protected;
        BarTrait::prtectedFunc_2 as protected aliasPrtectedFunc_2;
    }
}

$object = new ConflictHoge();
$object->func_2();
$object->aliasFunc_2();
// アクセス権を protected にしたのでエラーになる
// $object->prtectedFunc_1();
// $object->aliasPrtectedFunc_2();


/* トレイトの中で、別のトレイトを use する事ができます */
trait inUseHogeTrait
{
    public function func_1()
    {
        echo __METHOD__ , "\n";
    }
}
trait inUseFooTrait
{
    // トレイトの中で、別のトレイトを use する事ができます
    use inUseHogeTrait;

    public function func_2()
    {
        echo __METHOD__ , "\n";
    }
}
class inUseHoge
{
    use inUseFooTrait;
}

//
$object = new inUseHoge();
$object->func_1();
$object->func_2();
