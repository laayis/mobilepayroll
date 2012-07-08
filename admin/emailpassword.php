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

<h2>
