<?php
declare(strict_types=1);
error_reporting(-1);

/* 名前空間(使用側) */
// use phpEngineerExamination\TestClass as Hoge; // Hogeという別名(エイリアス)を定義
// use phpEngineerExamination\TestClass as TestClass; // 「クラス名と同じ別名」にする
use phpEngineerExamination\TestClass; // "use phpEngineerExamination\TestClass as TestClass"のようにクラス名とエイリアス名が同一の場合、 "as エイリアス名"を省略可能です

// オートローダによって読み込まれる事も多いが、このコードではオートローダの仕組みを書いていないので自前でクラス定義を読み込む
require_once('./018_5_namespace.php');

// useのエイリアスを使ったインスタンスの生成
$object = new TestClass();
var_dump($object);

// 完全修飾名を使ったインスタンスの生成
$object_2 = new \phpEngineerExamination\TestClass();
var_dump($object_2);
