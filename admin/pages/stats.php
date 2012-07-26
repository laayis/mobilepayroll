<?php

include('../../AuthClass.php');
$user = authenticateUser();
if($user['type'] != 'admin'){
	header('Location: http://timesheet.elasticbeanstalk.com/admin/pages/overview.php');
	die();
}

include('../top.php');
$uri = $_SERVER['REQUEST_URI'];
$pieces = explode("/", $uri);
//print_r($pieces);

//awdwad.php
$temp = explode(".", $pieces[3]);
include($temp[0] . "_c.php");
include('../bottom.php');

?>
