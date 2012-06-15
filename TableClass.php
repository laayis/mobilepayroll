<?php
function getCompanyId($user_id){
	$query = "SELECT employee.company_id FROM employee WHERE employee.id='" . $user_id . "'";
	$result = mysql_query($query);
	if (!$result) {
	    die('Invalid query: ' . mysql_error());
	}
	//get company_id to filter clock
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$company_id = $row['company_id'];
	return($company_id);
}
/*
function getHours(){
	$company_id = getCompanyId($_COOKIE['id']);
	$query = "SELECT clock.date FROM clock WHERE clock.id='" . $_COOKIE['id'] . "' AND clock.company_id = '" . $company_id . "'";
	$result = mysql_query($query);
	if (!$result) {
	    die('Invalid query: ' . mysql_error());
	}
	// make 'live' the current db
	$time = array();
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$time[] = $row['date'];
	}

	for($i=0; $i <count($time); ++$i){
		echo $time[$i];
	}
	return $time;
}
*/
/*
The lookAhead function is required. It makes sure that the first entry has a look_ahead of 0. 0 refers to a clockin, 1 refers to a clockout.

*/
function isLookAheadZero($date){

	$query = "SELECT look_ahead AS look FROM clock WHERE id='"
	. $_COOKIE['id'] .
	"' AND date BETWEEN '"
	. $date .
	"' AND DATE_ADD('"
	. $date .
	"', INTERVAL 1 DAY) ORDER BY date ASC LIMIT 1";
	$result = mysql_query($query);
	if (!$result) {
	    die('Invalid query: ' . mysql_error());
	}
	//get company_id to filter clock
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$look = $row['look'];
	/*
	if(!$look){
		echo 'ZERO';
	} else{
		echo 'ONE';
	}
	*/
	return($look);
}

function getPunchOut($date){
	$query = "SELECT TIME(date) AS date FROM clock WHERE id='"
	. $_COOKIE['id'] .
	"' AND date BETWEEN DATE_ADD('"
	. $date .
	"', INTERVAL 1 DAY) AND DATE_ADD('"
	. $date .
	"', INTERVAL 2 DAY) ORDER BY date ASC LIMIT 1";


	$result = mysql_query($query);
	if (!$result) {
	    die('Invalid query: ' . mysql_error());
	}
	//get company_id to filter clock
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$temp = $row['date'];
	return($temp);
}


function getMax($temp){
	$max = 0;
	for($i=0; $i<count($temp); ++$i){
		if(count($temp[$i]) > $max){ $max=count($temp[$i]);}
	}

	return($max);
}



function printRowIn($link, $date, $weeks=1){
	echo '<table width="100%" border="2" cellpadding="0" cellspacing="0">';
printRowWeek($date, $weeks);

$temp = split('-',$date);
$month = $temp[0];
$day = $temp[1];
$year = $temp[2];
$from_unix_time = mktime(0, 0, 0, $month, $day, $year);
$milli_day = 60*60*24;

$tomo = strtotime("today", $from_unix_time);
$formatted = date('D M d', $tomo);

	$temp = array();

	//get the amount of punches for employee
	for($i=0;$i<7*$weeks;++$i){
			
		$tomo = strtotime("today", $from_unix_time);
		$formatted = date('Y-m-d', $tomo);
		$temp[] = getPunchesForDay($formatted);
		$from_unix_time += $milli_day;
	}


//print a rectangular screen
//since data input looks like this:
/*
Example: dashes are timestamps in a 2 dimentional array
---------
---
--------
---
-

---------
*/
	$max = getMax($temp);
for($j=0; $j<($max); $j=$j+2){
	echo '<tr>
	<td align="center">In</td>
	';
	//print time for row 'In'
	for($i=0;$i<7*$weeks;++$i){
		echo '<td class="columnColor0">&nbsp;';
		if(isset($temp[$i][$j])){echo $temp[$i][$j];}
		echo '</td>';
	}
	echo '<td class="columnColor0">&nbsp;';
	echo '</td>';


	//print time for row 'Out'
	echo '</tr><tr><td align="center">Out</td>';
	for($i=0;$i<7*$weeks;++$i){
		echo '<td class="columnColor0">&nbsp;';
		if(isset($temp[$i][$j+1])){echo $temp[$i][$j+1];}
		echo '</td>';
	}
	echo '<td class="columnColor0">&nbsp;';
	echo '</td>';

	echo '</tr>';
	
}
	echo '
	<tr>
		<td align="left" class="normal"><strong>Hours Worked</strong></td>
	';
	$hours = getHours($temp);
	for($i=0;$i<7*$weeks;++$i){
			echo '<td class="columnColor1"><strong>';
			echo $hours[$i];
			echo '</strong></td>';
	}

	$seconds = getSeconds($temp);
	$totalhours=0;
	for($i=0;$i<count($seconds); ++$i){
		$totalhours += $seconds[$i];
	}
	echo '<td class="columnColor1"><strong>';
	echo convertSecondsToTime($totalhours);
	echo '</strong></td>';
	echo '</table>';

}



