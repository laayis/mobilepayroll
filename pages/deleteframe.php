<?php

include('../AuthClass.php');
if(isset($_COOKIE['SESSID'])){
       if($_COOKIE['SESSID'] == session_id()){
		echo $_POST['date'];
		echo $_POST['timei'];
		
	}else {
		header('Location: http://timesheet.elasticbeanstalk.com');
	}
} else{
	header('Location: http://timesheet.elasticbeanstalk.com');
}
?>

