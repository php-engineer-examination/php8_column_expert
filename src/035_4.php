<?php
declare(strict_types=1);
namespace PhpexamExpert; // 名前空間を指定します
error_reporting(-1);

/* 名前空間の使用法 */
require_once __DIR__ . '/035_1.php';
require_once __DIR__ . '/035_2.php';
require_once __DIR__ . '/035_3.php';

// 「同じ名前空間に存在する(または、その名前空間の階層構造配下のものを使う)」場合、相対的な書き方でアクセスをすることができます。
$obj = new HogeClass();
var_dump($obj);

$obj = new SubDir\HogeClass();
var_dump($obj);

//
hogeFunction();
SubDir\hogeFunction();

//
var_dump(HOGE_CONST);
var_dump(SubDir\HOGE_CONST);

// 名前空間内で namespace 演算を使うと「現在の名前空間」を明示的に指定する事ができます。クラスでの self 演算子を思い浮かべるとよいでしょう。  
$obj = new namespace\HogeClass();
var_dump($obj);

$obj = new namespace\SubDir\HogeClass();
var_dump($obj);

//
namespace\hogeFunction();
namespace\SubDir\hogeFunction();

//
var_dump(namespace\HOGE_CONST);
var_dump(namespace\SubDir\HOGE_CONST);