function getPunchesForDay($date){
	$look = isLookAheadZero($date);
	$punches = array();
	$query = "SELECT TIME(date) AS date FROM clock WHERE id='" . $_COOKIE['id'] . "' AND date BETWEEN '"
	. $date .
	"' AND DATE_ADD('"
	. $date .
	"', INTERVAL 1 DAY) ORDER BY date ASC";
	
	$result = mysql_query($query);
	if (!$result) {
	    die('Invalid query: ' . mysql_error());
	}
	//get company_id to filter clock
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$punches[] = $row['date'];
	}

	$temp=getPunchOut($date);
	//make punch card even
	//4 combinations of look and max
	if(
	$look==0 && max%2==0
	){
		//do nothing
	} else if(
	$look==0 && max%2==1
	){
		//add last punchout
		$punches[] = $temp;
	}else if(
	$look==1 && max%2==0
	){
		$punches[] = $temp;
		array_shift($punches);
	} else if(
	$look==1 && max%2==1
	){
		array_shift($punches);
	}

/*
	$query = "SELECT look_ahead AS look FROM clock WHERE id='"
	. $_COOKIE['id'] .
	"' AND date BETWEEN '"
	. $date .
	"' AND DATE_ADD('"
	. $date .
	"', INTERVAL 1 DAY) ORDER BY date ASC LIMIT 1";
*/
	return($punches);
}

function convertSecondsToTime($sec){
	$seconds = ($sec)%60;
	$minutes = ($sec/60)%60;
	$hours = ($sec/60/60)%60;
	return($hours . "H" . $minutes . "M");
}

function getHours($punches){
	$seconds = getSeconds($punches);
	for($i=0; $i<count($punches);++$i){
		$seconds[$i] = convertSecondsToTime($seconds[$i]);
	}
	return $seconds;
}
function getSeconds($punches){

	$seconds=array();
for($j=0;$j<count($punches); ++$j){
	//echo "<br /> -------------" . count($punches[$j]);
	$temp=0;

	for($i=0;$i<count($punches[$j]); $i=$i+2){
		$workingsecs = (strtotime($punches[$j][$i+1])
				- strtotime($punches[$j][$i]));
		$temp += $workingsecs;
	}
	
	$seconds[] = $temp;
}
	//echo "<br />TOTAL HOURS:" . print_r($punches) . "<br />";

	return $seconds;
}

function countPeopleAtLocation(){
	$query = "SELECT employee.company_id FROM employee WHERE employee.id='" . $user_id . "'";
	$result = mysql_query($query);
	if (!$result) {
	    die('Invalid query: ' . mysql_error());
	}
	//get company_id to filter clock
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$company_id = $row['company_id'];
	return($company_id);
}

function addDaysToDate($days, $date){
	$temp = split('-',$date);
	$month = $temp[0];
	$day = $temp[1];
	$year = $temp[2];
	$from_unix_time = mktime(0, 0, 0, $month, $day, $year);
	$milli_day = 60*60*24;

	$secondsperday = 60*60*24;
	$tomo = strtotime("today", $from_unix_time+($secondsperday*$days));
	$formatted = date('m-d-Y', $tomo);
	return $formatted;

}

function printRowWeek($date, $weeks){
// set the default timezone to use. Available since PHP 5.1
date_default_timezone_set('UTC');
// Prints something like: Monday
// Prints something like: Monday 8th of August 2005 03:12:46 PM


echo'
	<tr>
	<td width="20%" align="center" class="normal"><strong>Punches /<br />
	Time Off</strong></td>
';
$temp = split('-',$date);
$month = $temp[0];
$day = $temp[1];
$year = $temp[2];
$from_unix_time = mktime(0, 0, 0, $month, $day, $year);
$milli_day = 60*60*24;

for($i=0; $i<7*$weeks;++$i){
$tomo = strtotime("today", $from_unix_time);
$formatted = date('D M d', $tomo);
$temp = split(' ', $formatted);
echo '
	<td width="10%" align="center" class="normal"><strong>
';
echo $temp[0] . "<br />" . $temp[1] . " " . $temp[2];
echo '</strong></td>';
$from_unix_time += $milli_day;
}
echo '
	<td width="20%" class="normal">
		<strong>Weekly Total</strong>
	    </td>
	</tr>
	
';


}
?>

