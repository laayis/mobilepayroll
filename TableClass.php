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

function getHoursForId($user_id){
	$company_id = getCompanyId($user_id);
	$query = "SELECT clock.date FROM clock WHERE clock.id='" . $user_id . "' AND clock.company_id = '" . $company_id . "'";
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
}

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

function getPunchesForDay($date){
	$look = isLookAheadZero($date);
	$punches = array();
	$query = "SELECT TIME(date) AS date FROM clock WHERE id='" . $_COOKIE['id'] . "' AND date BETWEEN '2012-06-09' AND '2012-06-10' ORDER BY date ASC";

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
function displayDayPunches($punches){

	$temp=0;
	for($i=0;$i<count($punches); $i=$i+2){
		$workinghours = (strtotime($punches[$i+1])
				- strtotime($punches[$i]));
		$temp = $temp + $workinghours;
	}
	echo "<br />TOTAL HOURS:" . convertSecondsToTime($temp) . "<br />";

	
	for($i=0;$i<count($punches); $i=$i+2){
		$workinghours = (strtotime($punches[$i+1])
				- strtotime($punches[$i]));

		echo "<br />" . convertSecondsToTime($workinghours) . "<br />";
	}
	//if previous date is odd
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

function printRowHours(){

}
function printRowWeek($date){
// set the default timezone to use. Available since PHP 5.1
date_default_timezone_set('UTC');
$temp = split('-',$date);

$month = $temp[1];
$day = $temp[3];
$year = $temp;
// Prints something like: Monday
// Prints something like: Monday 8th of August 2005 03:12:46 PM

$from_unix_time = mktime(0, 0, 0, $month, $day, $year);
$milli_day = 60*60*24;

echo'
	<tr>
	<td width="20%" align="center" class="normal"><strong>Punches /<br />
	Time Off</strong></td>
';


for($i=0; $i<7;++$i){
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


// Prints: July 1, 2000 is on a Saturday

/*
	$query = "SELECT DATE_FORMAT('2012-06-09', '%a %b %d') AS date WHERE "
	."date BETWEEN '"
	. $date .
	"' AND DATE_ADD('"
	. $date .
	"', INTERVAL 14 DAY) ORDER BY date ASC LIMIT 14";

	$result = mysql_query($query);
	if (!$result) {
	    die('Invalid query: ' . mysql_error());
	}
	//get company_id to filter clock
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$temp = $row['date'];
		echo $temp;
	}
*/
	//return($temp);
}
?>

