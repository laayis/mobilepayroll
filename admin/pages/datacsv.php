<?php

include('../../AuthClass.php');
$id = authenticateUser();

if(isset($_POST['request'])){
	if($_POST['request']=='employee'){
		$link = initDb();
		selectDb($link);

		$query = "SELECT date, count FROM history_employee WHERE company_id='{$id}' ORDER BY date ASC";
		$result = queryDbAll($link, $query);
		
		$date = 'Categories,';
		$count = showCompanyName($link, $id).',';
		foreach($result as $value){
			$date .= $value[0] . ',';
			$count .= $value[1] . ',';
		}
		$date = rtrim($date, ',');
		$count = rtrim($count, ',');
		echo $date . '
';
		echo $count;
	} else if($_POST['request']=='paycheck'){
		$link = initDb();
		selectDb($link);

		$query = "SELECT date, count FROM history_employee WHERE company_id='{$id}' ORDER BY date ASC";
		$result = queryDbAll($link, $query);
		
		$date = 'Categories,';
		$count = showCompanyName($link, $id).',';
		foreach($result as $value){
			$date .= $value[0] . ',';
			$count .= $value[1] . ',';
		}
		$date = rtrim($date, ',');
		$count = rtrim($count, ',');
		echo $date . '
';
		echo $count;

	}
}

?>
