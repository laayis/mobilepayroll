<?php
include('../TableClass.php');

$id = getID();
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
			<?php
			//$gook = getID();
			echo $id;
			?>
			</span>

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
			<br>
			<fieldset><legend> <strong><font color="#000000" class="normal">ALLOTTED TIME OFF</font></strong>
			</legend>
			<table width="100%" border="2" cellpadding=5 cellspacing=0>
					<tr>
						<td width="70%" align="center" bgcolor="EFEFE4" class="normal"><strong>Description</strong>
						</td>
						<td width="15%" align="center" bgcolor="EFEFE4" class="normal"><strong>Taken</strong>
						</td>
						<td width="15%" align="center" bgcolor="EFEFE4" class="normal"><strong>Available</strong>
						</td>
					</tr>
					<tr>
						<td align="left" class="normal"><strong>SICK-US</strong></td>
						<td align="center">0:0</td>
						<td align="center">0:00</td>	
					</tr>
					<tr>
						<td align="left" class="normal"><strong>VACATION-US</strong></td>
						<td align="center">0:0</td>
						<td align="center">0:00</td>	
					</tr>
				</table>
				<div align="center" class="normal">
					'Taken' time is shown only for displayed pay periods.
   				</div>
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

$monday = 0;
//echo $mon$monday=0;
if(addDaysToDate(-7, date("m-d-Y", strtotime("today")) ) == date("m-d-Y", strtotime("previous monday")) ){

	$monday = date("m-d-Y", strtotime("today"));
} else{
	$monday = date("m-d-Y", strtotime("previous monday"));
}

$date = addDaysToDate(0, $monday);
printRowIn($link, $date, 0, $id);
userAddTimeForm($id);

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

