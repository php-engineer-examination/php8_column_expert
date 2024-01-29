<?php
declare(strict_types=1);
// ディレクトリやファイルと同様、PHP の名前空間においても名前空間の階層構造を指定することができます。  
namespace PhpexamExpert\SubDir;

error_reporting(-1);

class HogeClass {}

function hogeFunction(){
    echo __FUNCTION__ , "\n";
}

const HOGE_CONST = "PHP SubDir";
