<?php
function extinitDb(){
	$link = mysql_connect('Location: http://timesheet.elasticbeanstalk.com/', 'pussyeater', 'win2210760');
	if (!$link) { die('Could not connect: ' . mysql_error());}
	return $link;
}

function isLoggedIn(){
	if(isset($_COOKIE['SESSID'])){
       		if($_COOKIE['SESSID'] == session_id()){
			return 1;
		}
			return 0;	
	}
}

function extgetName($link){
	if(!isLoggedIn){echo 'Guest';}

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
?>
