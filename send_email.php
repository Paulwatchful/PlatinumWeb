<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'vendor/autoload.php';

$mail = new PHPMailer\PHPMailer\PHPMailer();

$mail->isSMTP();
$mail->Host = 'mail.platinumhomecare.co.uk';
$mail->SMTPAuth = true;
$mail->Username = 'contactform@platinumhomecare.co.uk';
$mail->Password = 'Platinum10**'; // Your email password
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('contactform@platinumhomecare.co.uk', 'Platinum Homecare Contact Form');
$mail->addAddress($_POST['contactType']);
$mail->addReplyTo($_POST['email'], $_POST['name']);
$mail->addCC($_POST['email']); // This sends a copy to the person who filled the form

$mail->isHTML(true);

$mail->Subject = $_POST['subject'];
$mail->Body    = "Message from " . $_POST['name'] . " (" . $_POST['email'] . "): <br><br>" . $_POST['message'];

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
?>
