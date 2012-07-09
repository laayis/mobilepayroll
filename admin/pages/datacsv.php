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
	}

} else if(isset($_GET['export'])){
		include_once('../AdminClass.php');
		// We'll be outputting a csv
		header('Content-type: text/csv');
		// It will be called downloaded.pdf
		header('Content-Disposition: attachment; filename="downloaded.csv"');

		$emp = getEmployeesInCompany($id);
		//print_r($emp);
		$from = $_GET['export'];
		$to = addDaysToDate(7*2, $from);
		$paychecks = prepareEmpOutput($emp, $from, $to);
		$name='';
		$pay='';
		foreach($paychecks as $value){
			$name .= $value[1] . ',';
			$pay .= $value[4] . ',';
		}
		$name = rtrim($name, ',');
		$pay = rtrim($pay, ',');
		echo $name . '
';
		echo $pay;
}

?>
