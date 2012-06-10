<?php
	setcookie('SESSID', 'AWD', time()+3600);	
	header('Location: index.php');
//unset($GLOBALS['SESSID']);
?>
