<?php
include('../../AuthClass.php');
authenticateUser();
include('../top.php')?>
<html>
 <head>
  <title>Change Password</title>
 </head>
 <body>
<h1>Password Assistance</h1>
<h3>
Enter your current password and the new password, then click Continue.
</h3>




<!--
<p>Please login to proceed</p>
-->

<form enctype="application/x-www-form-urlencoded" action="changepassword.php" method="post">
<?php
if(isset($_POST['current']) && isset($_POST['new']) && isset($_POST['confirm'])
){

if(isAlphaNumeric($_POST['current']) && isAlphaNumeric($_POST['new']) && isAlphaNumeric($_POST['confirm'])
){
	if($_POST['new'] != $_POST['confirm']){
		echo '<h3>New password and confirmation password does not match.</h3>
		';
	}
	$link = initDb();
	selectDb($link);
	$query = "SELECT password AS id FROM company WHERE id={$_COOKIE['id']}";
	$pw = queryDb2($link, $query);
	if($_POST['current'] == $pw){
		echo 'Password Successfully Changed.';
		$query = "UPDATE company SET password='{$_POST['new']}' WHERE id='{$_COOKIE['id']}'";
		queryDb($link, $query);
	} else{
		echo 'Unable to change password.';
	}
} else{
		echo 'Password has to be alphanumeric.';

}
}




include('../../inner_change.php');
?>

</form>

<?php

?> 
 </body>
</html>	
<?php include('../../bottom.php')?>
