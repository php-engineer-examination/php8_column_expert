<?php
declare(strict_types=1);
error_reporting(-1);

/* readonlyの継承(PHP8.1.0以降) */ 
// 読み取りと書き込みが両方可能なプロパティを、 readonly として上書きしてはいけません。
class ReadWriteClass
{
    public int $num;
}
class ReadOnlyClass extends ReadWriteClass
{
    // 読み取りと書き込みが両方可能なプロパティを、 readonly として上書きしてはいけません。
    // public readonly int $num;
}

// 逆も同じです。 
class ReadOnlyClass2
{
    public readonly int $num;
}
class ReadWriteClass2 extends ReadOnlyClass2
{
    // 逆も同じです。 
    // public int $num;
}

/* 内部クラスと戻り値の型の互換性(PHP8.1.0以降) */
// 戻り値の型が不一致な場合、警告が発生します。これは「明示的に戻り値の型を宣言していないメソッドを継承した時」にも発生します
// https://www.php.net/manual/ja/class.splqueue.php
class MyQueue extends SplQueue 
{
    // 戻り値の型が不一致な場合、警告が発生します。これは「明示的に戻り値の型を宣言していないメソッドを継承した時」にも発生します
    /*
    public function isEmpty()
    {
        return false;
    }
    */
}
class MyQueue2 extends SplQueue 
{
    // 戻り値の型を宣言できない場合、アトリビュート ReturnTypeWillChange を追加することで警告を抑止できます。  
    #[\ReturnTypeWillChange]
    public function isEmpty()
    {
        return false;
    }
}
