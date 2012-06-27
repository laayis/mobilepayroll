<?php

include('../AuthClass.php');
if(isset($_COOKIE['SESSID'])){
       if($_COOKIE['SESSID'] == session_id()){
		echo $_POST['date'];
		echo $_POST['timei'];
		echo $_POST['timef'];
		$query = "DELETE FROM `clock` WHERE `date` = '"
			. $_POST['date'] . " "
			. $_POST['timei'] . "' AND id='{$_COOKIE['id']}'";
		$link = initDb();
		selectDb($link);
		echo $query;

		queryDb($link, $query);
		
		$query = "DELETE FROM `clock` WHERE `date` = '"
			. $_POST['date'] . " "
			. $_POST['timef'] . "' AND id='{$_COOKIE['id']}'";
		queryDb($link, $query);
	}else {
		header('Location: http://timesheet.elasticbeanstalk.com');
	}
} else{
	header('Location: http://timesheet.elasticbeanstalk.com');
}
?>

