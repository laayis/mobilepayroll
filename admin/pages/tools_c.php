<?php
if(empty($awdaccess)) {
	header('Location: http://timesheet.elasticbeanstalk.com/');
	die();
}

?>
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
				echo $user['id'];
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
	$from=0;
	if(isset($_GET['from'])){
		$from = $_GET['from'];
	} else{
		$from = getCurrentWeek($user['id']);
	}

	$temp_from = $from;
	for($i=0; $i<1; ++$i){
		$temp_from = addDaysToDate(-7*2, $temp_from);
		$redirect = $_SERVER['SCRIPT_NAME'] . '?from=' . $temp_from;
		$to = addDaysToDate(7*2, $temp_from);
		$tt = addDaysToDate(-1, $to);
		echo "
			<a href='{$redirect}'>{$tt}</a> | 
		";
	}
	//add 1 day to current date to display up-to-date approvals
	$to = addDaysToDate(7*2, $from);
	$tt = addDaysToDate(-1, $to);
	$export = '<span class="right" >'
		. '<a href=datacsv.php?export='
			. $from. '>'
			. 'Export to Excel'
		. '</a>'
		.'</span>';
	printTableTop(array('Actions', 'Associate ID', 'Contact Info', 'Wage in $/hr', 'Biweekly Hours', 'Pay'), 'Pay ending on '.$tt, '700px', $export);
	$emp = getEmployeesInCompany($user['id']);
	//print_r($emp);
	$empf = prepareEmpOutput($emp, $from, $to);
	printEmpTableBottom($empf, $from)
	//printTableBottom($emp);
?>
</td>
</tr>

<tr>
<td colspan="2">
	<br />
	<?php
	printTableTop(array('Count', 'Name', 'License','Activated', 'Generate'), 'Subscribed Devices', '600px');
	$emp = getActiveKeysInCompany($user['id']);
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
/*	
$from = addDaysToDate(0, getCurrentWeek());
	//add 1 day to current date to display up-to-date approvals
	$to = addDaysToDate(7*2, $from);
*/
	printTableTop(array('Actions', 'ID', 'Hours', 'Wage', 'Roll-over', 'Approved?', 'Reason'), 'Approvals from ' . $from . ' to ' . $to , '100%');
	//$emp = getEmployeesInCompany($_COOKIE['id']);

printApprovalTableBottom($from, $to, $user);
?>

</td></tr>


<br /> 
</table>
