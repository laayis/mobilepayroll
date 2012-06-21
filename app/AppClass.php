<?php
include('../AuthClass.php');
include('../TableClass.php');


/*
	Function: clockUser()
	
	Input: id, time, license, in
*/
function setAppKey(){
	$form = grabForm();
	$link=initDb();
	selectDb($link);
	$query = "SELECT subscribed_devices.active AS id FROM subscribed_devices "
		. "WHERE subscribed_devices.license='"
		. $form['license'] . "' AND "
		. "subscribed_devices.active='0'";


	$active = queryDb2($link, $query);
	if($active == '0'){
		$query = "UPDATE `subscribed_devices` SET `active` = '1' WHERE `subscribed_devices`.`active`='0'
			AND `subscribed_devices`.`license` = '{$form['license']}'";
		queryDb($link, $query);
		echo "1";
	}else{
		echo "0";
	}

	return;
}

function make_seed(){
  list($usec, $sec) = explode(' ', microtime());
  return (float) $sec + ((float) $usec * 100000);
}

function generateKey(){
	$temp = 0;
	$key='';

	// seed with microseconds
	for($i=0; $i<4; ++$i){
		mt_srand(make_seed());
		$temp = mt_rand();
		//$temp=mt_rand(5, 15);
		$temp=md5($temp);
		echo $temp;
		$key .= substr($temp,0,4) . "-";
	}
	echo rtrim($key, '-');

}

function getallemployees(){
	$form = grabForm();
	$link=initDb();
	selectDb($link);

	$query = "SELECT contact_info.id, contact_info.first, contact_info.last
	FROM contact_info
	WHERE contact_info.company_id='1'";

	$result = queryDbAll($link, $query);

	//array of dictionaries
	$t=array();
	for($i=0;$i<count($result); ++$i){
		$t[]=array('id'=>$result[$i][0],'first'=>$result[$i][1],'last'=>$result[$i][2]);
	}
	$t = array('employees' => $t);
	$temp = json_encode($t);
	echo $temp;
}

function clockUser(){
	$form = grabForm();
	$link=initDb();
	selectDb($link);
print_r($form);
	//insert into clock if license==company_id && company_id==emp_id
$query = "SELECT contact_info.id 
FROM contact_info, company, subscribed_devices
WHERE company.id = subscribed_devices.company_id
AND company.id = contact_info.company_id
AND subscribed_devices.license = '" . $form['license'] .
"' AND contact_info.id = '" . $form['id'] . "'";

	$id = queryDb2($link, $query);
	//print_r($id);
	if($id == 0){
		//echo "Wrong login information.";
		echo '0';
		return;
	}
// 	date 	id  	location 	company_id 	look_ahead 	license 

	$inout = isClockInOrOut($form['id'], $form['license']);
	$query = "INSERT INTO clock (" . 
	"`date`, `id`, `look_ahead`, `company_id`, `license`) VALUES( " . 
        "'" . $form['date'] . "', " .
        "'" . $form['id'] . "', " .
        "'" . $inout . "', " .
        "'" . getCompanyId($form['id']) . "', " .
        "'" . $form['license'] . "')";
	//insert
	$temp = queryDb($link, $query);
	if($temp == TRUE){
		echo "1";
	} else{
		echo "0";
	}

}




?>
