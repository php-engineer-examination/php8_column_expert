<?php
declare(strict_types=1);
error_reporting(-1);

// この検索で探すインクルードパスは、`get_include_path()` 関数で確認ができ、`set_include_path()` 関数で(スプリクト実行中だけ)変える事ができます。
var_dump( get_include_path() );

// 今は、`spl_autoload_register()` 関数でオートローダをで登録します。 
// 第一引数に null を渡した場合、デフォルト実装である `spl_autoload()` 関数が登録されます。
// この関数は「クラス名を小文字にして」「.inc および .php を拡張子につけたファイル名のファイルを」「すべてのインクルードパスから」探します。
spl_autoload_register(null);

// `spl_autoload_extensions()` 関数を使って変更する事ができます。  
spl_autoload_extensions(".inc,.phpc");

$obj = new Test();
var_dump($obj);

// `spl_autoload_register()` で登録された関数は、 `spl_autoload_functions()` 関数で確認をする事ができます。  
var_dump( spl_autoload_functions() );
