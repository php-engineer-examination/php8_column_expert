<?php
declare(strict_types=1);
error_reporting(-1);

// breakの基本
// ループの中は、0だけが出力される
echo "start break \n";
for($i = 0; $i < 10; ++$i) {
    echo "{$i},";
    break;
}
echo "\nend break \n";

// continueの基本
// ループの中は、なにも出力されない
echo "start continue \n";
for($i = 0; $i < 10; ++$i) {
    continue;
    echo "{$i},";
}
echo "\nend continue \n";

// continueは「各ループ構造の残りの処理をスキップし、条件式を評価してから次の繰り返しの処理が続行される」ため、以下のコードは無限ループになるので注意
// XXX 無限ループになるコードなのでコメントアウトしています。実行するときは注意してください
/*
$i = 0;
while($i < 5) {
    echo $i , ",";
    continue;
    ++$i; // XXX continueの下にあるので、実行されません
}
*/
// 以下の場合、($iの値が意図した状態になっているかどうか、はともかくとして)無限ループはしないようになります
$i = 0;
while($i++ < 5) {
    echo $i , ",";
    continue;
}
echo "\n";

// continueは「ループ構造の残りの処理をスキップし、条件式を評価する」ので、以下のコードは(無限ループせず)ループの中が1度動くだけ、になります
echo "start continue(in do-while) \n";
do {
    echo 'T';
    continue;
} while(false);
echo "\nend continue(in do-while) \n";

// switch文で(breakの代わりに)continueを使うと、警告が出ます
$value = 'a';
switch($value) {
    case 'a':
        echo "value is a \n";
        continue;
    default:
        continue;
}

// breakやcontinueに引数を渡すと、ネストしたループに対してまとめて「終了」や「先頭に戻る」を行う事ができます。
for($i = 1; $i <= 9; ++$i) {
    for($j = 1; $j <= 9; ++$j) {
        $k = $i * $j;
        // かけ算の結果が11以上ならループ全体を抜ける
        if ($k >= 11) {
            break 2;
        }
        echo "{$i}*{$j}={$k}\n";
    }
}

for($i = 1; $i <= 9; ++$i) {
    for($j = 1; $j <= 9; ++$j) {
        $k = $i * $j;
        // かけ算の結果が21以上なら外側のループの先頭に処理を移動させる
        if ($k >= 21) {
            continue 2;
        }
        echo "{$i}*{$j}={$k}\n";
    }
}


