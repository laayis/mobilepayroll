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
	SELECT subscribed_devices.name, subscribed_devices.license, subscribed_devices.active
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

		//create javascript action	
		$h = '<input onblur="renewname(\''.
		$row['license']
		.'\')" type="text" id="location-name-'.
		$row['license']
		.'" value="'.
		$row['name']
		.'"/>';
		$temp[] = array($h,$row['license'],$row['active'], $l);
	}

	//print_r($temp);
	return $temp;
	
}

function printTableTop($columns, $tbname, $w='700px', $topright=''){
echo '
	<table width='
	.
	$w
	. '" border="2" cellpadding="0" cellspacing="0" bordercolor="#EFEFE4" >
		<tr><td colspan="'.count($columns).'" bgcolor="EFEFE4" class="normal"> 
			<span class="left"><strong>' .
		$tbname
		. '</strong></span>';

		echo $topright;
echo '
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
function getCurrentWeek($id=0){
	if($id==0){
		die();
	}
	$link = initDb();
	selectDb($link);
	
	$query = "SELECT DATE_FORMAT(biweekly, '%m-%d-%Y') as id FROM company
		WHERE `company`.`id`='{$id}'";
	$result = queryDb2($link, $query);
	
	return $result;
}

function changeCurrentWeek($id){
	$today = date("m-d-Y", strtotime("now"));
	$current = strtotime(getCurrentWeek($id));
	$today=strtotime(addDaysToDate(-14, $today));
	$n=0;
/*
	if($current <= $today){
		$n = addDaysToDate(14, getCurrentWeek($id));
		$link = initDb();
		selectDb($link);
		$query = "UPDATE company SET `biweekly`=DATE(STR_TO_DATE('{$n}', '%m-%d-%Y')) WHERE id='{$id}'";
		queryDb($link, $query);
	} else{
		$n='false';
	}
	echo $current;
	echo '---<br/>';
	echo $today;
*/
	return $n;
}
/*
Regular hours are hours calculated from the clock table.
*/
function payWeek($regular, $approved){
$t_pay=0;
$t_hours=0;
/*
*Calculate Hours for Week1
*
*
*
*/
//calculate regular hours
foreach($regular as $value){
	$t_hours += $value[0];
	if($t_hours < 40){
		$t_pay += $value[0]*$value[1];
	} else{
		if($t_hours-$value[0] < 40){
			$t_pay += ($value[0]-($t_hours%40))*$value[1];
			$t_pay += ($t_hours%40)*$value[1]*1.5;
		} else{
			$t_pay += $value[0]*$value[1]*1.5;
		}
	}
}
//calculate approved non-rollover hours
foreach($approved as $value){
	//$value[2] defines the rollover
	if($value[2] == 0){
		$t_hours += $value[0];
		if($t_hours < 40){
			$t_pay += $value[0]*$value[1];
		} else{
			if($t_hours-$value[0] < 40){
				$t_pay += ($value[0]-($t_hours%40))*$value[1];
				$t_pay += ($t_hours%40)*$value[1]*1.5;
			}else{
				$t_pay += $value[0]*$value[1]*1.5;
			}
		}
	}
}

//calculate approved rollover hours
foreach($approved as $value){
	//$value[2] defines the rollover
	if($value[2] == 1){
		$t_hours += $value[0];
		$t_pay += $value[0]*$value[1];
	}
}
$r = array('hours'=>$t_hours, 'pay'=>$t_pay);
return($r);

}


function prepareEmpOutput($emp, $from, $to){
//	print_r($emp);

	//$r for return
	$mid = addDaysToDate(7, $from);
	//echo $from . '----'. $mid .'----' . $to . '<br /><br />';
	$r = array();
	//for($i=0; $i<count($emp)-count($emp)+1; ++$i){
	for($i=0; $i<count($emp); ++$i){
		//week one and week 2 of biweek
		$regular1=getHoursWage(getHoursForId($emp[$i][0], $from, 1));
		//print_r($regular1);
		$regular2=getHoursWage(getHoursForId($emp[$i][0], $mid, 1));
		
		//hoursHeader($emp[$i][0], $from, $mid);
		//hoursHeader($emp[$i][0], $mid, $to);
		$approved1=getApprovalHoursAdminForId($emp[$i][0], $from, $mid);
		$approved2=getApprovalHoursAdminForId($emp[$i][0], $mid, $to);
		//print_r($approved1);
		//echo '<br /><br />';
		//print_r($approved2);
		$t_pay = 0;
		$t_hours = 0;

		/*
		*Calculate Hours for Week1
		*/
		$p=payWeek($regular1, $approved1);
		$t_pay += $p['pay'];
		$t_hours += $p['hours'];

		/*
		*Calculate Hours for Week2
		*/
		$p=payWeek($regular2, $approved2);
		$t_pay += $p['pay'];
		$t_hours += $p['hours'];
		if($t_pay != 0.00){
		$r[] = array($emp[$i][0], 
				$emp[$i][1] . ' ' . $emp[$i][2], 
				$emp[$i][3],
			convertSecondsToTime($t_hours*60*60),
			"$" . number_format(round($t_pay, 2), 2)
			);
		}
	}
//	print_r($r);
	return $r;
}

function printEmpTableBottom($emp, $from=0){

	for($i=0; $i<count($emp); ++$i){
		echo '<tr>';
		echo '
		<td>';
/*
			<a href="javascript:void(null);update(\''.
			$emp[$i][0] . '\', \''.
			$emp[$i][0] . '\',
			\'del\');">Delete</a>' .
		'<br/>
*/

		echo	'<a href="javascript:void(null);update(\''.
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
				if($from!=0){
				echo '&from=' . $from;
				}
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

function printApprovalTableBottom($from, $to, $user=0){
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
			AND company_id='{$user['company_id']}'
			ORDER BY user_id ASC";
	//echo $query;
	} else{
		$query = "SELECT request, user_id, hours, wage, rollover,
			approved, reason FROM approvals
			WHERE DATE_FORMAT(`date`, '%m-%d-%Y')>='{$from}'
			AND DATE_FORMAT(`date`,'%m-%d-%Y')<'{$to}'
			AND company_id='{$user['company_id']}'
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
	';
}

function printTableBottom($emp){
	for($i=0; $i<count($emp); ++$i){
		echo '<tr>';
		//Count
		echo '<td>';
		echo $i+1;
		echo '</td>';
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
