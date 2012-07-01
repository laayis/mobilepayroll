<?php

include('../AuthClass.php');
include('../TableClass.php');
if(isset($_COOKIE['SESSID'])){
       if($_COOKIE['SESSID'] == session_id() &&
	isset($_POST['user_id']) &&
	$_COOKIE['id'] == $_POST['user_id']
){
		
//		print_r($_POST);
		
		$link = initDb();
		selectDb($link);
		$company_id = getCompanyId($_POST['user_id']);
		$query = "INSERT INTO `approvals` (`user_id`, `hours`, `rollover`, `reason`, `company_id`)
					VALUES ('{$_POST['user_id']}', '{$_POST['hours']}', '{$_POST['rollover']}', '{$_POST['reason']}',
						'{$company_id}')";
		echo $query;

		queryDb($link, $query);
		
	}else {
		header('Location: http://timesheet.elasticbeanstalk.com');
	}
} else{
	header('Location: http://timesheet.elasticbeanstalk.com');
}
?>

