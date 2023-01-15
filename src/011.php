<?php
declare(strict_types=1);
error_reporting(-1);
?>

if文の別の構文<br>
5 === 5 は
<?php if (5 === 5): ?>
trueである<br>
<?php else: ?>
falseである<br>
<?php endif; ?>

while文の別の構文<br>
<?php
$i = 0;
while($i++ < 5):?>
    whileでの繰り返し<br>
<?php endwhile; ?>

for文の別の構文<br>
<?php for($i = 0; $i < 5; ++$i):?>
    forでの繰り返し<br>
<?php endfor; ?>

foreach文の別の構文<br>
<?php foreach([1, 2, 3] as $v):?>
    foreachでの繰り返し<br>
<?php endforeach; ?>

switch文の別の構文<br>
<?php switch(1): ?>
<?php   case 0: ?>
            値は0<br>
<?php       break; ?>
<?php   case 1: ?>
            値は1<br>
<?php       break; ?>
<?php   default: ?>
            値は0でも1でも2でもない<br>
<?php endswitch; ?>
