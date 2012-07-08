<?php session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/securimage/securimage.php';

$securimage = new Securimage();

if ($securimage->check($_POST['captcha_code']) == false) {
  // the code was incorrect
  // you should handle the error so that the form processor doesn't continue

  // or you can use the following code if there is no validation or you do not know how
	header('Location: http://timesheet.elasticbeanstalk.com/');
  echo "The security code entered was incorrect.<br /><br />";
  echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
  exit;
}

?>




<?php
 $to = "winicius@gmail.com";
 $subject = "Hi!";
 $body = "Hi,\n\nHow are you?";
$headers = 'From: winicius@gmail.com' . "\r\n" .
    'Reply-To: winicius@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

 if ($result=mail($to, $subject, $body, $header)) {
   echo "<p>Message successfully sent!</p> {$result}";
  } else {
   echo "<p>Message delivery failed...</p>";
  }
 ?>

