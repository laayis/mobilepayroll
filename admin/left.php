<ul class="menu_left">

<?php

$tt = explode('/', $_SERVER['SCRIPT_NAME']);
if($tt[2]!='index.php' &&
$tt[2]!='forgotpassword.php'
){
?>
	
	<li>Employee Self-Service</li>
	<li style="margin-top: 15px"><a href="overview.php">ESS Overview</a></li>

<!--
	<li><a href="/pages/pay_statements.php">View Pay Statements</a></li>
	<li><a href="/pages/direct_deposit.php">Enroll in Direct Deposit</a></li>
	<li><a href="/pages/tax_withholdings_state.php">Tax Withholdings - State</a></li>
	<li><a href="/pages/tax_withholdings_federal.php">Tax Withholding - Federal</a></li>
	<li><a href="/pages/w2_statements.php">View W-2 Statements</a></li>
-->
<?php
if($user['type'] == "admin"){
	echo '
	<li><a href="tools.php">Administrative Tools</a></li>
	<li><a href="stats.php">Statistical Tools</a></li>
	<li><a href="changepassword.php">Change Password</a></li>
	';
} else{
	echo '
	<li><a href="personal_data_change.php">Personal Data Change</a></li>
	<li><a href="weekly_time_detail.php">View Weekly Time Detail</a></li>
	<li><a href="changepassword.php">Change Password</a></li>
	';

}

?>


<?php

}
?>
</ul>

