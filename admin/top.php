<?php
//	include('AuthClassExt.php');
	//include('Session.php');
?>

<html>
<head>
<title>Management Console</title>
<link rel="stylesheet" href="/style/style.css" type="text/css" />
<link rel="stylesheet" href="/style/ESSWrapper.css" type="text/css" />
<link rel="stylesheet" href="/style/ESSstyles.css" type="text/css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="../../js/web.js"></script>

</head>
<body>
<div class="main_wrapper" align="center">
<div class="main">
	<div class="header_top">
		<div class="header_logo"><img src="/images/parksman.png" width="30" /></div>
		<div class="header_login">
			<?php echo "Welcome "; //. extgetName(extinitDb());
			?>  | <a href="../logout.php">Exit</a>
		</div>
		<div class="clear"></div>
	</div>
	<div class="header_menu"></div>
	<div class="content_main">
		<div class="content_left">
			
			<?php 
				//if(isLoggedIn()){
					include('left.php');
				//} 
			?>
			</div>
			<div class="content_right">
				<div class="content_right_inner">
