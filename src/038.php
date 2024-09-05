<?php
declare(strict_types=1);

echo "数学的な操作でエラーが発生\n";
try {
    $shif =-1;
    $number = 8;
    $result =  $number >> $shif;
} catch (\Throwable $e) {
    echo $e::class , "\n";
    echo $e->getMessage(), "\n";
}

echo "\nゼロ除算\n";
try {
    $i = 10 / 0;
} catch (\Throwable $e) {
    echo $e::class , "\n";
    echo $e->getMessage(), "\n";
}

echo "\nアサーション失敗\n";
try {
    assert(1 === '1');
} catch (\Throwable $e) {
    echo $e::class , "\n";
    echo $e->getMessage(), "\n";
}

echo "\n引数の数エラー\n";
try {
    strtoupper('abc', 'def');
} catch (\Throwable $e) {
    echo $e::class , "\n";
    echo $e->getMessage(), "\n";
}

echo "\nmatch式でのunmatchエラー\n";
try {
    $i = 1;
    match($i) {
        2 => '2',
        3 => '3',
    };
} catch (\Throwable $e) {
    echo $e::class , "\n";
    echo $e->getMessage(), "\n";
}

echo "\nfin \n";
