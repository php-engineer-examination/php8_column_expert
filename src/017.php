<?php
declare(strict_types=1);
error_reporting(-1);

// 関数は、return文によって値を返すことができます。  
function funcReturn()
{
    return 'ret value';
}
$r = funcReturn();
var_dump($r);

// リファレンスを返す事もできます。  
function &funcReturnRef()
{
    static $local_data = [];
    $local_data[] = 1;
    var_dump($local_data);
    return $local_data;
}
$data = &funcReturnRef();
$data[] = 999; // funcReturnRef内の「static $local_dataへのリファレンス」にデータを追加する
funcReturnRef();

// 戻り値も、型宣言をする事ができます。  
function funcReturnInt(): int
{
    return 123;
}
funcReturnInt();
// union
function funcReturnIntFloat(): int|float
{
    return 3.14;
}
funcReturnIntFloat();

// void型がサポートされています。これは「値を返さない」事を意味します
function funcReturnVoid(): void
{
    // return 123; // 値を返すとエラー
    return ;
}
funcReturnVoid();

// static型がサポートされました。遅延静的束縛に出てくるstaticと同様で「静的継承のコンテキストで呼び出し元のクラス」が指定されます。  
class classReturn
{
    public static function methodReturnStatic(): static
    {
        // return new stdClass(); // 型が違うのでエラー
        return new static();
    }
}
$obj = classReturn::methodReturnStatic();

// 無名関数
$func = function() {
    echo __FUNCTION__ , "\n";
};
$func();

// 親のスコープから変数を引き継ぐために `use` も用意されています
$global_value = 123;
$func = function() use($global_value) {
    $global_value += 345;
    var_dump($global_value);
};
$func();
var_dump($global_value);

// `use` は値渡しになるので、リファレンスで渡したい場合には&を付ける必要があります
$func = function() use(&$global_value) {
    $global_value += 345;
    var_dump($global_value);
};
$func();
var_dump($global_value);

// クラスの中で無名関数を宣言すると、クラスにバインドされます。そのため、無目関数内で `$this` が使えるようになります。  
class AnonymousClass
{
    public function anonymousMethod()
    {
        return function($num) {
            $this->int_value = $num;
        };
    }
    // プロパティ
    private int $int_value = 0;
}
$obj = new AnonymousClass();
var_dump($obj);
$func = $obj->anonymousMethod();
$func(100);
var_dump($obj);

// それを避けたい時は「static な無名関数」を作成する事もできます。  
class AnonymousClass2
{
    public function anonymousMethod()
    {
        return static function() {
            var_dump(isset($this));
        };
    }
}
$obj = new AnonymousClass2();
$func = $obj->anonymousMethod();
$func();

// アロー関数
// 親のスコープで使える変数が常に自動で使えるので、覚えておきましょう。  
$x = 2;
$func = fn($y, $z) => $x * $y * $z;
$num = $func(3, 4);
var_dump($num);


// 第一級callableを生成する記法(試験範囲対象外)
// callable を使う事で「関数として呼び出せる(コールバック関数)」値を指定する事ができます。  
/*
function funcCalled()
{
    echo __FUNCTION__ , "\n";
}
function funcCallable(callable $func_name)
{
    var_dump($func_name);
}
// PHP 8.1.0以降なら「第一級callableを生成する記法」が指定できます
// XXX 試験範囲対象外です
funcCallable(funcCalled(...));
*/