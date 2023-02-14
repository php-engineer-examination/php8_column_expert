<?php
declare(strict_types=1);
error_reporting(-1);

// デフォルト引数の定義
function funcDefaultArgument(?int $int_value = 999)
{
    var_dump($int_value);
}
funcDefaultArgument(1234);
funcDefaultArgument();
funcDefaultArgument(null); // 関数を呼ぶ時に「明示的にnullを渡す」と、(デフォルト値は使われず)null自体が入る

// 「デフォルト値がある引数」はすべて、デフォルト値がない引数より右側に書く必要があります
// もし上述が守られていない場合、PHP 8.0.0以降は「非推奨」のエラーメッセージが出るようになります(Deprecated: Optional parameter 
function funcDefaultArgument2(?int $int_value = 999, string $str_value)
{
}

// PHP 8.1.0以降であれば、new ClassName() 記法を使ってオブジェクトも指定できます。 
// 試験範囲対象外
/*
function funcDefaultArgumentClass(stdClass $obj = new stdClass())
{
    var_dump($obj);
}
funcDefaultArgumentClass();
*/

// `...` を使うことで可変長引数を扱う事ができます。  
function funcVariableArgList(...$args)
{
    var_dump($args);
    // func_num_args(), func_get_arg(), func_get_args() 関数でも可変長引数を扱う事ができますが、現状この方法は推奨されていません
    var_dump(func_num_args(), func_get_arg(0), func_get_args());
}
funcVariableArgList(1, 2);
funcVariableArgList('string', true);
