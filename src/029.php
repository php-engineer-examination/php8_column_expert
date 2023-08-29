<?php
declare(strict_types=1);
error_reporting(-1);

/* リファレンス */
// PHPにおいて、リファレンス(参照)とは「同じ変数の内容を異なった名前であつかう事ができる」機能です。  

// リファレンス「ではない」例
$arr_1 = [1, 2, 3];
$arr_2 = $arr_1;
$arr_1[] = 4; // arr_1の末尾にデータを追加してもarr_2には影響がない
var_dump($arr_1, $arr_2);

// リファレンスの例
$r_arr_1 = [1, 2, 3];
$r_arr_2 = &$r_arr_1;
$r_arr_1[] = 4;
var_dump($r_arr_1, $r_arr_2);

/* オブジェクトと参照 */
class Hoge {
    public int $num = 0;
}
// オブジェクト(インスタンス)を `=` で代入したり関数(やメソッド)の引数で渡すと、参照渡しと同じような状態になります
$object_1 = new Hoge();
$object_1->num = 123;
$object_2 = $object_1;
$object_1->num = 999;
var_dump($object_1, $object_2);

/* オブジェクトのクローン作成  */
// オブジェクト(インスタンス)のコピー(同じ値を持つ、異なる実体の作成)をしたい時は、 `clone` キーワードを使います
$r_object_1 = new Hoge();
$r_object_1->num = 123;
$r_object_2 = clone $r_object_1; // `clone` キーワード
$r_object_1->num = 999;
var_dump($r_object_1, $r_object_2);
