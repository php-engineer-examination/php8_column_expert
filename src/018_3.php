<?php
declare(strict_types=1);
error_reporting(-1);

/* クラスファイルの読み込みとオートローディング */
// require および require_once は「ファイルがなければFatal error」となる
try {
    require('./dummy');
} catch (Throwable $e) {
    echo $e->getMessage();
}
try {
    require_once('./dummy');
} catch (Throwable $e) {
    echo $e->getMessage();
}

// includeおよびinclude_onceは「ファイルがなくてもWarning」となる(ので、プログラムはそのまま実行され続ける」
include('./dummy');
include_once('./dummy');

// 「定義されていないクラス」を使おうとすると通常は "Fatal error: Uncaught Error: Class "クラス名" not found in ..."となる
try {
    $object = new TestClass();
} catch (Throwable $e) {
    echo $e->getMessage();
}

// spl_autoload_register()で、「未定義のクラスやインタフェースが使われる」時に「自動的に読み込むための処理」を(複数)登録することができる
spl_autoload_register(function(string $class) {
    echo "register 1\n";
});
spl_autoload_register(function(string $class) {
    echo "register 2\n";
});
spl_autoload_register(function(string $class) {
    echo "register 3\n";
    // 本来は「引数の$classから動的にファイル名を生成」する。今回は学習コードなので、いったんファイル名を固定にしてある
    require_once('./018_3_TestClass.php');
});
$object = new TestClass();
var_dump($object);
