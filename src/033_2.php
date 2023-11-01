<?php
declare(strict_types=1);
error_reporting(-1);

//
class AutoloaderTest
{
    public static function loadClassLoader($class)
    {
        echo __METHOD__ , "\n";
        require __DIR__ . '/033_2_include.php';
    }
}

// 今は、`spl_autoload_register()` 関数でオートローダをで登録します。 
// 第一引数に null を渡した場合、デフォルト実装である `spl_autoload()` 関数が登録されます。
spl_autoload_register(null);

// オートローダーは、自分で実装する事もできます。
spl_autoload_register([AutoloaderTest::class, 'loadClassLoader']);

// `spl_autoload_call()` 関数を使って意図的に動かす事や
spl_autoload_call('Test033_2');
var_dump( spl_autoload_functions() );

// `spl_autoload_unregister()` 関数で登録したオートローダーを削除する事もできます
spl_autoload_unregister([AutoloaderTest::class, 'loadClassLoader']);

spl_autoload_call('Test033_2');
var_dump( spl_autoload_functions() );

$obj2 = new Test033_2();
var_dump($obj2);
