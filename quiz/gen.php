<?php

include('QuizClass.php');


$op = generateOperator();
echo "HELLO<br/>";
//mode can be 1,2, or 3 corresponding to the level difficulty
$mode=1;
$n=generateOptions($mode,$op);

echo '<br/><br/><br/>';
//print_r(factorize($n));

?>
