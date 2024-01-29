<?php
declare(strict_types=1);
error_reporting(-1);

/* 名前空間の使用法 */
require_once __DIR__ . '/035_1.php';
require_once __DIR__ . '/035_2.php';
require_once __DIR__ . '/035_3.php';

// 先頭バックスラッシュ \ で始まる、「完全修飾名」を指定することで、ファイルシステムでいう「絶対パス」のような書き方でアクセスをすることができます。
$obj = new \PhpexamExpert\HogeClass();
var_dump($obj);

$obj = new \PhpexamExpertPart2\HogeClass();
var_dump($obj);

$obj = new \PhpexamExpert\SubDir\HogeClass();
var_dump($obj);

//
\PhpexamExpert\hogeFunction();
\PhpexamExpertPart2\hogeFunction();
\PhpexamExpert\SubDir\hogeFunction();

//
var_dump(\PhpexamExpert\HOGE_CONST);
var_dump(\PhpexamExpertPart2\HOGE_CONST);
var_dump(\PhpexamExpert\SubDir\HOGE_CONST);

