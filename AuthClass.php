<?php
session_start();

function isUserAdmin(){
	$temp = explode('/', $_SERVER['SCRIPT_NAME']);

	if($temp[1]=='admin'){
		return 1;
	}
	
	return 0;
}


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

function queryDbAll($link, $query){
	$db_selected = mysql_select_db('live', $link);
	if (!$db_selected) {
	    die ('Can\'t use live : ' . mysql_error());
	}

	$result = mysql_query($query);
	if (!$result) {
	    die('Invalid query: ' . mysql_error());
	}
	//get company_id to filter clock
	/*
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$temp = $row['id'];
	}
*/
	$temp = array();

	while($row = mysql_fetch_array($result, MYSQL_NUM)){
		$t=array();
		for($i=0; $i<count($row); ++$i){
			$t[] = $row[$i];
		}
		$temp[]=$t;
	}
	return $temp;
}

function queryDb2($link, $query){
	$db_selected = mysql_select_db('live', $link);
	if (!$db_selected) {
	    die ('Can\'t use live : ' . mysql_error());
	}

	$result = mysql_query($query);
	if (!$result) {
	    die('Invalid query: ' . mysql_error());
	}
	//get company_id to filter clock
	/*
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$temp = $row['id'];
	}
*/
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	if(isset($row['id'])){
		//print_r($row);
		return $row['id'];
	} else{
		//return 'Error: In queryDb2';
		return 0;
	}
}

function grabForm(){

$t = array_keys($_POST);
//print_r($t);
$select = array();

//get key_value pair
for($i=0;$i<count($t); ++$i){
	$sp = preg_split("/totable_/", $t[$i]);
	if(isset($sp[1])){
		if($sp[1] != ''){
			$select[$sp[1]] = $_POST['totable_' . $sp[1]];
			//$value[] = $_POST['totable_' . $sp[1]];
		}
	}
}
return($select);

}


function queryDb($link, $query){
	$db_selected = mysql_select_db('live', $link);
	if (!$db_selected) {
	    die ('Can\'t use live : ' . mysql_error());
	}

	$result = mysql_query($query);
	if (!$result) {
	    die('Invalid query: ' . mysql_error());
	}

	return $result;
}

function isValidLogin($link, $table='contact_info'){
	// make 'live' the current db
	$db_selected = mysql_select_db('live', $link);
	if (!$db_selected) {
	    die ('Can\'t use live : ' . mysql_error());
	}

	if($table=='contact_info'){
	$query = "SELECT contact_info.username, contact_info.password FROM contact_info WHERE contact_info.username='" . $_POST['username'] . "'";
	} else{
	$query = "SELECT company.username, company.password FROM company WHERE company.username='" . $_POST['username'] . "'";
	}
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
function getEmployeeId($link, $table='contact_info'){
	// make 'live' the current db
	$db_selected = mysql_select_db('live', $link);
	if (!$db_selected) {
	    die ('Can\'t use live : ' . mysql_error());
	}

	$query = "SELECT {$table}.id, {$table}.password, {$table}.username FROM $table WHERE {$table}.username='" . $_POST['username'] . "'";
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

function selectContact($link, $selected){
	$db_selected = mysql_select_db('live', $link);
	if (!$db_selected) {
	    die ('Can\'t use live : ' . mysql_error());
	}
	
	$query = "SELECT " . $selected . " FROM contact_info WHERE contact_info.id=" . getID();
	$result=mysql_query($query);
        if(!$result) {
            die('Invalid query: ' . mysql_error());
        }
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$tossed_salad=$row[$selected];
	echo $tossed_salad;
	return $tossed_salad;
}

function showName($link, $table='contact_info'){
	$db_selected = mysql_select_db('live', $link);
	if (!$db_selected) {
	    die ('Can\'t use live : ' . mysql_error());
	}
	
	$query = "SELECT {$table}.first, {$table}.last FROM {$table} WHERE {$table}.id=" . getID();
	//$query = "SELECT {$table}.first, {$table}.last FROM {$table} WHERE {$table}.id=" . $_COOKIE['id'];
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
function make_seed(){
  list($usec, $sec) = explode(' ', microtime());
  return (float) $sec + ((float) $usec * 100000);
}

function generateKey(){
        $temp = 0;
        $key='';

        // seed with microseconds
        for($i=0; $i<4; ++$i){
                mt_srand(make_seed());
                $temp = mt_rand();
                //$temp=mt_rand(5, 15);
                $temp=md5($temp);
                //echo $temp;
                $key .= substr($temp,0,4) . "-";
        }
        return rtrim($key, '-');

}


function isAlphaNumeric($str) 
{
    return preg_match('/^[A-Za-z0-9_]+$/',$str);
}

function authenticateUser(){
	$sid = session_id();
	if(isUserAdmin()){
		//query company.sessid
		$query = "SELECT sessid AS id FROM company WHERE sessid='{$sid}'";
		$link = initDb();
		selectDb($link);
		$result = queryDb2($link, $query);
		//echo $result . '--' . session_id();
		//echo '<br />' . strlen($result) . '--' . strlen(session_id());
		if(strcmp($result, $sid) != 0){
			//kick user out of the page, he is not authenticated
			header('Location: http://mobilepay.c0sp63vzrvuy.us-east-1.rds.amazonaws.com/admin');
		}

	} else{
		$query = "SELECT sessid AS id FROM contact_info WHERE sessid='{$sid}'";
		$link = initDb();
		selectDb($link);
		$result = queryDb2($link, $query);
		//echo $result . '--' . session_id();
		if(strcmp($result, $sid) != 0){
			//kick user out of the page, he is not authenticated
			header('Location: http://mobilepay.c0sp63vzrvuy.us-east-1.rds.amazonaws.com/');
		}
	}
	
}



?>
