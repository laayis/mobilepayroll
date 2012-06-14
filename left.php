<ul class="menu_left">

<?php

if(isset($_COOKIE['SESSID'])){
       if($_COOKIE['SESSID'] == session_id()){
?>
	
	<li>Employee Self-Service</li>
	<li style="margin-top: 15px"><a href="/pages/overview.php">ESS Overview</a></li>

<!--
	<li><a href="/pages/pay_statements.php">View Pay Statements</a></li>
	<li><a href="/pages/direct_deposit.php">Enroll in Direct Deposit</a></li>
	<li><a href="/pages/tax_withholdings_state.php">Tax Withholdings - State</a></li>
	<li><a href="/pages/tax_withholdings_federal.php">Tax Withholding - Federal</a></li>
	<li><a href="/pages/w2_statements.php">View W-2 Statements</a></li>
-->	
	<li><a href="/pages/personal_data_change.php">Personal Data Change</a></li>
	<li><a href="/pages/weekly_time_detail.php">View Weekly Time Detail</a></li>
<?php
	}
}
?>
</ul>

