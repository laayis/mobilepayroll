<?php

include('../../AuthClass.php');
if(isset($_COOKIE['SESSID'])){
       if($_COOKIE['SESSID'] == session_id()){
		include('../top.php');
		$uri = $_SERVER['REQUEST_URI'];
		$pieces = explode("/", $uri);
		//print_r($pieces);

		//awdwad.php
		$temp = explode(".", $pieces[3]);
		include($temp[0] . "_c.php");
		include('../../bottom.php');
	}else {
	header('Location: http://timesheet.elasticbeanstalk.com//admin');
	}
} else{
	header('Location: http://timesheet.elasticbeanstalk.com//admin');
}
?>
