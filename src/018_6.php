<?php
declare(strict_types=1);
error_reporting(-1);

/* staticキーワード */
class StaticClass
{
    // staticプロパティ
    public static string $str = '';
    
    // staticメソッド
    public static function staticFunc()
    {
        echo __METHOD__ , "\n";
        var_dump(self::$str);
    }
}
// static プロパティはオブジェクトを生成せずに使います。「静的プロパティ」と呼ばれる事もあります。  
StaticClass::$str = 'string';
var_dump(StaticClass::$str);

//  static メソッドもオブジェクトを生成せずにコールすることができます。「静的メソッド」と呼ばれる事もあります。  
StaticClass::staticFunc();

// staticメソッドはオブジェクト演算子 (->) でもコールできますが、staticプロパティはオブジェクト演算子 (->) からはアクセスできません。  
$object = new StaticClass();
$object->staticFunc();

var_dump($object->str); // "Notice: Accessing static property..." および "Warning: Undefined property ..." が出る(staticなプロパティへのアクセスは出来ない)
