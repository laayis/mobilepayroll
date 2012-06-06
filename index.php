<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
 <?php 
echo "<p>Hello World</p>"; 
$myFile = "php/payroll.txt";
$fh = fopen($myFile, 'w') or die("can't open file");
$stringData = "";
if( isset($_POST['width']) ){
	$stringData = "$_POST['width']\n";
}else {
	$stringData = "ABC\n";
}
//$stringData = "HI\n";
fwrite($fh, $stringData);
fclose($fh);

?> 
 </body>
</html>	
