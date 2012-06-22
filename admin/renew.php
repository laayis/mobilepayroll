<?php
include('../AuthClass.php');

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
                //echo $temp;
                $key .= substr($temp,0,4) . "-";
        }
        return rtrim($key, '-');

}


//include('AdminClass.php');
$form = grabForm();
//echo $form['license'];
$link = initDb();
selectDb($link);

$query = "SELECT subscribed_devices.license AS id FROM subscribed_devices WHERE license='{$form['license']}'";
$result = queryDb2($link, $query);

if($result != 'Error: In queryDb2'){
	//echo $result;
	$key = generateKey();
	
	//update license for subscribed_devices
	$query = "UPDATE subscribed_devices SET active='0',
		license='". $key . "'
		 WHERE subscribed_devices.license='{$result}'";
	$result= queryDb($link, $query);
	//update license for clock
	$query = "UPDATE clock SET license='{$key}'
		 WHERE clock.license='{$form['license']}'";
	$result= queryDb($link, $query);
}
//update license in database


/*
include('AdminClass.php');
if(isset($_COOKIE['SESSID'])){
       if($_COOKIE['SESSID'] == session_id()){
		$form = grabForm();
		echo $form['license'];
		
		
	}else {
		header('Location: http://timesheet.elasticbeanstalk.com');
	}
} else{
	header('Location: http://timesheet.elasticbeanstalk.com');
}*/
?>