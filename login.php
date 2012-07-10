<?php
include('AuthClass.php');
?>

<?php
//check if user sent correct username and password

$link = initDb();
$result = 0;
//login

//prevents injection
if( isset($_POST['username']) && isset($_POST['password']) ){
	if(isAlphaNumeric($_POST['password']) && isAlphaNumeric($_POST['password'])){
		$result = isValidLogin($link);
	}
} else{
	//header('Location: http://timesheet.elasticbeanstalk.com/admin/');
	//die();
}
/*
echo $_COOKIE['SESSID'];
echo "<br>" ;
echo $_COOKIE['id'];
echo "Result: " . $result;
*/

if($result){
	selectDb($link);
	$sid=session_id();
	$tid=0;
	//alphanumeric usernames are in the contact_info table
	//email usernames are in the company table
	if(isAlphaNumeric($_POST['username']) == 1){
		$tid=getEmployeeId($link, 'contact_info');
		$query = "UPDATE contact_info SET sessid='{$sid}' WHERE id='{$tid}'";
		setcookie('admin', 0, time()+3600);	
	} else{
		$tid=getEmployeeId($link, 'company');
		$query = "UPDATE company SET sessid='{$sid}' WHERE id='{$tid}'";
		setcookie('admin', '1', time()+3600);	
	}
	queryDb($link, $query);
	setcookie('SESSID', $sid, time()+3600);	
	setcookie('id', $tid, time()+3600);	
	//header('Location: pages/overview.php');
} else{
	echo 'ABD';
	//header('Location: http://timesheet.elasticbeanstalk.com');
}

?>
