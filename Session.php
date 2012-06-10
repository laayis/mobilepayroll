<?php
$link=0;
if(isset($_COOKIE['SESSID'])){
	if($_COOKIE['SESSID'] == session_id()){
		echo '133HELLO';
		$link = initDb();
	} else{
	}
} else{
}
?>
