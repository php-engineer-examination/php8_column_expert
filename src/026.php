<?php
declare(strict_types=1);
error_reporting(-1);

/* 抽象化 */
// 「抽象化されたメソッド」を含むクラスは、そのクラスも抽象化クラスになります
abstract class VirtualParentClass
{
    // PHPでは、抽象化されたメソッドを作製する事ができます。  
    abstract public function funcA(int $num): int|float;
    abstract protected function funcB(string $str): iterable;
    // priavteアクセス権は継承されないので、abstractにする事ができません
    // abstract private function funcC();

    // 抽象化されていない普通のメソッド(やプロパティ、定数)は、自由に書けます
    public const STR = 'str';

    private int $num = 123;
    
    public function test(): void
    {
        echo __METHOD__ , "\n";
        $r = $this->funcB('str');
        var_dump($r);
    }
}
// 実装は、継承された子クラス(以降)で書く必要があります。  
class ChildClass extends VirtualParentClass
{
    // 実装は、継承された子クラス(以降)で書く必要があります。  
    // 加えて、 オブジェクトの継承 と シグネチャの互換性に関するルール に従わなければいけません。
    public function funcA(int|float $num): int|float
    {
        echo __METHOD__ , "\n";
        var_dump($num);
        return $num * 10;
    }

    protected function funcB(string $str, array $data = []): array
    {
        echo __METHOD__ , "\n";
        var_dump($str, $data);
        return array_merge([$str], $data);
    }
}

// abstract classのインスタンスを作る事はできません
// $object = new VirtualParentClass();

$object = new ChildClass();
$r = $object->funcA(3.14);
var_dump($r);
$object->test();
