<?php
declare(strict_types=1);
error_reporting(-1);

/* アクセス権  */
class VisibilityClass
{
    // 定数
    public const PUBLIC_CONST = 'public const';
    protected const PROTECTED_CONST = 'protected const';
    private const PRIVATE_CONST = 'private const';
    // アクセス権が省略されたケース
    const OMIT_CONST = 'omit const';

    // プロパティ
    public $public_variable = 'public variable';
    protected $protected_variable = 'protected variable';
    private $private_variable = 'private variable';
    // アクセス権が省略されたケース
    var $omit_variable = 'omit variable';

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
    // アクセス権が省略されたケース
    function omitFunction(): void
    {
        echo __METHOD__ , "\n";
    }

    // 動作確認用メソッド
    public function test(): void
    {
        // 定数の確認
        var_dump(self::PUBLIC_CONST);
        var_dump(self::PROTECTED_CONST);
        var_dump(self::PRIVATE_CONST);
        var_dump(self::OMIT_CONST);

        // プロパティの確認
        var_dump($this->public_variable);
        var_dump($this->protected_variable);
        var_dump($this->private_variable);
        var_dump($this->omit_variable);

        // メソッドの確認
        $this->publicFunction();
        $this->protectedFunction();
        $this->privateFunction();
        $this->omitFunction();
    }
}
// 継承クラス
class VisibilityClassExtends extends VisibilityClass
{
    // 動作確認用メソッド
    public function testEx(): void
    {
        // 定数の確認
        var_dump(self::PUBLIC_CONST);
        var_dump(self::PROTECTED_CONST);
        // var_dump(self::PRIVATE_CONST); // privateは触れない
        var_dump(self::OMIT_CONST);

        // プロパティの確認
        var_dump($this->public_variable);
        var_dump($this->protected_variable);
        // var_dump($this->private_variable); // privateは触れない
        var_dump($this->omit_variable);

        // メソッドの確認
        $this->publicFunction();
        $this->protectedFunction();
        // $this->privateFunction(); // privateは触れない
        $this->omitFunction();
    }
}

// privateはは、定義したクラスからのみ、アクセスが可能
$object = new VisibilityClass();
$object->test();

// protectedは、定義したクラス、または継承先クラスからのみ、アクセスが可能
$object = new VisibilityClassExtends();
$object->testEx();

// publicはどこからでもアクセスが可能
// アクセス権が書かれない場合、public として定義
// 定数の確認
var_dump(VisibilityClass::PUBLIC_CONST);
// var_dump(VisibilityClass::PROTECTED_CONST); // protectedは触れない
// var_dump(VisibilityClass::PRIVATE_CONST); // privateは触れない
var_dump(VisibilityClass::OMIT_CONST); // アクセス権が書かれない場合はpublic

$object = new VisibilityClass();
// プロパティの確認
var_dump($object->public_variable);
// var_dump($object->protected_variable); // protectedは触れない
// var_dump($object->private_variable); // privateは触れない
var_dump($object->omit_variable); // アクセス権が書かれない場合はpublic

// メソッドの確認
$object->publicFunction();
// $object->protectedFunction(); // protectedは触れない
// $object->privateFunction(); // privateは触れない
$object->omitFunction(); // アクセス権が書かれない場合はpublic
