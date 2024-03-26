<?php
declare(strict_types=1);
error_reporting(-1);

// ジェネレータを使えば、シンプルな イテレータを簡単に実装できます。
// foreach でデータ群を順に処理するコードを書くときに メモリ内で配列を組み立てなくても済むようになります。 
// コード例: フィボナッチ数の実装
function fibonacci () {
    // はじめは0
    yield 0;

    // 後は計算で算出
    $a = 0;
    $b = 1;
    for ($i = 0; $i < 10; ++$i) {
        [$a, $b] = [$b, $a + $b];
        yield $a;
    }
}
foreach (fibonacci() as $k => $v) {
    echo "fibonacci: {$k}: {$v} \n";
}

// ジェネレータ関数が呼ばれると、反復処理が可能なインスタンス(オブジェクト)を返します。このインスタンス(オブジェクト)は、内部クラス Generator のインスタンス(オブジェクト)になります。  
$f = fibonacci();
var_dump($f);

// ジェネレータは値を返すことができます。返した値は Generator::getReturn() で取得することが出来ます。 
$g = (function() {
    yield 111;
    yield 222;

    return true;
})();

foreach ($g as $v) {
    echo "v: {$v} \n";
}
$r = $g->getReturn();
var_dump($r);

// PHP は、数値添字の配列だけでなく連想配列にも対応しています。ジェネレータも例外ではありません。 先ほどの例のように単なる値を yield するだけでなく、 値と同時にキーも yield することができます。
// 連想配列のようではありますが連想配列ではないので、同じキーを何度も yield する事もできます。
function hashGenerator() {
    yield 'key 1' => 'val 1';
    yield 'key 2' => 'val 22';
    yield 'key 1' => 'val 333';
}
foreach (hashGenerator() as $k => $v) {
    echo "hash: {$k} : {$v} \n";
}

// ジェネレータ関数は、値を参照として yield することもできます。
$g = (function&() {
    $v = 0;
    for($i = 0; $i < 10; ++$i) {
        yield $v;
    }
})();
foreach ($g as &$v) {
    echo "ref: {$v} \n";
    $v = random_int(1, 10);
}

// ジェネレーターを委譲することで、 別のジェネレータや Traversable オブジェクトあるいは配列から、 yield from キーワードを使って値を yield できます。  
function inner() {
    for($i = 1; $i < 3; ++$i) {
        yield $i * 111;
    }
}
function outer() {
    for($i = 0; $i < 4; ++$i) {
        if ($i === 2) {
            yield from inner();
        }
        yield $i;
    }
}
foreach(outer() as $v) {
    echo "from: {$v}\n";
}

