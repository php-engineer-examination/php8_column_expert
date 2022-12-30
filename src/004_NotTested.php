<?php
declare(strict_types=1);
error_reporting(-1);
/* このコードはPHP8.0では動かないので、試験対象外です */

// 列挙型の宣言
enum Fruit
{
     case Akebia;
     case Chestnut;
     case Fig;
     case Mandarin;
}
// 値の取得
$enum_type_value = Fruit::Akebia;
var_dump($enum_type_value === Fruit::Akebia);
var_dump($enum_type_value === Fruit::Fig);
var_dump(gettype($enum_type_value));
var_dump(get_debug_type($enum_type_value));
