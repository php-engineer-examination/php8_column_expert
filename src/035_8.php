<?php
declare(strict_types=1);
namespace PhpexamExpert;
error_reporting(-1);

require_once __DIR__ . '/035_1.php';
require_once __DIR__ . '/035_2.php';
require_once __DIR__ . '/035_3.php';

/* 名前解決の流れ */
// 完全修飾名は、そのまま解釈されます(先頭のバックスラッシュは除去されます)
$obj = new \PhpexamExpertPart2\HogeClass();
var_dump($obj);

// 相対名(`namespace` で始まる識別子)は、`namespace` を現在の名前空間に置き換えて解釈します
$obj = new namespace\HogeClass();
var_dump($obj);

// 修飾名( `A\B` のように、先頭にバックスラッシュがなく途中にバックスラッシュがあるもの )の場合
// インポートテーブルがない場合、現在の名前空間を名前の先頭に付加して解釈します
$obj = new SubDir\HogeClass();
var_dump($obj);

// インポートテーブル(use 演算子)がある場合、use演算子の指定に従って解釈します
use PhpexamExpert\SubDir as Sub;
$obj = new Sub\HogeClass();
var_dump($obj);

// 非修飾名(バックスラッシュを含まないもの)の場合
// インポートテーブル(use 演算子)がある場合、use演算子の指定に従って解釈します
use PhpexamExpertPart2\HogeClass as HogeClassPart2;
$obj = new HogeClassPart2();
var_dump($obj);

// インポートテーブルがなく、名前がクラス(やインタフェース、トレイトなどのシンボル)の場合、現在の名前空間を先頭に付加して解釈します
$obj = new HogeClass();
var_dump($obj);

// インポートテーブルがなく、名前が関数や定数を参照している場合
// 現在の名前空間を先頭に付加して解釈します
hogeFunction();

// 「現在の名前空間を先頭に付加して解釈」して存在しない場合、グローバル空間として解釈します
var_dump(PHP_VERSION);
