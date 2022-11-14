<?php
if(empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  http_response_code(500);
  exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$m_subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/PHPMailer/src/Exception.php';
require '/PHPMailer/src/PHPMailer.php';
require '/PHPMailer/src/SMTP.php';

// Instantiation and passing [ICODE]true[/ICODE] enables exceptions
$mail = new PHPMailer(true);

try {

  //Mail content
  $to = "info@hklsolarpower.co.za"; // Change this email to your //
  $subject = "$m_subject:  $name";
  $body = "You have received a new message from your website (HKL Solar Power) contact form.\n\n"."Here are the details:\n\nName: $name\n\n\nEmail: $email\n\nSubject: $m_subject\n\nMessage: $message";


  //Server settings
  $mail->SMTPDebug = 2; // Enable verbose debug output
  $mail->isSMTP(); // Set mailer to use SMTP
  $mail->Host = 'mail.hklsolarpower.co.za'; // Specify main and backup SMTP servers
  $mail->SMTPAuth = true; // Enable SMTP authentication
  $mail->Username = $to; // SMTP username
  $mail->Password = 'secret'; // SMTP password
  $mail->SMTPSecure = 'tls'; // Enable TLS encryption, [ICODE]ssl[/ICODE] also accepted
  $mail->Port = 468; // TCP port to connect to
 
 //Recipients
  $mail->setFrom($to, 'Mailer');
  //$mail->addAddress('recipient1@example.net', 'Joe User'); // Add a recipient
  //$mail->addAddress('recipient2@example.com'); // Name is optional
  $mail->addReplyTo($mail, 'HKL Solar Power Information');
  //$mail->addCC('cc@example.com');
  //$mail->addBCC('bcc@example.com');
 
 // Attachments
  //$mail->addAttachment('/home/cpanelusername/attachment.txt'); // Add attachments
  //$mail->addAttachment('/home/cpanelusername/image.jpg', 'new.jpg'); // Optional name
 
 // Content
  $mail->isHTML(true); // Set email format to HTML
  $mail->Subject = $subject;
  $mail->Body = $message;
  $mail->AltBody = $message;

  if(!$mail->send()){
    http_response_code(500);
  }
} catch (Exception $e) {
  http_response_code(500);
}

/*$to = "info@hklsolarpower.co.za"; // Change this email to your //
$subject = "$m_subject:  $name";
$body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\n\nEmail: $email\n\nSubject: $m_subject\n\nMessage: $message";
$header = "From: $email";
$header .= "Reply-To: $email";
$header .= 'X-Mailer: PHP/' . phpversion();
$header .= "X-Priority: 1\n";
$header .= "Return-Path: info@hklsolarpower.co.za\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-Type: text/html; charset=iso-8859-1\n";

if(!mail($to, $subject, $body, $header,))
  http_response_code(500);*/

?>
