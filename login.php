<?php
include('AuthClass.php');
?>

<?php
//check if user sent correct username and password

$link = initDb();
$result = 0;
//login

//prevents injection
if( isset($_POST['username']) && isset($_POST['password']) ){
	if(isAlphaNumeric($_POST['password']) && isAlphaNumeric($_POST['password'])){
		$result = isValidLogin($link);
	}
}
/*
echo $_COOKIE['SESSID'];
echo "<br>" ;
echo $_COOKIE['id'];
echo "Result: " . $result;
*/

if($result){
	setcookie('SESSID', session_id(), time()+3600);	
	setcookie('id', getEmployeeId($link), time()+3600);	
	header('Location: pages/overview.php');
} else{
	header('Location: index.php');
}

?>
