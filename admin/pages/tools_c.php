
<!--
<script type="text/javascript" src="/js/personal_data_change.js"></script>
-->
<h1>Administrative Tools</h1>
<hr />

<table width="800"   border="0" cellpadding="0" cellspacing="0"  align="center">
<tr><td>
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
			<br /><br />
			On this page you may update your personal Information.
			</span><br />
			</div>
		</td></tr>
    </table>
</td></tr>
<tr>
<td>
	<br />
	<?php
	//add hours and pay
	printTableTop(array('ID','First','Last'), 'Employee Hours and Pay');
	$emp = getEmployeesInCompany($_COOKIE['id']);
	printTableBottom($emp);
?>
</td>


<td>
	<br />
	<?php
	//add hours and pay
	printTableTop(array('License','Active'), 'Subscribed Devices');
	$emp = getActiveKeysInCompany($_COOKIE['id']);
	printTableBottom($emp);
?>
</td>

<td>
	<br />
	<?php
	//add hours and pay
	printTableTop(array('ID','First','Last'), 'Employee Hours and Pay');
	$emp = getEmployeesInCompany($_COOKIE['id']);
	printTableBottom($emp);
?>
</td>

</tr>
<br /> 
</table>
