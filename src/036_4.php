<?php
declare(strict_types=1);
error_reporting(-1);

// catch ブロックの後、または catch ブロックの代わりに、 finally ブロックも指定できます。 
// finally ブロックは、tryの中の処理が終わった後、または例外がthrowされた後に実行されます。  
try {
    echo "in try \n";
} catch(Throwable) {
    echo "in catch \n";
} finally {
    echo "in finally \n\n";
}

/* return文があるときはその挙動に注意が必要です。 */
function ex1(): int
{
    // tryやcatchの中にreturn文がある時にも、finally ブロックは実行されます。その時returnは「finally ブロックが実行された後」に動きます。  
    try {
        $i = 123;
        throw new Exception('');
    } catch(Throwable) {
        echo "ex1 catch \n";
        return $i;
    } finally {
        echo "ex1 finally \n";
    }
}
$r = ex1();
var_dump($r);
echo "\n";

function ex2(): int
{
    // また、finally ブロックにも return 文が存在した場合は、 finally ブロックから値が返されます。 
    try {
        $i = 123;
        throw new Exception('');
    } catch(Throwable) {
        echo "ex2 catch \n";
        return $i;
    } finally {
        echo "ex2 finally \n";
        return -987;
    }
}
$r = ex2();
var_dump($r);
