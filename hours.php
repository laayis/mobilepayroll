<?php
include('AuthClass.php');
include('Session.php');
include('TableClass.php');
?>

<?php
$link = initDb();
selectDb($link);
echo getCompanyId($_COOKIE['id']);
echo getHoursForId($_COOKIE['id']);
$punches = getPunchesForDay('2012-06-09');
displayDayPunches($punches);

//TOP BAR WITH name

?>
