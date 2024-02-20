<?php
declare(strict_types=1);
error_reporting(-1);

try {
    // throw されるオブジェクトは、 Throwable のインスタンスでなければなりません。  
    throw new stdClass("no Throwable");
} catch (Exception $e) {
    echo $e->getMessage() , "\n\n";
}
