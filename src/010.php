<?php
declare(strict_types=1);
error_reporting(-1);

/* 型演算子 */
class ParentClass
{
}
interface MyInterface
{
}
trait MyTrait
{
}
class MyClass extends ParentClass implements MyInterface
{
    use MyTrait;
}
class NotMyClass
{
}
// 比較
$object = new MyClass();
var_dump($object instanceof ParentClass);
var_dump($object instanceof MyInterface);
var_dump($object instanceof MyTrait);
var_dump($object instanceof MyClass);
var_dump($object instanceof NotMyClass);
// PHP8以降、「括弧で囲まれ、文字列を返す」任意の式が使えるようになった
var_dump(new MyClass() instanceof ('My' . 'Class')); // PHP7以前だとParse errorになる

/* 実行演算子 */
$command = 'uuidgen';
var_dump(`{$command} -r`);
var_dump(shell_exec("{$command} -r"));
// ':'は「何もしない組み込みコマンド」
var_dump(`:`);
var_dump(shell_exec(":"));

/* エラー制御演算子 */
$array_variable = [];
@$array_variable['not key']; // @がなければWarning(PHP7以前だとNotice)が出る
// set_error_handler()にエラーハンドラを設定している場合、PHP7以前は「常に0」だったがPHP8以降は「E_ERROR等の定数の値」を返す
set_error_handler(function() {
    var_dump(error_reporting()); // PHP7以下なら0、PHP8以降は E_ERROR | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR | E_RECOVERABLE_ERROR | E_PARSE となる
});
@$array_variable['not key'];
