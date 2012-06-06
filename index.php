<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
 <?php 
echo "<p>Hello World</p>"; 
$myFile = "php/payroll.txt";
$fh = fopen($myFile, 'a') or die("can't open file");
$stringData = "AWD\n";
fwrite($fh, $stringData);
fclose($fh);

?> 
 </body>
</html>	
