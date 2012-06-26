<?php

include('../AuthClass.php');
if(isset($_COOKIE['SESSID'])){
       if($_COOKIE['SESSID'] == session_id()){
		
		print_r($_POST);
/*
		$query = "DELETE FROM `clock` WHERE `date` = '"
			. $_POST['date'] . " "
			. $_POST['timei'] . "' AND id='{$_COOKIE['id']}'";
*/
		$query = "INSERT INTO `approvals` (`id`, `hours`, `rollover`, `reason`)
					VALUES ('{$_POST['id']}', '{$_POST['hours']}', '{$_POST['rollover']}', '{$_POST['reason']}')";
		$link = initDb();
		selectDb($link);

		queryDb($link, $query);
		
	}else {
		header('Location: http://timesheet.elasticbeanstalk.com');
	}
} else{
	header('Location: http://timesheet.elasticbeanstalk.com');
}
?>

