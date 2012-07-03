<?php
include('../AuthClass.php');
include('top.php')?>
<html>
 <head>
  <title>Retrieve Password</title>
 </head>
 <body>
<h1>Password Assistance</h1>
<h3>
Enter the e-mail address associated with your account, then click Continue. We'll email you a link to a page where you can easily create a new password.
</h3>




<!--
<p>Please login to proceed</p>
-->

<form enctype="application/x-www-form-urlencoded" action="../validatecaptcha.php" method="post">
<?php
include('../inner_forgot.php');
?>

</form>

<?php

?> 
 </body>
</html>	
<?php include('../bottom.php')?>
