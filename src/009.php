<?php
declare(strict_types=1);
error_reporting(-1);

/* 比較演算子 */
var_dump(1 === '1');
var_dump(1 == '1');
var_dump(1 !== '1');
var_dump(1 != '1');
var_dump(2 > 2);
var_dump(2 >= 2);
var_dump(1 <> 2);
var_dump(1 != 2);
// 「緩やかな比較」で注意が必要なパターン例
var_dump('1' == '01');
var_dump('10' == '1e1');
var_dump(100 == '1e2');
// PHP7以前ではtrueになっていた「緩やかな比較」
var_dump(0 == 'a');
var_dump(2 == '2a');
var_dump(2 == "\t2a");
// 宇宙船演算子
var_dump(1 <=> 2);
var_dump(2 <=> 2);
var_dump(3 <=> 2);
// 文字列や配列、オブジェクトなども宇宙船演算子で比較できる
var_dump('a' <=> 'b');
var_dump([1, 2] <=> [2, 2]);
var_dump(((object)["a" => "a"]) <=> ((object)["a" => "b"]));

/* 論理演算子 */
var_dump(false || true);
var_dump(true and true);
var_dump(false xor false);
var_dump(!false);
// 短絡評価
function returnTrue(): bool
{
    echo __FUNCTION__ , "\n";
    return true;
}
function returnFalse(): bool
{
    echo __FUNCTION__ , "\n";
    return false;
}
var_dump(returnTrue() || returnFalse()); // これは右辺が評価されない(関数が実行されない)
var_dump(returnFalse() && returnTrue()); // これも右辺が評価されない(関数が実行されない)
// 「&&や||」と「andやor」で優先順位が違う事を確認する
var_dump($bool_value = true && false); // && が評価された結果が代入される
var_dump($bool_value);
var_dump($bool_value = true and false); // trueを代入したあと and が評価される
var_dump($bool_value);

/* 文字列演算子 */
// 基本的な文字列の結合
$string_variable = 'string' . ' ' . 'value';
var_dump($string_variable);
// スカラー型(とNULL型)は、文字列演算子で結合するとすべて文字列になる
$int_variable = 123;
$float_variable = 3.14;
$bool_variable = true;
$null_variable = null;
$string_variable = $int_variable . ':' . $float_variable . ':' . $bool_variable . ':' . $null_variable;
var_dump($string_variable);

/* 配列演算子 */
// 結合: 文字添字配列かつkeyの重複がない場合
$array_variable_1 = [
    'key1' => 'value1',
    'key2' => 'value2',
];
$array_variable_2 = [
    'key3' => 'value333',
    'key4' => 'value444',
];
var_dump($array_variable_1 + $array_variable_2);
// 結合: 文字添字配列かつkeyの重複がある場合
$array_variable_1 = [
    'key1' => 'value1',
    'key2' => 'value2',
];
$array_variable_2 = [
    'key2' => 'value222',
    'key3' => 'value333',
];
var_dump($array_variable_1 + $array_variable_2);
// 結合: 数値添字配列の場合
$array_variable_1 = [
    0 => 1,
    1 => 2,
    2 => 3,
];
$array_variable_2 = [
    0 => 111,
    1 => 222,
    2 => 333,
];
var_dump($array_variable_1 + $array_variable_2);
// 比較
$array_variable_1 = [
    'key1' => '1',
    'key2' => '2',
];
$array_variable_2 = [ // 順番が違う
    'key2' => '2',
    'key1' => '1',
];
$array_variable_3 = [ // 値の型が違う
    'key1' => 1,
    'key2' => 2,
];
// (同等:Equality)緩やかな比較
var_dump($array_variable_1 == $array_variable_2);
var_dump($array_variable_1 == $array_variable_3);
// (同一:Identity) 厳密な比較
var_dump($array_variable_1 === $array_variable_2);
var_dump($array_variable_1 === $array_variable_3);
// 「等しくないこと」の比較
var_dump($array_variable_1 != $array_variable_2);
var_dump($array_variable_1 <> $array_variable_2);
var_dump($array_variable_1 !== $array_variable_2);
