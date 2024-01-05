<?php
declare(strict_types=1);
error_reporting(-1);

/* __construct() と __destruct() */
class ConsDes1
{
    public function __construct()
    {
        echo "run ConsDes1 __construct() \n";
    }
    public function __destruct()
    {
        echo "run ConsDes1 __destruct() \n";
    }
}
echo "__construct __destruct start \n";
$object = new ConsDes1();
echo "middle \n";
unset($object); // 注)通常は不要な事が多いが、ここでは確認用で、意図的にオブジェクトを削除している
echo "end \n\n";

// try-catchのfinallyで書く
class ConsDes2
{
    public function __construct()
    {
        echo "run ConsDes2 __construct() \n";
    }
}
try {
    echo "__construct __destruct 2 start \n";
    $object = new ConsDes2();
    echo "middle \n";
//} catch () {
} finally {
    echo "run ConsDes2 destruct \n";
}
echo "end \n\n";

// コンストラクタは引数を持つ事ができます。  
// 「引数があり、初期化をする」コンストラクタの場合、「コンストラクタのプロモーション」が便利な書き方になります。  
class Cons3
{
    public function __construct(
        private int $num,
        private string $str, 
        private array $arr,
    ){}
}
$object = new Cons3(123, "string", [1, 2, 3]);
var_dump($object);

// コンストラクタではreturnをすることが出来ないため、エラーの場合は例外を投げます。  
class Cons4
{
    public function __construct()
    {
        throw new \Exception('Cons4 construct error');
    }
}
try {
    echo "__construct 4 start \n";
    $object = new Cons4();
    echo "middle \n";
} catch(\Throwable $e) {
    echo 'catch Throwable:' , $e->getMessage() , "\n";
}
echo "end \n\n";

// 子クラスがコンストラクタを有している場合、親クラスのコンストラクタが暗黙の内にコールされることはありません。親クラスのコンストラクタの起動には、明示的に `parent::__construct()` の記述が必要です。
// 子クラスがデストラクタを有している場合、親クラスのデストラクタが暗黙の内にコールされることはありません。親クラスのデストラクタの起動には、明示的に `parent::__destruct()` の記述が必要です。  
class ConsDes5Parent
{
    public function __construct()
    {
        echo "run ConsDes5Parent __construct() \n";
    }
    public function __destruct()
    {
        echo "run ConsDes5Parent __destruct() \n";
    }
}
class ConsDes5implicit extends ConsDes5Parent
{
    public function __construct()
    {
        echo "run ConsDes5implicit __construct() \n";
    }
    public function __destruct()
    {
        echo "run ConsDes5implicit __destruct() \n";
    }
}
class ConsDes5Explicit extends ConsDes5Parent
{
    public function __construct()
    {
        parent::__construct(); // (入れ子構造)コンストラクタの親のcallは通常、自身の処理より前に書く事が多いです
        echo "run ConsDes5Explicit __construct() \n";
    }
    public function __destruct()
    {
        echo "run ConsDes5Explicit __destruct() \n";
        parent::__destruct(); // (入れ子構造)デストラクタの親のcallは通常、自身の処理より後に書く事が多いです
    }
}
echo "__construct __destruct 5-1 start \n";
$object = new ConsDes5implicit();
unset($object);
echo "end \n\n";

echo "__construct __destruct 5-2 start \n";
$object = new ConsDes5Explicit();
unset($object);
echo "end \n\n";

// 子クラスでオーバライドした時、(他の通常のメソッドと異なり)シグネチャの互換性に関するルール は適用されません。  
class Cons6Parent
{
    public function __construct(
        private int $num,
        private string $str, 
    ){}
}
class Cons6Child extends Cons6Parent
{
    public function __construct(
        private bool $b,
        private float $f, 
    ){}
}
$object = new Cons6Parent(123, 'str');
var_dump($object);
$object = new Cons6Child(true, 3.14);
var_dump($object);

// コンストラクタは通常 `public` ですが、`protected` や `private` にする事もできます。  
class Cons7
{
    private function __construct()
    {
    }
    // 通常、こういった「インスタンスを作るstaticなメソッド」を別途用意します
    public static function getInstance(): static
    {
        return new static();
    }
}
// $object = new Cons7(); // Fatal error: Uncaught Error: Call to private Cons7::__construct() from global scope in
$object = Cons7::getInstance();
var_dump($object);

// 「古いスタイルのコンストラクタ」は、PHP8以降は「警告も何も出ず、単に無視される」ので、古いコードの場合は気をつけるとよいでしょう。  
class Cons8
{
    // PHP7以下だと(バージョンによって警告は出つつも)コンストラクタのタイミングで動きます
    public function Cons8()
    {
        echo "run Cons8() \n";
    }
}
echo "construct 8 start \n";
$object = new Cons8();
echo "end \n\n";

// デストラクタは引数を持つ事ができません。  
class Des2
{
    /*
    // Fatal error: Method Des2::__destruct() cannot take arguments 
    public function __destruct(int $num)
    {
        echo "run ConsDes1 __destruct() \n";
    }
    */
}
