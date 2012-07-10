<?php

include('../AuthClass.php');
include('../TableClass.php');
$id = authenticateUser();
		//echo $_POST['date'];
		//echo $_POST['timei'];
		//echo $_POST['timef'];
		
		//before deleting entry, get license key
		$query = "SELECT license AS id FROM `clock` WHERE `date` = '"
			. $_POST['date'] . " "
			. $_POST['timei'] . "' AND id='"
			. getID() . "'";
		$link = initDb();
		selectDb($link);
		//echo $query;
		$license = queryDb2($link, $query);

		//delete clock entry
		$query = "DELETE FROM `clock` WHERE `date` = '"
			. $_POST['date'] . " "
			. $_POST['timei'] . "' AND id='"
			. getID() . "' AND license='{$license}'";
		//echo $query;
		queryDb($link, $query);
		
		//get next clock out
		$query = "SELECT date AS id FROM `clock` WHERE `date` > '"
			. $_POST['date'] . " "
			. $_POST['timei'] . "' AND id='". getID() . "' AND license='{$license}' ORDER BY date ASC";
		$nextclock = queryDb2($link, $query);
		echo $query . "-------<br /><br />";	
		echo $nextclock . "-------<br /><br />";	
		$query = "DELETE FROM `clock` WHERE `date` = '"
			. $nextclock . "' AND id='"
			. getID() . "'";
		queryDb($link, $query);
		echo $query . "-------<br /><br />";	
?>

