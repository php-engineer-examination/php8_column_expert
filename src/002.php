<?php
declare(strict_types=1);
error_reporting(-1);

// bool
$bool_type_variable = true;
var_dump($bool_type_variable);
// trueとfalseの定数は「大文字小文字を区別しない」
$bool_type_variable = TRUE;
var_dump($bool_type_variable);
$bool_type_variable = False;
var_dump($bool_type_variable);
// 確認の仕方
var_dump(gettype($bool_type_variable));
var_dump(get_debug_type($bool_type_variable));
var_dump(is_bool($bool_type_variable));
var_dump(is_scalar($bool_type_variable));

// int
$int_type_variable = 123;
var_dump($int_type_variable);
// 16進数表記、8進数表記、2進数表記
$int_type_variable = 0xff;
var_dump($int_type_variable);
$int_type_variable = 0123;
var_dump($int_type_variable);
$int_type_variable = 0b111;
var_dump($int_type_variable);
// int型で扱える範囲
var_dump(PHP_INT_SIZE, PHP_INT_MAX, PHP_INT_MIN);
// int型で扱える範囲を超えた時の挙動(型がfloatになる)
$int_type_variable = PHP_INT_MAX + 1;
var_dump($int_type_variable);
// 整数リテラルの桁の間にアンダースコア (_) を含める
$int_type_variable = 123_456;
var_dump($int_type_variable);
// 確認の仕方
var_dump(gettype($int_type_variable));
var_dump(get_debug_type($int_type_variable));
var_dump(is_int($int_type_variable));
var_dump(is_long($int_type_variable)); // is_int()へのエイリアス
var_dump(is_integer($int_type_variable)); // is_int()へのエイリアス
var_dump(is_scalar($int_type_variable));

// float(double)
$float_type_variable = 1.23;
var_dump($float_type_variable);
// E表記
$float_type_variable = 123E-1;
var_dump($float_type_variable);
// 桁の間にアンダースコア (_) 
$float_type_variable = 123_456.78;
var_dump($float_type_variable);
// 比較(誤ったやり方)
$float_type_variable_1 = 0.1 + 0.2;
$float_type_variable_2 = 0.3;
var_dump( $float_type_variable_1 === $float_type_variable_2 ); // falseになる
// 比較(推奨されるやり方)
$epsilon = 0.0000000001; // 許容する誤差
var_dump( abs($float_type_variable_1 - $float_type_variable_2) < $epsilon ); // trueになる
// 確認の仕方
var_dump(gettype($float_type_variable_1));
var_dump(get_debug_type($float_type_variable_1));
var_dump(is_float($float_type_variable_1));
var_dump(is_double($float_type_variable_1)); // is_float()へのエイリアス
// var_dump(is_real($float_type_variable_1)); // is_float()へのエイリアス: PHP 7.4.0 で 非推奨、PHP 8.0.0 で 削除
var_dump(is_scalar($float_type_variable_1));

// string
$string_type_variable = "string value";
var_dump($string_type_variable);
// 二重引用符での埋め込みやエスケープ
$int_variable = 123;
$string_type_variable = "test \" \\ {$int_variable} \n";
var_dump($string_type_variable);
// 一重引用符での埋め込みやエスケープ
$string_type_variable = 'test \' \\ {$int_variable} \n';
var_dump($string_type_variable);
// Nowdoc構文は、一重引用符と同じ動きをします
$string_type_variable = <<<'EOD'
test \' \\
{$int_variable} \n
EOD;
var_dump($string_type_variable);
// ヒアドキュメント構文は、二重引用符と同じ動きをします
$string_type_variable = <<<EOD
test \" \\
{$int_variable} \n
EOD;
var_dump($string_type_variable);
// 確認の仕方
var_dump(gettype($string_type_variable));
var_dump(get_debug_type($string_type_variable));
var_dump(is_string($string_type_variable));
var_dump(is_scalar($string_type_variable));
