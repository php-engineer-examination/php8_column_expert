<?php
declare(strict_types=1);
error_reporting(-1);

class HogeException extends Exception
{
}
class FooException extends Exception
{
}

// catch ブロックは、 throw された例外にどのように反応するかを定義します。
// catch ブロックは、捕捉する例外の型を1つ以上指定します。複数の型を指定する場合は、パイプ文字 (|) を使って指定する事ができます。  
try {
    throw new HogeException();
} catch (HogeException | FooException $e) {
    echo "catch Hoge or Foo \n\n";
}catch (Throwable $e) {
    echo "catch any \n\n";
}

// また、さまざまな型の例外を捕捉するために 複数の catch ブロックを使用することができます。解決順番に注意しましょう。  
// 下記は「すべて any に吸い取られる」、順番を間違えているコード例です
try {
    throw new HogeException();
}catch (Throwable $e) {
    echo "catch any \n\n";
} catch (HogeException | FooException $e) {
    echo "catch Hoge or Foo \n\n";
}

// PHP 8.0.0 以降では、キャッチされた例外に対応する変数はオプションになりました。そのため「投げられた例外インスタンスを取得しない catch ブロック」を書く事ができます。  
try {
    throw new HogeException();
} catch (HogeException | FooException) {
    echo "catch Hoge or Foo \n\n";
}catch (Throwable) {
    echo "catch any \n\n";
}

// 例外が捕捉されない場合で、かつset_exception_handler() でハンドラが 定義されていない場合、PHP は "Uncaught 投げられた例外クラス名 ..." というメッセージとともに 致命的なエラー(fatal error)を発生させます。  
throw new HogeException();
