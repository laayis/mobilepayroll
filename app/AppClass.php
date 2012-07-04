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
	if($active != 'Error: In queryDb2'){
		$query = "UPDATE `subscribed_devices` SET `active` = '1' WHERE `subscribed_devices`.`active`='0'
			AND `subscribed_devices`.`license` = '{$form['license']}'";
		queryDb($link, $query);
		echo "1";
	}else{
		echo "0";
	}

	return;
}

/*
function make_seed(){
  list($usec, $sec) = explode(' ', microtime());
  return (float) $sec + ((float) $usec * 100000);
}
*/
function generateFourDigit(){
	$temp = 0;
	$key='';

	// seed with microseconds
	mt_srand(make_seed());
	$temp = mt_rand();
	$letter = substr($temp,0,4);
	//$temp=mt_rand(5, 15);
	return $letter;
}
function generateLetter(){
	$temp = 0;
	$key='';

	// seed with microseconds
	mt_srand(make_seed());
	$temp = mt_rand();
	$letter = chr(($temp % 26) + 97);
	//$temp=mt_rand(5, 15);
	return $letter;
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

function generate9DigitId(){
	$temp = 0;
	$key='';

	$result=1;
	$link=initDb();
	selectDb($link);
	$id=0;
	for(;$result!=0;){
		// seed with microseconds
		mt_srand(make_seed());
		$temp = mt_rand();
		$id = substr($temp,0,9);
		//$temp=mt_rand(5, 15);

		$query = "SELECT id FROM contact_info WHERE id={$letter}";
		$result = queryDb2($link, $query);
		//echo $result . '<br />';
		//echo $i . '<br />';
	}
	//echo $id . '<br />';
	return $id;
}

function generateUsername($f, $l){
	$letter = generateLetter();
	$username = strtolower(substr($f,0,1) . $letter . substr($l,0,1));
	$username .= generateFourDigit();
	$key = generateKey();
	$password = substr($key,0,4);
	return(array('username'=>$username, 'password'=>$password));
}

function createUser(){
	$form = grabForm();
	$link=initDb();
	selectDb($link);
//get company_id
$query = "SELECT subscribed_devices.company_id AS id 
FROM subscribed_devices
WHERE subscribed_devices.license = '" . $form['license'] .
"' LIMIT 1";

	//get company_id
	$id = queryDb2($link, $query);
	//print_r($id);
	if($id == 0){
		//echo $query;
		echo "Wrong login information.";
		//echo '0';
		return;
	}
// 	date 	id  	location 	company_id 	look_ahead 	license 

	//$inout = isClockInOrOut($form['id'], $form['license']);
	$user = generateUsername($form['first'], $form['last']);
	//print_r($user);
	$query = "INSERT INTO contact_info (" . 
	"`id`, `username`, `password`, `company_id`, `first`, `last`) VALUES( " . 
        "'" . generate9DigitId() . "', " .
        "'" . $user['username'] . "', " .
        "'" . $user['password'] . "', " .
        "'" . $id . "', " .
        "'" . $form['first'] . "', " .
        "'" . $form['last'] . "')";
	//insert
	$temp = queryDb($link, $query);
	if($temp == TRUE){
		echo json_encode(array('employee'=>$user));
		return;
	} else{
		echo "0";
		return;
	}

}

function clockUser(){
	$form = grabForm();
	$link=initDb();
	selectDb($link);
//print_r($form);
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
