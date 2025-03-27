<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$mail = new PHPMailer(true);
try {
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = 'mail.vibegrid.ir';
    $mail->SMTPAuth = true;
    $mail->Username = 'support@vibegrid.ir';
    $mail->Password = '8q8QmR4WS2*vl!';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom('support@vibegrid.ir', 'Vibe Grid Social Network');
    $mail->addAddress('m989mahdi@gmail.com', 'User'); // Add a recipient
    $mail->addAddress('m989mahdi@gmail.com'); // Name is optional
    $mail->addReplyTo('support@vibegrid.ir.com', 'Information');
    $mail->addCC('m989mahdi@gmail.com');
    $mail->addBCC('m989mahdi@gmail.com');
    //$mail->addAttachment('/home/cpanelusername/attachment.txt'); // Add attachments
    //  $mail->addAttachment('/home/cpanelusername/image.jpg', 'new.jpg'); // Optional name
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();
} catch (Exception $e) {
    echo "";
}