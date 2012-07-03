<?php
include('../AuthClass.php');

$t = array_keys($_POST);
//print_r($t);
$select = array();
$value = array();
for($i=0;$i<count($t); ++$i){
	$sp = preg_split("/totable_/", $t[$i]);
	if(isset($sp[1])){
		if($sp[1] != ''){
			$select[] = $sp[1] ;
			$value[] = $_POST['totable_' . $sp[1]];
		}
	}
}
//print_r($select);
$t = "";
$tvalue="";
for($i=0;$i<count($select); ++$i){
		echo $value[$i] . '---' . $select[$i] . "<br />";
		if($i != 0){
			$t = $t . ', ' . $select[$i] . '="' . $value[$i] . '"';
		} else{
			$t = $select[$i] . '="' . $value[$i] . '"';
		}
}
$link = initDb();
selectDb($link);
$query= "UPDATE contact_info SET " . $t . " WHERE id=" . $_COOKIE['id'];
echo "<br />" . $query;
queryDb($link, $query);
header('Location: http://timesheet.elasticbeanstalk.com/admin/pages/personal_data_change.php');

//echo "<br />------hello";
?>
