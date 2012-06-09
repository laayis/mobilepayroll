<?php
include('AuthClass.php');
include('Session.php');
?>

<?php
$link = initDb();
//TOP BAR WITH name
echo $_COOKIE['SESSID'];
echo "<br>" ;
echo $_COOKIE['id'];
echo "<br>" ;

$temp1 = showName($link);
echo $temp1;
?>
