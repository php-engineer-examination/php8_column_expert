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

