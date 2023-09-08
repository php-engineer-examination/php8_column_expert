<?php
declare(strict_types=1);
error_reporting(-1);

/* オブジェクトの反復処理 */
class IterativeClass
{
    public function __construct(
        public int $pub_num,
        public string $pub_string,
        private int $pri_num,
        private string $pri_string,
    ) {
    }
}
$object = new IterativeClass(123, 'public', 999, 'private');
var_dump($object);
// foreach 命令などにオブジェクト(インスタンス)を渡すと、デフォルトでは「全てのpublicなプロパティ」を反復処理に利用する事ができます。
foreach ($object as $k => $v) {
    var_dump($k, $v);
}

// Traversable インターフェイス(を継承した、`IteratorAggregate` )を継承したクラスのオブジェクト(インスタンス)は、任意の方法で反復処理を行わせる事ができます。  
class myIterator implements Iterator {
    // ポインタ位置
    private int $pos = 0;
    // 擬似的なデータ
    private string $key_0 = 'key 0';
    private string $value_0 = 'value 0';
    private string $key_1 = 'key 1';
    private string $value_1 = 'value 1';
    private string $key_2 = 'key 2';
    private string $value_2 = 'value 2';

    // 現在の要素を返す
    public function current(): mixed
    {
        return $this->{"value_{$this->pos}"};
    }
    // 現在の要素のキーを返す
    public function key(): mixed
    {
        return $this->{"key_{$this->pos}"};
    }
    // 次の要素に進む
    public function next(): void
    {
        $this->pos ++;
    }
    // イテレータの最初の要素に巻き戻す
    public function rewind(): void
    {
        $this->pos = 0;
    }
    // 現在位置が有効かどうかを調べる
    public function valid(): bool
    {
        // 用意しているデータは2まで
        return $this->pos <= 2;
    }
}
//
echo "TTT 1\n";
$object = new myIterator();
foreach ($object as $k => $v) {
    echo "{$k}: {$v}\n";
}
// XXX 同一インスタンスでネストさせると挙動がおかしくなるので注意
foreach ($object as $k => $v) {
    echo "{$k}: {$v}\n";
    foreach ($object as $k => $v) {
        echo "\t{$k}: {$v}\n";
    }
}

// Traversable インターフェイス(を継承した、`Iterator`)を継承したクラスのオブジェクト(インスタンス)は、任意の方法で反復処理を行わせる事ができます。  
class dataArray implements IteratorAggregate {
    
    public function getIterator(): Traversable
    {
        return new myIterator();
    }
}
// Iteratorクラスの定義
// ArrayIterator 使ってもよいねぇ
echo "TTT 2\n";
$object = new dataArray();
foreach ($object as $k => $v) {
    echo "{$k}: {$v}\n";
}
// XXX 同一インスタンスでネストさせても問題なく動く
foreach ($object as $k => $v) {
    echo "{$k}: {$v}\n";
    foreach ($object as $k => $v) {
        echo "\t{$k}: {$v}\n";
    }
}

/* SPLイテレータ */
// 例) RecursiveIteratorIterator
$base_path = __DIR__;
try {
    // ディレクトリを指定して再帰
    $object = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($base_path, 
                FilesystemIterator::CURRENT_AS_FILEINFO // current() がSplFileInfo のインスタンスを返す
                | FilesystemIterator::SKIP_DOTS // ドットファイル (. および ..) をスキップ
                | FilesystemIterator::KEY_AS_PATHNAME // key() がパス名を返す
            )
        );
    // ファイルを再帰的にイテレータ処理
    foreach($object as $filename => $file_obj){
        echo $filename, "\n";
    }
} catch(Exception $e) {
    echo get_class($e), "\n";
    echo $e->getMessage(), "\n";
}

/* オブジェクトの比較 */
class DiffClass1 {
    public function __construct(
        private int $num,
        private string $str,
        private bool $b,
    ) {
    }
}
class DiffClass2 {
    public function __construct(
        private int $num,
        private string $str,
        private bool $b,
    ) {
    }
}
// 比較演算子(==)を使用する際、 オブジェクト変数は、単純に比較されます。  
$object_1 = new DiffClass1(123, 'str', true);
$object_1_1 = new DiffClass1(123, 'str', true);
$object_2 = new DiffClass2(123, 'str', true);
var_dump($object_1 == $object_1_1); // true
var_dump($object_1 == $object_2); // false

// 一方で一致演算子(===)を使用する場合、 オブジェクト変数は、同じクラスの同じインスタンスを参照する場合のみ、 等しいとされます。   
var_dump($object_1 === $object_1_1); // false
