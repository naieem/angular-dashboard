<?php
$name=$_POST['fname'];
$email=$_POST['email'];
$msg=$_POST['msg'];
$email_to = "naieemsupto@gmail.com,shahadat.dev@ygmail.com,contact@salesripe.com";
$email_subject="Ticket";
$headers = "From: " . strip_tags($email) . "\r\n";
$headers .= "Reply-To: ". strip_tags($email) . "\r\n";
$headers .= "CC: naieemsupto@gmail.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = '<html><body>';
$message .= '<h3>Hi,</h3>';
$message.='I am '.$name.'. '.$msg;
$message.='<br>Regards<br>';
$message.=$name;
$message .= "</body></html>";
mail($email_to, $email_subject,$message, $headers);
echo "Thank You.We have recieved your ticket.We will contact you soon.";