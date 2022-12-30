<?php
declare(strict_types=1);
error_reporting(-1);

// 配列の作成と型の確認
$array_type_variable = array(1, 2, 3); // 昔からの構文
$array_type_variable = [1, 2, 3]; // 短縮構文(PHP 5.4以降)
// 確認の仕方
var_dump(gettype($array_type_variable));
var_dump(get_debug_type($array_type_variable));
var_dump(is_array($array_type_variable));
var_dump(is_scalar($array_type_variable));

// 数値添字配列(int key)
$int_array_type_variable = [
    1,
    2,
    3,
];
var_dump($int_array_type_variable);
// 一部の要素にだけキーを指定する例
$int_array_type_variable = [
    1,
    2,
    99 => 3,
    4,
];
var_dump($int_array_type_variable);
// 文字添字配列(string key)
$string_array_type_variable = [
    'first' => 1,
    'second' => 2,
    'third' => 3
];
var_dump($string_array_type_variable);
// 混在
$mix_array_type_variable = [
    'first' => 1,
    1,
    'second' => 2,
    2,
    3,
    'third' => 3
];
var_dump($mix_array_type_variable);

// keyは int|string なので、それ以外の値を指定すると、キャストされるかエラー等が発生する
// 結果的に「同じ値のkey」が複数指定された場合、最後の値が有効となる(上書きされる)
$array_type_variable = [
    // 上書きされる塊
    1 => '数値としての1', 
    '1' => '文字としての1', 
    1.5 => '小数1.5', // PHP 8.1以降は"Deprecated: Implicit conversion from float" が出る
    true => 'boolのtrue',
    // 上書きされる塊
    0 => '数値としての0',
    false => 'boolのfalse',
    // 上書きされる塊
    '' => '文字としての空文字',
    null => 'null',
    // キャストが発生しないので重複しない
    '1.5' => '文字としての小数1.5',
    '01' => '文字で01(ゼロイチ)',
    '+1' => '文字としての+1',
    // エラーになる
    // [] => '配列をkeyにする', // Fatal error: Uncaught TypeError: Illegal offset type が出る
    // new stdClass() => 'オブジェクトをkeyにする', // Fatal error: Uncaught TypeError: Illegal offset type が出る
];
var_dump($array_type_variable);

// 配列のデリファレンス
function getArray() {
    return [1, 2, 3];
}
$value = getArray()[0];
var_dump($value);

// 配列の分解
$array_type_variable = [1, 2, 3];
list($first, $second, $third) = $array_type_variable;
var_dump($first, $second, $third);
// PHP 7.1以降
[$first, $second, $third] = $array_type_variable;
var_dump($first, $second, $third);
// 連想配列の分解
$array_type_variable = [
    'first' => 1,
    'second' => 2,
    'third' => 3,
];
['second' => $value] = $array_type_variable;
var_dump($value);

// 配列のアンパック
$array_type_variable_1 = [1, 2, 3];
$array_type_variable_2 = [11, 22, 33];
$array_type_variable = [-111, ...$array_type_variable_1, 555, ...$array_type_variable_2, 999];
var_dump($array_type_variable);

// 連想配列のアンパック(PHP 8.1以降)
if (version_compare(PHP_VERSION, '8.1.0', '>=')) {
    $array_type_variable_1 = ['first' => 1, 'second' => 2];
    $array_type_variable_2 = ['second' => 22, 'third' => 33];
    $array_type_variable = ['first' => -111, ...$array_type_variable_1, ...$array_type_variable_2, 'third' => 33333];
    var_dump($array_type_variable);
} else {
    echo "バージョンが8.1.0未満なので連想配列のアンパックは動かないためスキップ\n";
}
