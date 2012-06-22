<?php
include('AuthClass.php');
include('top.php')?>
<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
<h1>Secure website</h1>
<h2>Login</h2>

<!--
<p>Please login to proceed</p>
-->

<form enctype="application/x-www-form-urlencoded" action="login.php" method="post"><dl class="">

<?php
include('inner_login.php');
?>

</form>
<?php

?> 
 </body>
</html>	
<?php include('bottom.php')?>
