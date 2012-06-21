<?php
include('../AuthClass.php');
include('top.php')?>
<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
<h1>Secure website</h1>
<h2>Login</h2>

<p>Please login to proceed</p>


<form enctype="application/x-www-form-urlencoded" action="login.php" method="post"><dl class="">
<dt><label for="username" class="required">Username:</label></dt>
<dd>
<input type="text" name="username" id="username" value=""></dd>
<dt><label for="password" class="required">Password:</label></dt>
<dd>
<input type="password" name="password" id="password" value=""></dd>
<dt>&nbsp;</dt><dd>
<input type="submit" name="login" id="login" value="Login"></dd></dl></form>
<?php

?> 
 </body>
</html>	
<?php include('../bottom.php')?>
