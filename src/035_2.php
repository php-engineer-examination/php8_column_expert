<?php
declare(strict_types=1);

// 複数の名前空間を同一ファイル内で宣言することもできます。
namespace PhpexamExpertPart2 {
    error_reporting(-1);

    class HogeClass {}

    function hogeFunction(){
        echo __FUNCTION__ , "\n";
    }

    const HOGE_CONST = "PHP Part2";
}

// 同一の名前空間を複数のファイルで定義することができます。 これにより、ひとつの名前空間の内容をファイルシステム上で分割することができます。   
namespace PhpexamExpert {
    error_reporting(-1);

    class FooClass {}
}

