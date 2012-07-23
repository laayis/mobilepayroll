<?php
include('../AuthClass.php');
$user = authenticateUser();
//include('AdminClass.php');
$form = grabForm();
//echo $form['license'];
$link = initDb();
selectDb($link);

if(isset($form['name'])){
        $query = "SELECT subscribed_devices.license AS id FROM subscribed_devices WHERE license='{$form['license']}'";
        $license = queryDb2($link, $query);

        if($license != 'Error: In queryDb2'){
                //update name for subscribed_devices
                $query = "UPDATE subscribed_devices SET
                        name='". $form['name'] . "'
                         WHERE subscribed_devices.license='{$form['license']}'";
		echo $query;
                $result= queryDb($link, $query);
        }
       	
}else if(isset($form['license'])){
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
}

?>
