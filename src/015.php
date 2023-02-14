<?php
declare(strict_types=1);
error_reporting(-1);

// 「PHPがサポートしている単一の型のうち、resource型以外(null,bool,int,float,string,array,object)」の型宣言をすることができます。  
function funcTypeDeclarations(
    bool $bool_type,
    int $int_type,
    float $float_type,
    string $string_type,
    array $array_type,
    object $object_type,
    )
{
    var_dump($bool_type, $int_type, $float_type, $string_type, $array_type, $object_type);
}
// 引数の型が合致していれば普通にcallできます
funcTypeDeclarations(bool_type: true, int_type: 10, float_type: 3.14, string_type: 'value', array_type: [], object_type: new stdClass());
// strict_typesが宣言されていて「型が異なる」引数を渡すとエラーになります
//funcTypeDeclarations(bool_type: true, int_type: '10', float_type: 3.14, string_type: 'value', array_type: [], object_type: null);

// 型の前に?を付ける事で、nullable(nullを許容する)型宣言をすることができます。  
function funcNullable(?string $string_value)
{
    var_dump($string_value);
}
// 文字列またはnullを渡す事ができます
funcNullable('string');
funcNullable(null);

// callable を使う事で「関数として呼び出せる(コールバック関数)」値を指定する事ができます。  
function funcCalled()
{
    echo __FUNCTION__ , "\n";
}
class classCalled
{
    public function methodCalled()
    {
        echo __METHOD__ , "\n";
    }
    public static function methodStaticCalled()
    {
        echo __METHOD__ , "\n";
    }
}
class classRunnable
{
    public function __invoke()
    {
        echo __METHOD__ , "\n";
    }
}
function funcCallable(callable $func_name)
{
    var_dump($func_name);
}
// 関数名が指定できます
funcCallable('funcCalled');
// クラスの時は、「クラス名とメソッド名の配列」が指定できます
funcCallable([classCalled::class, 'methodStaticCalled']);
// クラスの時は、「オブジェクトとメソッド名の配列」が指定できます
funcCallable([new classCalled(), 'methodCalled']);
// Closure クラスが指定できます
funcCallable(Closure::fromCallable('funcCalled'));
// __invoke() マジックメソッドを実装したオブジェクトが指定できます
funcCallable(new classRunnable());
// 無名関数が指定できます
funcCallable(function() {
    echo __FUNCTION__ , "\n";
});
// PHP 8.1.0以降なら「第一級callableを生成する記法」が指定できます
// XXX 試験範囲対象外です
// funcCallable(funcCalled(...));

// union型によって「複数の型のうちいずれか」を指定する事ができます。
function funcUnion(int|float $num)
{
    var_dump($num);
}
funcUnion(10);
funcUnion(1.4142);

// union型の一部として false型(bool falseのみが許された型)がサポートされています。  
function funcUnion2(string|false $value)
{
    var_dump($value);
}
funcUnion2('string value');
funcUnion2(false);
// funcUnion2(true); // これはエラーになる

// iterable型によって「foreachによって繰り返しができ、ジェネレータ内でyield fromできる」値を指定する事ができます。  
function funcIterable(iterable $ar)
{
    var_dump($ar);
}
// 配列はIterableです
funcIterable([1, 2, 3]);
// ArrayObject classはIteratorAggregateを継承している(IteratorAggregate はTraversableを継承している)のでIterableです
funcIterable(new ArrayObject());

// mixed型がサポートされました。これは「あらゆる値を受け取る」となり、 `object|resource|array|string|float|int|bool|null` と同等です。  
function funcMixed(mixed $v)
{
    var_dump($v);
}
funcMixed(new stdClass());
funcMixed(fopen(__FILE__, 'r'));
funcMixed([1, 2, 3]);
funcMixed('string');
funcMixed(1.234);
funcMixed(999);
funcMixed(true);
funcMixed(null);

