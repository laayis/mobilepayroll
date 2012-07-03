
<!--
<script type="text/javascript" src="/js/personal_data_change.js"></script>
-->
<h1>Administrative Tools</h1>
<hr />

<table width="800"   border="0" cellpadding="0" cellspacing="0"  align="center">
<tr><td colspan="3">
			<!-- US Associate Info -->
	<table width="100%" border="0" cellpadding="0" cellspacing="4">
		<tr><td colspan="2" class="small">
			<div align="left"><span>Name:&nbsp<strong>
			<?php $link=initDb();
			selectDb($link);
			echo showName($link, 'company');
			 ?>&nbsp;&nbsp;&nbsp;
			</strong>&nbsp;
			Administrator ID:&nbsp<strong>
			<?php
				echo $_COOKIE['id'];
			 ?>
			</strong>
			</span><br />
			</div>
		</td></tr>
    </table>
</td>

</tr>
<tr>
<td colspan="3">
	<br />
	<?php
	$from = getCurrentWeek();
	//add 1 day to current date to display up-to-date approvals
	$to = addDaysToDate(1, date('m-d-Y', strtotime('today')));

	printTableTop(array('Actions', 'Associate ID', 'Contact Info', 'Cost $xx/hour', 'Hours per Week', 'Pay'), 'Pay from ' . $from . ' to Today');
	$emp = getEmployeesInCompany($_COOKIE['id']);
	//print_r($emp);
	$empf = prepareEmpOutput($emp, $from, $to);
	printEmpTableBottom($empf)
	//printTableBottom($emp);
?>
</td>
</tr>

<tr>
<td colspan="2">
	<br />
	<?php
	printTableTop(array('License','Activated', 'Generate'), 'Subscribed Devices', '300px');
	$emp = getActiveKeysInCompany($_COOKIE['id']);
	printTableBottom($emp);
?>
</td>

<td>
	<br />
	<?php
	printTableTop(array('ID', 'Date', 'Logged in From'), 'Currently Clocked-In', '300px');
	//$emp = getEmployeesInCompany($_COOKIE['id']);
	printCurrTableBottom();
?>
</td>
</tr>

<tr><td colspan="3">
	<?php
	$from = addDaysToDate(-7*2, getCurrentWeek());
	//add 1 day to current date to display up-to-date approvals
	$to = addDaysToDate(1, date('m-d-Y', strtotime('today')));
	printTableTop(array('Actions', 'ID', 'Hours', 'Wage', 'Roll-over', 'Approved?', 'Reason'), 'Approvals from ' . $from . ' to Today', '100%');
	//$emp = getEmployeesInCompany($_COOKIE['id']);

printApprovalTableBottom($from, $to);
?>

</td></tr>


<br /> 
</table>
