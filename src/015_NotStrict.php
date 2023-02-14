<?php
error_reporting(-1);

// `declare(strict_types=1);`がない場合、型が指定されているとその型に変換されます
function funcInt(int $num) {
    var_dump($num);
}
// 変換可能な値は整数値に変換される
funcInt(1.234); // Deprecated: Implicit conversion from float 1.234 to int loses precision in という警告が出る
funcInt('10');
funcInt(true);
// 変換ができない場合は Fatal error: Uncaught TypeError となる
// funcInt(null);
// funcInt(fopen(__FILE__, 'r'));
// funcInt(new stdClass());
// funcInt([1, 2, 3]);
