<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
 <?php 
echo "<p>Hello World</p>"; 
$myFile = "php/payroll.txt";
$fh = fopen($myFile, 'a') or die("can't open file");
$stringData = "";
if(isset($_POST['width'])){
	//$stringData = $_POST['width'] . "\n";
	$stringData = "ELSE" . "\n";
}else {
	$stringData = "ABC\n";
}
fwrite($fh, $stringData);
fclose($fh);
echo "<p>BYE</p>"; 

?> 
 </body>
</html>	
