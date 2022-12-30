<?php
declare(strict_types=1);
error_reporting(-1);

// ini_setではこのように値を設定します
ini_set('display_errors', '1');

// 設定前後の値は以下のように確認をするとよいでしょう
$new_value = 'Asia/Tokyo';
$original_value = ini_set('date.timezone', $new_value);
var_dump($original_value);

// PHP8.1.0以降、ini_setの第二引数(value) は、 任意のスカラー型を受け入れるようになりました (null を含みます)。 これより前のバージョンでは、文字列のみを受け入れていました。 
if (version_compare(PHP_VERSION, '8.1.0', '>=')) {
    ini_set('display_errors', true); // PHP 8.0系以下だと "Fatal error: Uncaught TypeError: ini_set(): Argument #2 ($value) must be of type string, bool given in ..." となる
} else {
    echo "バージョンが8.1.0未満なので「第二引数がstring以外の時はエラーになる」ので処理をスキップ\n";
}

// ディレクティブによっては「ini_set()では変更できない」ものがあります
// 変更できないものの場合、ini_set()が失敗するので、 bool(false) が返ります
// https://www.php.net/manual/ja/ini.list.php
$r = ini_set('max_file_uploads', '5');
var_dump($r);

// ディレクティブ名をtypoすると戻り値でfalseが返ります。戻り値をきちんと判定するか、「戻り値がfalseなら例外を投げる」といったラッパーを用意するとよいでしょう
$r = ini_set('displai_errors', '1'); // display を displai にtypoしている
var_dump($r);
