<?php
declare(strict_types=1);
error_reporting(-1);

// try ブロックで囲まれたPHP コード内で例外が スロー(throw)されると、それが 捕捉(catch)されます。  
try {
    new DateTime('error time string');
} catch (Exception $e) {
    echo $e->getMessage() , "\n";
} finally {
    // また、try ブロックには finally ブロックが存在する事もあります。  
    echo "finally \n\n";
}

try {
    // 例外(throw)は、PHPの内部関数(クラス)等が throw する事もありますし、自分で throw する事もできます。  
    // PHP 8.0.0 以降では、throw キーワードは式として扱えるようになり、 様々なコンテクストで使えるようになりました。  
    $v = $arr['no key'] ?? throw new Exception('no key error');
} catch (Exception $e) {
    echo $e->getMessage() , "\n\n";
}





catch ブロックは、 throw された例外にどのように反応するかを定義します。
catch ブロックは、捕捉する例外の型を1つ以上指定します。複数の型を指定する場合は、パイプ文字 (|) を使って指定する事ができます。  
また、さまざまな型の例外を捕捉するために 複数の catch ブロックを使用することができます。解決順番に注意しましょう。  
PHP 8.0.0 以降では、キャッチされた例外に対応する変数はオプションになりました。そのため「投げられた例外インスタンスを取得しない catch ブロック」を書く事ができます。  
例外が捕捉されない場合で、かつset_exception_handler() でハンドラが 定義されていない場合、PHP は "Uncaught Exception ..." というメッセージとともに 致命的なエラー(fatal error)を発生させます。  

catch ブロックの後、または catch ブロックの代わりに、 finally ブロックも指定できます。 
finally ブロックは、tryの中の処理が終わった後、または例外がthrowされた後に実行されます。  
return文があるときはその挙動に注意が必要です。  
tryやcatchの中にreturn文がある時にも、finally ブロックは実行されます。その時returnは「finally ブロックが実行された後」に動きます。  
また、finally ブロックにも return 文が存在した場合は、 finally ブロックから値が返されます。 
