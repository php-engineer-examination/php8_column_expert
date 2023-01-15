<?php
declare(strict_types=1);
error_reporting(-1);

/* 演算子の優先順位 */
// *や/と比較して、+や-は「優先順位が低い」ので、*や/が先に解決される
$int_variable = 1 + 2 * 3;
var_dump($int_variable);
// 括弧をつけると優先順位を明示的にする事ができる
$int_variable = 1 + (2 * 3);
var_dump($int_variable);
$int_variable = (1 + 2) * 3;
var_dump($int_variable);

// 演算子の優先順位で「キャスト(型の相互変換)」は「NULL合体演算子」より上位のため、以下のコードは(おそらくは意図に反した動きをした上に)Warning(PHP7以下だとNotice)を発生させる
$array_variable = [];
$string_variable = (string)$array_variable['key'] ?? 'not find key';
var_dump($string_variable);
// 以下のように括弧をつけておくとWarningを防ぐことができる
$string_variable = (string)($array_variable['key'] ?? 'not find key');
var_dump($string_variable);

/* 代入演算子 */
$variable = 'abc';
var_dump($variable);
// 代入演算子は代入された値を返す
var_dump($variable = 123);

/* 複合演算子 */
// 算術代入演算子
$int_variable = 10;
$int_variable /= 5;
var_dump($int_variable);
// ビット代入演算子
$bit_variable = 0b11111111;
printf("%08s\n", decbin($bit_variable));
$bit_variable >>= 3;
printf("%08s\n", decbin($bit_variable));
// 文字列演算子
$string_variable = 'hello';
$string_variable .= ' PHP';
var_dump($string_variable);
// Null 合体演算子
$array_variable = ['key' => 'in key'];
$array_variable['key'] ??= 'not find key 1';
$array_variable['no key'] ??= 'not find key 2';
var_dump($array_variable);

/* 算術演算子 */
// 四則演算
$int_variable = 1 + 2 * 3 - 4 / 5;
var_dump($int_variable);
$division_variable = 3 / 4;
var_dump($division_variable);
$division_variable = 4 / 2; // 左右辺がintかつ割り切れる場合はint型になる
var_dump($division_variable);
$division_variable = 4 / 2.0;
var_dump($division_variable);
$int_variable = 2 ** 4;
var_dump($int_variable);
/* 加算子/減算子 */
// 前置
$int_variable = 0;
var_dump(++$int_variable);
var_dump($int_variable);
// 後置
$int_variable = 0;
var_dump($int_variable++);
var_dump($int_variable);
// 文字列への加算子
$string_variable = 'a';
$string_variable ++;
var_dump($string_variable);
// zの次は(ASCIIコードベースの次である [ ではなく)aaとなる
$string_variable = 'z';
$string_variable ++;
var_dump($string_variable);
// 「a-z、A-Z、そして 0-9」以外の文字はサポートされていません(警告等も出ないが文字列に変化もない)
$string_variable = '@';
$string_variable ++;
var_dump($string_variable);

/* ビット演算子 */
// 論理和
$bit_variable = 0b10101010;
var_dump($bit_variable);
printf("%08s\n", decbin($bit_variable));
$bit_variable = $bit_variable | 0b11110000;
var_dump($bit_variable);
printf("%08s\n", decbin($bit_variable));
// 排他的論理和
$bit_variable = 0b10101010;
var_dump($bit_variable);
printf("%08s\n", decbin($bit_variable));
$bit_variable = $bit_variable ^ 0b11111111;
var_dump($bit_variable);
printf("%08s\n", decbin($bit_variable));
// ビットシフト
$bit_variable = 0b11111111;
var_dump($bit_variable);
printf("%08s\n", decbin($bit_variable));
$bit_variable = $bit_variable >> 4;
var_dump($bit_variable);
printf("%08s\n", decbin($bit_variable));
// PHPのシフト演算子の桁あふれ
// 符号ビットが0(正の数)の時の左右のシフト
$bit_variable = PHP_INT_MAX;
var_dump($bit_variable);
printf("%064s\n", decbin($bit_variable));
$bit_variable = $bit_variable << 1;
var_dump($bit_variable);
printf("%064s\n", decbin($bit_variable));
$bit_variable = PHP_INT_MAX;
var_dump($bit_variable);
printf("%064s\n", decbin($bit_variable));
$bit_variable = $bit_variable >> 1;
var_dump($bit_variable);
printf("%064s\n", decbin($bit_variable));
// 符号ビットが1(負の数)の時の左右のシフト
$bit_variable = PHP_INT_MIN;
var_dump($bit_variable);
printf("%064s\n", decbin($bit_variable));
$bit_variable = $bit_variable << 1;
var_dump($bit_variable);
printf("%064s\n", decbin($bit_variable));
$bit_variable = PHP_INT_MIN;
var_dump($bit_variable);
printf("%064s\n", decbin($bit_variable));
$bit_variable = $bit_variable >> 1;
var_dump($bit_variable);
printf("%064s\n", decbin($bit_variable));
