<?php
declare(strict_types=1);
namespace PhpexamExpert;
error_reporting(-1);

/* 名前空間の使用法 */
require_once __DIR__ . '/035_1.php';
require_once __DIR__ . '/035_2.php';
require_once __DIR__ . '/035_3.php';

/* 「完全修飾名」を指定する書き方の１つになりますが、「動的なアクセス」も可能です。 */
// 文字列で組み立てる
$class_name = '\\PhpexamExpert' . '\\HogeClass';
$obj = new $class_name();
var_dump($obj);
// 動的なクラス名、関数名あるいは定数名においては修飾名と完全修飾名に差はないので、 先頭のバックスラッシュはなくてもかまいません。
$class_name = 'PhpexamExpert' . '\\HogeClass';
$obj = new $class_name();
var_dump($obj);

// __NAMESPACE__ 定数を使う(現在所属している名前空間名が取得できる)
$class_name = __NAMESPACE__ . '\\HogeClass';
$obj = new $class_name();
var_dump($obj);

// ::class を使った完全修飾クラス名の解決
$class_name = \PhpexamExpert\HogeClass::class;
$obj = new $class_name();
var_dump($obj);

// また、名前空間の名前は、大文字小文字を区別しない事も覚えておきましょう。  
$class_name = '\\phpexamexpert' . '\\HogeClass';
$obj = new $class_name();
var_dump($obj);
