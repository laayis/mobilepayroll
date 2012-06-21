<?php
include_once('../AuthClass.php');

function getEmployeesInCompany($company_id){
	$link = initDb();
	selectDb($link);


	$query = "
	SELECT contact_info.id, contact_info.first, contact_info.last
	FROM contact_info
	WHERE contact_info.company_id=$company_id
	";
	$result = mysql_query($query);
	if (!$result) {
	    die('Invalid query: ' . mysql_error());
	}
	
	$temp = array();

	while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
		$temp[] = array($row['id'],$row['first'],$row['last']);
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
		$temp[] = array($row['license'],$row['active']);
	}

	//print_r($temp);
	return $temp;
	
}

function printTableTop($columns, $tbname){
echo '
	<table border="2" cellpadding="0" cellspacing="0" bordercolor="#EFEFE4" >
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
