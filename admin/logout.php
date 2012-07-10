<?php
include('../AuthClass.php');
$user=authenticateUser();
$link = initDb();
selectDb($link);
if(!isset($user['type'])){
	header('Location: http://timesheet.elasticbeanstalk.com');
}
if($user['type']=='admin'){
	$query="UPDATE company SET sessid='0' WHERE id='{$user['id']}'";
} else{
	$query="UPDATE contact_info SET sessid='0' WHERE id='{$user['id']}'";
}
//echo $query;
queryDb($link, $query);
header('Location: http://timesheet.elasticbeanstalk.com/index.php');
//unset($GLOBALS['SESSID']);
?>
