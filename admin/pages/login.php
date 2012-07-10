<?php
include('../../AuthClass.php');
?>

<?php
//check if user sent correct username and password

$link = initDb();
$result = 0;
//login

//prevents injection
if( isset($_POST['username']) && isset($_POST['password']) ){
	if(isAlphaNumeric($_POST['password']) && isAlphaNumeric($_POST['password'])){
		$result = isValidLogin($link, 'company');
	}
}
/*
echo $_COOKIE['SESSID'];
echo "<br>" ;
echo $_COOKIE['id'];
echo "Result: " . $result;
*/
//echo $result;
if($result){
	//change billing week if 2 weeks have passed.
	selectDb($link);
	
	$sid=session_id();
	$table='company';
	$tid=getEmployeeId($link, $table);
	if($table=='company'){
		include_once('../AdminClass.php');
		changeCurrentWeek($tid);
		//$r = getCurrentWeek($tid);
		$query = "UPDATE company SET sessid='{$sid}' WHERE id='{$tid}'";
		queryDb($link, $query);
		setcookie('SESSID', session_id(), time()+3600);	
		setcookie('id', getEmployeeId($link, 'company'), time()+3600);	
		$l = 'Location: http://timesheet.elasticbeanstalk.com/admin/pages/overview.php';
		header($l);
	}
} else{
	header('Location: http://timesheet.elasticbeanstalk.com/admin');
}

?>
