<?php
//include('../../TableClass.php');
if(empty($awdaccess)) {
	header('Location: http://timesheet.elasticbeanstalk.com/');
	die();
}

$id = getID();

function getFrom($user){
	if(isset($_GET['from'])){
		return $_GET['from'];
	}else{
		return getCurrentWeek($user['company_id']);
	}
}
?>

<h1>Welcome to Employee Self-Service</h1>
<hr />

<span class="normal"> 
		Name:<strong>
			<?php $link=initDb();
			selectDb($link);
			echo showName($link);
			 ?>
 		</strong>&nbsp;
	             Associate ID: <strong>
			<span id="getid">
			<?php echo $id; ?>
				</strong>
</span>

<?php
$from = getFrom($user);
$to = addDaysToDate(7, $from);

echo '<br /><br /><table width="100%" border="0" cellpadding="0" cellspacing="0">'; 
echo '<tr><td>';
hoursHeader($id, $from, $to, 'First');
echo '</td>';

$from = $to;
$to = addDaysToDate(7, $from);
echo '<td>';
hoursHeader($id, $from, $to, 'Second');
echo '</td></tr>';

echo '</table>';

?>

	</strong>
	</span>
	<div align="center"> 
	<table width="100%" cellpadding=0 cellspacing=0 border="0">
		<tr>
			<td>
			<br>
			<div align="center" class="normal">
				Information shown is not finalized and may not contain missed punch, pay code, or other adjustments necessary.  
				<br />
			</div>
			<br />
			<div class="timeDetailData">
			<fieldset><legend> <strong>
			<font color="#000000" class="normal">
				Approvals
			</font>
			</strong>
			</legend>
<?php
$link = initDb();
selectDb($link);

	$from = getFrom($user);
	//add 1 day to current date to display up-to-date approvals
	$to = addDaysToDate(7, $from);
	printTableTop(array('Actions', 'ID', 'Hours', 'Wage', 'Roll-over', 'Approved?', 'Reason'), 'Approvals from First Week', '100%');
	printApprovalTableBottom($from, $to, $user);
	userAddTimeForm($id, $from);
	echo '<br />';
	$from = $to;
	$to = addDaysToDate(7, $from);
	printTableTop(array('Actions', 'ID', 'Hours', 'Wage', 'Roll-over', 'Approved?', 'Reason'), 'Approvals from Second Week' , '100%');
	printApprovalTableBottom($from, $to, $user);
	userAddTimeForm($id, $from);

 ?>
			</fieldset>
			<br />
			<div class="timeDetailData">
			<fieldset><legend> <strong>
			<font color="#000000" class="normal">
				TIME DETAIL - CURRENT WEEK
			</font>
			</strong>
			</legend>
<?php
$link = initDb();
selectDb($link);
$monday=0;
if(addDaysToDate(-7, date("m-d-Y", strtotime("today")) ) == date("m-d-Y", strtotime("previous monday")) ){

	$monday = date("m-d-Y", strtotime("today"));
} else{
	$monday = date("m-d-Y", strtotime("previous monday"));
}

$monday = getFrom($user);

//echo $monday;
$monday = addDaysToDate(7, $monday);
$date = $monday;
printRowIn($link, $date, 0, $id);

/*

*/ ?>
			</fieldset>
			<br/>
			<fieldset><legend> <strong>
			<font color="#000000" class="normal">
				TIME DETAIL - PREVIOUS WEEKS
			</font>
			</strong>
			</legend>
<?php
$date = addDaysToDate(-7*1, $monday);
printRowIn($link, $date, 1, $id);
//userAddTimeForm();
?>


			<br/>
<?php
$date = addDaysToDate(-7*2, $monday);
printRowIn($link, $date, 2, $id);
?>
			<br/>
<?php
$date = addDaysToDate(-7*3, $monday);
printRowIn($link, $date, 3, $id);
?>
			

			</fieldset>
			<br/>
			</div>			
<!--
			<br />
			<fieldset>
			<table width="100%" border="1" align="center" cellpadding="0"
				cellspacing="0" style="border-color:#EFEFE4">
				<tr>
					<td width="200" bgcolor="EFEFE4">
					<div align="center" class="normal"><strong>PHONE</strong></div>
					</td>
					<td width="201" align="center" bgcolor="EFEFE4" class="normal"><strong>EMAIL</strong>
					</td>
					<td width="132" align="right" bgcolor="EFEFE4">
					<div align="center" class="normal"><strong>WEBSITE</strong></div>
					</td>
					<td width="207" align="right" bgcolor="EFEFE4">
					<div align="center" class="normal"><strong>IMPORTANT NOTES</strong></div>
					</td>
				</tr>
				<tr>
					<td align="center"> 
					786-488-5097<br />786-488-5097<br />
					</td>					
			           	<td align="center">email address<br /></td>
			           	<td align="right">company url</td>
					<td align="right">
					<div align="center">&nbsp;</div>
					</td>
				</tr>
			</table>
			</fieldset>
-->
			<div align="center"><br />
			<input name="printButton" type="button" class="entertext noprint" value="Print"
				onclick="window.print()" /> <br />
			</div>
			<div align="center" class="normal"><br />
			Information shown is not finalized and may not contain missed punch, pay code, or other adjustments necessary.  <br />
			</div>
			</td>			
		</tr>
	</table>
	<br/>
	</div>

