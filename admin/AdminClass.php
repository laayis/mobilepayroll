<?php
include_once('../../AuthClass.php');
include_once('../../TableClass.php');

function getEmployeesInCompany($company_id){
	$link = initDb();
	selectDb($link);


	$query = "
	SELECT contact_info.id, contact_info.first, contact_info.last, contact_info.wage
	FROM contact_info
	WHERE contact_info.company_id=$company_id
	";
	$result = mysql_query($query);
	if (!$result) {
	    die('Invalid query: ' . mysql_error());
	}
	
	$temp = array();

	while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
		$temp[] = array($row['id'],$row['first'],$row['last'],$row['wage']);
	}

	//print_r($temp);
	return $temp;

}

function getActiveKeysInCompany($company_id){
	$link = initDb();
	selectDb($link);


	$query = "
	SELECT subscribed_devices.license, subscribed_devices.active
	FROM subscribed_devices
	WHERE subscribed_devices.company_id=$company_id
	ORDER BY active ASC
	";
	$result = mysql_query($query);
	if (!$result) {
	    die('Invalid query: ' . mysql_error());
	}
	
	$temp = array();

	while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
		$l= '<a href="javascript:void(null);renew(\''.
		$row['license'] . '\');">Renew</a>';
		$temp[] = array($row['license'],$row['active'], $l);
	}

	//print_r($temp);
	return $temp;
	
}

function printTableTop($columns, $tbname, $w='700px'){
echo '
	<table width='
	.
	$w
	. '" border="2" cellpadding="0" cellspacing="0" bordercolor="#EFEFE4" >
		<tr><td colspan="'.count($columns).'" bgcolor="EFEFE4" class="normal"> 
			<div align="left"><strong>' .
		$tbname
		. '</strong></div>
        	<div align="center" ></div>
        	</td>
        </tr> 
';

	echo '<tr>';
	for($i=0;$i<count($columns);++$i){
		echo '<td>';
		echo $columns[$i];
		echo '</td>';
	}
	echo '</tr>';
}

function getEmployeesForDate($date, $id=0){
	$link = initDb();
	selectDb($link);

	$query = "SELECT id, date AS date, license, look_ahead FROM clock WHERE date>'{$date}' AND company_id='{$id}' ORDER BY date ASC";
	$result = mysql_query($query);
	if (!$result) {
	    die('Invalid query: ' . mysql_error());
	}

	$temp = array();
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$temp[] = $row;
	}

	return $temp;
}
//FIX ME: currently clocked in table does not account for employees who clocked-in the previous day 8 hours before midnight.
function printCurrTableBottom(){

	$date = date('Y-m-d');
	$emp = getEmployeesForDate($date, getID());
	//check to see that the employee is currently logged in
	$clocked = array();
	for($i=0;$i<count($emp);++$i){
		$clocked[$emp[$i]['id']] = array($emp[$i]['id'],
						$emp[$i]['date'],
						$emp[$i]['license'],
						$emp[$i]['look_ahead'],
						);
	}
	//print_r($emp);
	$newemp = array();
	foreach($clocked as $value){
		if($value[3] == 0){
			$newemp[] = $value;
		}
	}
	print_r($newemp);

	//print
	for($i=0; $i<count($newemp); ++$i){
		echo '<tr>';
		for($j=0; $j<count($newemp[$i]);++$j){
			echo '<td>';
			echo $newemp[$i][$j];
			echo '</td>';
		}
		echo '</tr>';
		
	}
	echo '
	</table>
	<br />
	';
}

function getCurrentWeek(){
	return '06-18-2012';
}

function prepareEmpOutput($emp){
//	print_r($emp);

	//$r for return
	$r = array();
	for($i=0; $i<count($emp); ++$i){
	//echo '---' . $emp[$i][0];
		
		$r[] = array($emp[$i][0], 
				$emp[$i][1] . ' ' . $emp[$i][2], 
				$emp[$i][3],
		getHoursForId($emp[$i][0], getCurrentWeek(), 2),
	calculatePay(getHoursForId($emp[$i][0],getCurrentWeek(), 2), $emp[$i][3])
			);
	}
//	print_r($r);
	return $r;
}

function printEmpTableBottom($emp){

	for($i=0; $i<count($emp); ++$i){
		echo '<tr>';
		for($j=0; $j<count($emp[$i]);++$j){
			echo '<td>';
			if($j==0){
				//echo '<a href="javascript:void(null);getweek(\'';
				echo '<a href="weekly_time_detail.php?id=';
				echo $emp[$i][$j];
				echo '" target="_blank">';
				echo $emp[$i][$j];
				echo '</a>';
			} else if($j==1){
				echo '<a href="personal_data_change.php?id=';
				echo $emp[$i][$j-1];
				echo '" target="_blank">';
				echo $emp[$i][$j];
				echo '</a>';
			}else { echo $emp[$i][$j]; }
			echo '</td>';
		}
		echo '</tr>';
		
	}
	echo '
	</table>
	<br />
	';

}

function printTableBottom($emp){
	for($i=0; $i<count($emp); ++$i){
		echo '<tr>';
		for($j=0; $j<count($emp[$i]);++$j){
			echo '<td>';
			echo $emp[$i][$j];
			echo '</td>';
		}
		echo '</tr>';
		
	}
	echo '
	</table>
	<br />
	';
}


?>
