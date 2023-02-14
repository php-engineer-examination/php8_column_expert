<?php
declare(strict_types=1);
error_reporting(-1);

// ユーザ定義関数の基本形
function funcName($引数)
{
    // 処理
    return '戻り値';
}

// 大文字と小文字は区別されないので、以下は「関数の二重定義(redeclare)」エラーになる
/*
function FUNCNAME($引数)
{
    // 処理
    return '戻り値';
}
*/

// 引数を渡す事ができる
// 引数が複数の時はカンマで区切る
// PHP 8.0.0以降、引数リストの最後にカンマを付ける事ができるようになった
function func($hoge, $foo, $bar, )
{
    var_dump($hoge, $foo, $bar, );
}
func(1, '2nd', true);
