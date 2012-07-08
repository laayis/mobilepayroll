<?php
 $to = "winicius@gmail.com";
 $subject = "Hi!";
 $body = "Hi,\n\nHow are you?";
$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

 if (mail($to, $subject, $body, $header)) {
   echo("<p>Message successfully sent!</p>");
  } else {
   echo("<p>Message delivery failed...</p>");
  }
 ?>
