<?php
declare(strict_types=1);
error_reporting(-1);
/* このコードはPHP8.0では動かないので、試験対象外です */

// 3点リーダによる名前付き引数のアンパック
function funcNamed($hoge, $foo, $bar)
{
    var_dump($hoge, $foo, $bar);
}
$param = [
    'bar' => 'bar_val',
    'hoge' => 'hoge_val',
    'foo' => 'foo_val',
];
funcNamed(...$param);

// 名前付き引数に前置された引数のアンパックもできます
// funcNamed( ...$param, bar: 'bar_val_add'); // ただし「アンパックした引数」を上書きする事はできません(Fatal error: Uncaught Error: Named parameter $bar overwrites previous argument in
$param2 = [
    'hoge' => 'hoge_val',
    'foo' => 'foo_val',
];
funcNamed( ...$param2, bar: 'bar_val_add');
// funcNamed(bar: 'bar_val_orverwrite', ...$param); // これはエラーになります(Fatal error: Cannot use argument unpacking after named arguments in)
