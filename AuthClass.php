<?php
session_start();

//check if user sent correct username and password
function initDb(){
	$link = mysql_connect('mobilepay.c0sp63vzrvuy.us-east-1.rds.amazonaws.com', 'pussyeater', 'win2210760');
	if (!$link) { die('Could not connect: ' . mysql_error());}
	return $link;
}
function selectDb($link){
	$db_selected = mysql_select_db('live', $link);
	if (!$db_selected) {
	    die ('Can\'t use live : ' . mysql_error());
	}
}
function isValidLogin($link){
	// make 'live' the current db
	$db_selected = mysql_select_db('live', $link);
	if (!$db_selected) {
	    die ('Can\'t use live : ' . mysql_error());
	}

	$query = "SELECT employee.username, employee.password FROM employee WHERE employee.username='" . $_POST['username'] . "'";
	$result = mysql_query($query);
	if (!$result) {
	    die('Invalid query: ' . mysql_error());
	}
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	if($row['username'] == $_POST['username'] &&
	$row['password'] == $_POST['password']){
		return TRUE;
	}else{return FALSE;}
}

//only works at login because of $_POST
function getEmployeeId($link){
	// make 'live' the current db
	$db_selected = mysql_select_db('live', $link);
	if (!$db_selected) {
	    die ('Can\'t use live : ' . mysql_error());
	}

	$query = "SELECT employee.id, employee.password, employee.username FROM employee WHERE employee.username='" . $_POST['username'] . "'";
	$result = mysql_query($query);
	if (!$result) {
	    die('Invalid query: ' . mysql_error());
	}
	$row = 0;
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	if($row['username'] == $_POST['username'] &&
	$row['password'] == $_POST['password']){
		return $row['id'];
	}else{return 0;}

}

function showName($link){
	$db_selected = mysql_select_db('live', $link);
	if (!$db_selected) {
	    die ('Can\'t use live : ' . mysql_error());
	}
	
	$query = "SELECT contact_info.first, contact_info.last FROM contact_info WHERE contact_info.id=" . $_COOKIE['id'];
	$result=mysql_query($query);
        if(!$result) {
            die('Invalid query: ' . mysql_error());
        }
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$fullname=$row['first'] . " " . $row['last'];
	return $fullname ;
}

function initSession(){
	if(session_start() == TRUE){
		
	} else{
	}
}

function isAlphaNumeric($str) 
{
    return preg_match('/^[A-Za-z0-9_]+$/',$str);
}

?>
