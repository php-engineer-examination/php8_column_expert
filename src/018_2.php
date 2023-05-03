<?php
declare(strict_types=1);
error_reporting(-1);

/* 継承とインタフェースと仮想化とトレイト */
// 継承
class ParentClass
{
}
class ChildClass extends ParentClass
{
}
// オブジェクト(インスタンス)の生成
$object_parent = new ParentClass();
$object_child = new ChildClass();
var_dump($object_parent, $object_child);

// インタフェース
interface SampleInterface
{
    //
    public function interfaceFunc(int $num, string $str);
}
class Sample implements SampleInterface
{
    public function interfaceFunc(int $num, string $str)
    {
        echo __METHOD__ , "\n";
    }
}
// オブジェクト(インスタンス)の生成
// $object_sample_interface = new SampleInterface(); // interfaceはnewできない
$object_sample = new Sample();
var_dump($object_sample);

// 仮想化
abstract class VirtualClass
{
    abstract public function abstractFunc();
    public function testFunc(int $num, string $str)
    {
        echo __METHOD__ , "\n";
    }
}
class ImplementationClass extends VirtualClass
{
    public function abstractFunc()
    {
        echo __METHOD__ , "\n";
    }
}
// オブジェクト(インスタンス)の生成
// $object_virtual = new VirtualClass(); // 仮想クラス(abstractの付いたクラス)はnewできない
$object_implementation = new ImplementationClass();
var_dump($object_implementation);

// トレイト
trait SampleTrait
{
    public function traitFunc()
    {
        echo __METHOD__ , "\n";
    }
}
class InTraitClass
{
    use SampleTrait;
}
// オブジェクト(インスタンス)の生成
// $object_sample_trait = new SampleTrait(); // traitはnewできない
$object_in_trait = new InTraitClass();
var_dump($object_in_trait);

// 混在
// XXX 仮想化は「継承先で実装する」ので、abstract側のクラスを継承元クラスとして使う
class MixedSampleClass extends VirtualClass implements SampleInterface
{
    use SampleTrait;

    public function interfaceFunc(int $num, string $str)
    {
        echo __METHOD__ , "\n";
    }
    public function abstractFunc()
    {
        echo __METHOD__ , "\n";
    }
}
// オブジェクト(インスタンス)の生成
$object = new MixedSampleClass();
// 各メソッドのcall
$object->interfaceFunc(10, 'abc');
$object->abstractFunc();
$object->traitFunc();
