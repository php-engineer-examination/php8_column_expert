<?php
declare(strict_types=1);
/* 名前空間の基本 */
// 名前空間を宣言するには、キーワード namespace を使用します。名前空間を含むファイルでは、他のコードより前にファイルの先頭で名前空間を宣言しなければなりません。 ただし declare キーワードは例外です。   
namespace PhpexamExpert;

error_reporting(-1);

// PHPの名前空間では、(抽象クラスやトレイトを含む)クラスとインターフェイス、関数、そして定数をひとまとめにして扱うことができます。
class HogeClass {}

function hogeFunction(){
    echo __FUNCTION__ , "\n";
}

const HOGE_CONST = "PHP";
