<?php
declare(strict_types=1);
error_reporting(-1);

/* クラス定数(PHP 8.1.0 以降) */
class ParentClass
{
    public final const PUB_FINAL_CONST = 'parent const';
}
class ChildClass extends ParentClass
{
    // PHP 8.1.0 以降では、final として定義されたクラス定数は、子クラスで再定義できません。  
    // public final const PUB_FINAL_CONST = 'child const';
}

/* 初期化時の new の使用(PHP 8.1.0 以降) */
// PHP 8.1.0 以降では、 引数のデフォルト値の初期化時に、new を指定したオブジェクトが使えます。 
class TestClass
{
    // 引数のデフォルト値の初期化時に、new を指定したオブジェクトが使えます。 
    public function __construct(
        private object $obj = new stdClass(),
    ) {
    }
}
//
$object = new TestClass();
var_dump($object);
