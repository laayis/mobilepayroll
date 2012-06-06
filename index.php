<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
 <?php 
echo "<p>Hello World</p>"; 
$myFile = "php/payroll.txt";
$fh = fopen($myFile, 'a') or die("can't open file");
if(count($_POST) > 0 ){
	$stringData = "$_POST['width']\n";
}else {
	$stringData = "ABC";
}
//$stringData = "HI\n";
fwrite($fh, $stringData);
fclose($fh);

?> 
 </body>
</html>	
