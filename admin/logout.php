<?php
include('../AuthClass.php');
$id=authenticateUser();
$link = initDb();
selectDb($link);
$query="UPDATE company SET sessid='0' WHERE id='{$id}'";
//echo $query;
queryDb($link, $query);
header('Location: http://timesheet.elasticbeanstalk.com/index.php');
//unset($GLOBALS['SESSID']);
?>
