
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
			Associate ID:&nbsp<strong>
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
	printTableTop(array('Weekly Schedule', 'Contact Info', 'Cost $xx/hour', 'Hours per Week', 'Pay'), 'Employees');
	$emp = getEmployeesInCompany($_COOKIE['id']);
	//print_r($emp);
	$empf = prepareEmpOutput($emp);
	printEmpTableBottom($empf)
	//printTableBottom($emp);
?>
</td>
</tr>

<tr>
<td>
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
	printTableTop(array('ID', 'Date', 'Logged in From', 'IN'), 'Currently Clocked-In', '300px');
	//$emp = getEmployeesInCompany($_COOKIE['id']);
	printCurrTableBottom();
?>
</td>

</tr>
<br /> 
</table>
