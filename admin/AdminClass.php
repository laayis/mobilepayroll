<?php
include_once('../../AuthClass.php');
include_once('../../TableClass.php');

function getAdminCompanyId($user_id){
	$query = "SELECT company.id FROM company WHERE id='" . $user_id . "'";
	$result = mysql_query($query);
	if (!$result) {
	    die('Invalid query: ' . mysql_error());
	}
	//get company_id to filter clock
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$company_id = $row['id'];
	return($company_id);
}

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

	$query = "SELECT id, date AS date, license, look_ahead FROM clock WHERE date>='{$date}' AND company_id='{$id}' ORDER BY date ASC";
	//echo $query;
	$result = mysql_query($query);
	if (!$result) {
	    die('Invalid query: ' . mysql_error());
	}

	$temp = array();
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$temp[] = $row;
	}
	//print_r($temp);
	return $temp;
}
//FIX ME: currently clocked in table does not account for employees who clocked-in the previous day 8 hours before midnight.
function printCurrTableBottom(){

	$date = date('Y-m-d');
	$emp = getEmployeesForDate($date, getID());
	//check to see that the employee is currently logged in
	$clocked = array();
	$look = array();
	for($i=0;$i<count($emp);++$i){
		$clocked[((string)$emp[$i]['id'])] = array($emp[$i]['id'],
						$emp[$i]['date'],
						$emp[$i]['license'],
						$emp[$i]['look_ahead']
						);
	}
	//print_r($clocked);
	$newemp = array();
	foreach($clocked as $value){
		//print_r($value);
		if($value[3] == 0){
			$newemp[] = $value;
		}
	}
	//print_r($newemp);

	//print
	for($i=0; $i<count($newemp); ++$i){
		echo '<tr>';
		for($j=0; $j<count($newemp[$i])-1;++$j){
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

//this function is based on the company's billing schedule. Select
//dates that are on a monday.
function getCurrentWeek(){
	$link = initDb();
	selectDb($link);

	$query = "SELECT DATE_FORMAT(biweekly, '%m-%d-%Y') as id FROM company
		WHERE `company`.`id`='{$_COOKIE['id']}'";
	$result = queryDb2($link, $query);
	//echo $result;
	//return '06-18-2012';
	return $result;
}

function prepareEmpOutput($emp, $from, $to){
//	print_r($emp);

	//$r for return
	$mid = addDaysToDate(7, $from);
	//echo $from . '-WWW'. $mid .'WWW-' . $to . '<br /><br />';
	$r = array();
	for($i=0; $i<count($emp); ++$i){
	//echo '---' . $emp[$i][0];
//echo getCurrentWeek();
//echo "---" . $date . "<br />";
		
		//week one and week 2 of biweek
		$regular1=getSecondsForId($emp[$i][0], $from, $mid);
		$regular2=getSecondsForId($emp[$i][0], $mid, $to);
		$approved1=getApprovalSecondsForId($emp[$i][0], $from, $mid);
		$approved2=getApprovalSecondsForId($emp[$i][0], $mid, $to);

		$regular1[0]=$regular1[0]/60/60;
		$approved1['current'][0]=$approved1['current'][0]/60/60;
		$approved1['previous'][0]=$approved1['previous'][0]/60/60;
		$regular2[0]=$regular2[0]/60/60;
		$approved2['current'][0]=$approved2['current'][0]/60/60;
		$approved2['previous'][0]=$approved2['previous'][0]/60/60;
		//print_r($approved1);
		//echo '<br /><br />';
		//print_r($approved2);
		//echo '<br />---------';
		//if($regular[0] >)
		
		$total_pay = 0;
		$total_time = 0;
		//$approved1['previous'][1];
		//$total_pay += $approved2['previous'][1];

		//$total_pay += $approved1['previous'][1]+$approved2['previous'][1];

		//FIX ME approved regular hours needs to have overtime pay. add this functionality asap
		//calculate pay for regular hours
	$week1 = ($regular1[0]+$approved1['current'][0]);
	//echo $week1;
		
	if($week1 > 40){
		if($regular1[0] > 40){
			$total_pay += ($regular1[0]-40)*$regular1[1]*1.5;
			$total_pay += 40*$regular1[1];
/*
			if($approved1['current'][0]>(40-$regular1[0])){
				$total_pay += $approved1['current'][0]/(60/60)*40;
				$total_pay += $approved1['current'][0]/(60/60)*40*1.5;
			}
*/

		} else if($regular1[0]<=40){
			if($approved1['current'][0]>(40-$regular1[0])){
				//$total_pay += $regular1[0]*$regular1[1];
				$total_pay += ((40-$regular1[0])/$approved1['current'][0])*$approved1['current'][1];
				$total_pay += (($approved1['current'][0]-(40-$regular1[0]))/$approved1['current'][0])*$approved1['current'][1]*1.5;
			}

			$total_pay += ($regular1[0])*$regular1[1];
				
		}
	} else{
				$total_pay += ($regular1[0])*$regular1[1]+$approved1['current'][1]
						+$approved1['previous'][1];
	}
	$week2 = ($regular2[0]+$approved2['current'][0]);
	//echo ' --- ' . $week2;
	//echo '<br/>';


	if($week2 > 40){
		if($regular2[0] > 40){
			$total_pay += ($regular2[0]-40)*$regular2[1]*1.5;
			$total_pay += 40*$regular2[1];
/*
			if($approved1['current'][0]>(40-$regular1[0])){
				$total_pay += $approved1['current'][0]/(60/60)*40;
				$total_pay += $approved1['current'][0]/(60/60)*40*1.5;
			}
*/

		} else if($regular2[0]<=40){
			if($approved2['current'][0]>(40-$regular2[0])){
				//$total_pay += $regular1[0]*$regular1[1];
				$total_pay += ((40-$regular2[0])/$approved2['current'][0])*$approved2['current'][1];
				$total_pay += (($approved2['current'][0]-(40-$regular2[0]))/$approved2['current'][0])*$approved2['current'][1]*1.5;
			}

			$total_pay += ($regular2[0])*$regular2[1];
				
		}
	} else{
				$total_pay += ($regular2[0])*$regular2[1]+$approved2['current'][1]
						+$approved2['previous'][1];
	}



















	//COMPLETE
	//total time spent working in 2 week period
	$total_time += ($regular1[0]+$approved1['current'][0]+$approved1['previous'][0])*60*60;
	$total_time += ($regular2[0]+$approved2['current'][0]+$approved2['previous'][0])*60*60;











		$r[] = array($emp[$i][0], 
				$emp[$i][1] . ' ' . $emp[$i][2], 
				$emp[$i][3],
			convertSecondsToTime($total_time),
//		getHoursForId($emp[$i][0], getCurrentWeek(), 2),
			"$" . number_format(round($total_pay, 2), 2)
//	calculatePay(getHoursForId($emp[$i][0],getCurrentWeek(), 2), $emp[$i][3])
			);
	}
//	print_r($r);
	return $r;
}

function printEmpTableBottom($emp){

	for($i=0; $i<count($emp); ++$i){
		echo '<tr>';

		echo '
		<td>
			<a href="javascript:void(null);update(\''.
			$emp[$i][0] . '\', \''.
			$emp[$i][0] . '\',
			\'del\');">Delete</a>' .
		'<br/>

			<a href="javascript:void(null);update(\''.
			$emp[$i][0] . '\', \''.
			$emp[$i][0] . '\',
			\'act\');">Activate</a>' .
		'<br />
			<a href="javascript:void(null);update(\''.
			$emp[$i][0] . '\', \''.
			$emp[$i][0] . '\',
			\'unact\');">Deactivate</a>
		</td>
		';

		//ACTIONS GO HERE
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

function printApprovalTableBottom($from, $to){
	$link = initDb();
	selectDb($link);
	
	//echo $from . '<br />' . $to;
	$query = 0;
	//echo $user_id;
	if(!isset($_GET['id'])){
	$query = "SELECT request, user_id, hours, wage, rollover,
			approved, reason FROM approvals
			WHERE DATE_FORMAT(`date`, '%m-%d-%Y')>='{$from}'
			AND DATE_FORMAT(`date`,'%m-%d-%Y')<'{$to}'
			AND user_id='{$_COOKIE['id']}'
			ORDER BY user_id ASC";
	//echo $query;
	} else{
		$query = "SELECT request, user_id, hours, wage, rollover,
			approved, reason FROM approvals
			WHERE DATE_FORMAT(`date`, '%m-%d-%Y')>='{$from}'
			AND DATE_FORMAT(`date`,'%m-%d-%Y')<'{$to}'
			AND company_id='{$_COOKIE['id']}'
			AND user_id='{$_GET['id']}'
			ORDER BY user_id ASC";
	
	//echo $query;
	}
	$emp = queryDbAll($link, $query);
	
	for($i=0; $i<count($emp); ++$i){
		//$l= '<a href="javascript:void(null);update(\''.
		//$emp[$i][0] . '\', \'d\');">Delete</a>';
	
		
		for($j=0; $j<count($emp[$i]);++$j){
			if($j==0){
		echo '<tr>
		<td>
			<a href="javascript:void(null);update(\''.
			$emp[$i][$j] . '\', \''.
			$emp[$i][1] . '\',
			\'d\');">Delete</a>' .
		'<br/>

			<a href="javascript:void(null);update(\''.
			$emp[$i][$j] . '\', \''.
			$emp[$i][1] . '\',
			\'a\');">Approve</a>' .
		'<br />
			<a href="javascript:void(null);update(\''.
			$emp[$i][$j] . '\', \''.
			$emp[$i][1] . '\',
			\'un\');">Unapprove</a>
		</td>
		';
				
			}else if($j==1){
				echo '<td>';
				echo '<a href="weekly_time_detail.php?id=';
				echo $emp[$i][$j];
				echo '" target="_blank">';
				echo $emp[$i][$j];
				echo '</a>';
				echo '</td>';
			}else {
				if($j==5 && $emp[$i][$j] == 1 ){
					echo '<td class="green">';
					//echo '<img src="/images/green-check.png" alt="Green Check Mark"/>';
					echo '&nbsp;';
				} else if($j==5){
					echo '<td class="red">';
					echo '&nbsp;';
				} else{
					echo '<td>';
					echo $emp[$i][$j];
				}
				echo '</td>';
			}
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
