<?php
declare(strict_types=1);
namespace PhpexamExpert;
error_reporting(-1);

/* 名前空間の使用法 */
require_once __DIR__ . '/035_1.php';
require_once __DIR__ . '/035_2.php';
require_once __DIR__ . '/035_3.php';

// use 演算子によるインポート/エイリアス
// use PhpexamExpert\HogeClass as HogeClass; // 完全修飾名の最後とエイリアス名が同じ時は、次の行のように as以下を省略できます
use PhpexamExpert\HogeClass;

// エイリアス(別名)を明示的に書いてます
use PhpexamExpertPart2\HogeClass as HogeClassPart2;

// 同じ namespace から複数のクラスや関数そして定数をインポートする際には、 それらをひとつの use にまとめることができます。   
use PhpexamExpert\{
    hogeFunction,
    HOGE_CONST,
};

//
$object = new HogeClass();
var_dump($object);

$object = new HogeClassPart2();
var_dump($object);

hogeFunction();

var_dump(HOGE_CONST);

/* グローバル空間 */

// 名前空間の定義がない場合、すべてのクラスや関数の定義はグローバル空間に配置されます。 これは、名前空間に対応する前の PHP がサポートしていた空間です。 名前の先頭に \ をつけると、 名前空間の内部からであってもグローバル空間の名前を指定することができます。   
// グローバル空間にあるクラスで use していない場合、先頭に \ が必須です
// $object = new ArrayObject(); // Fatal error: Uncaught Error: Class "PhpexamExpert\ArrayObject" not found in 
$object = new \ArrayObject();
var_dump($object);

// グローバル空間にあるクラス名をuseすることで、コード内で \stdClass と書かず、 stdClass と書いてきちんと認識させることができます
use stdClass;

$object = new stdClass();
var_dump($object);

$object = new \stdClass();
var_dump($object);
