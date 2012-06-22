<html>
<head><title>Test Form</title></head>
<body>
<?php
include('AppClass.php');

getallemployees();
?>

<form method='POST' action='addemployee.php'>
<input name='totable_id' type='text' value='id'/>
<input name='totable_first' type='text' value='license'/>
<input name='totable_last' type='text' value='date'/>
<input type='submit' value='submit' />
</form>
</body>
</html>
