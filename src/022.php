<?php
declare(strict_types=1);
error_reporting(-1);

class Hoge
{
    public function __construct(
        private Foo $foo,
    ) {
    }
    //
    public function setNumFromFoo(int $i)
    {
        $this->foo->num = $i;
    }
}
class Foo extends stdClass
{
}

class HogeClone
{
    public function __construct(
        private Foo $foo,
    ) {
    }
    //
    public function setNumFromFoo(int $i)
    {
        $this->foo->num = $i;
    }
    public function __clone()
    {
        $this->foo = clone $this->foo;
    }
}

/* clone キーワード  */
// インスタンス(オブジェクト)を、単純に代入式(`=`)で代入すると、同じインスタンスへのアクセスになります。  
$fobj = new Foo();
$fobj_2 = $fobj;
$fobj->num = 999;
var_dump($fobj, $fobj_2);

// インスタンスのコピーを作成したい場合、clone キーワードを使う必要があります。  
$fobj = new Foo();
$fobj_2 = clone $fobj;
$fobj->num = 999;
var_dump($fobj, $fobj_2);

/* シャローコピー(浅いコピー) */
// インスタンス(A)の中に別のインスタンス(B)がある場合、インスタンスBは「代入式(`=`)での代入」となります。これはシャローコピー(浅いコピー)と呼ばれ、PHP以外でも多くの言語で発生します。  
$hobj = new Hoge(new Foo());
$hobj_2 = clone $hobj;
$hobj->setNumFromFoo(999);
var_dump($hobj, $hobj_2);

/* 「ディープコピー(深いコピー)」 と __clone() マジックメソッド */
// PHPでディープコピーを実装する場合、__clone() マジックメソッドを使用します。
$hobj = new HogeClone(new Foo());
$hobj_2 = clone $hobj;
$hobj->setNumFromFoo(999);
var_dump($hobj, $hobj_2);

