<?php

session_start();
error_reporting(0);
$varsesion = $_SESSION['Nombre'];

if($varsesion == null || $varsesion = ''){
  echo 'Usted no tiene autorización';
  die();
}
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

//Load Composer's autoloader
//require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'keyskycorporation@gmail.com';                     //SMTP username
    $mail->Password   = 'zyqmlcufbarnjpuq';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('keyskycorporation@gmail.com', 'KEYSKY');
    $mail->addAddress($_SESSION['Correo']);     //Add a recipient
    //$mail->addAddress('karennunez580@gmail.com');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('inicio.php');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = '¡KEYSKY te da la bienvenida!';
    $mail->msgHTML(file_get_contents('diseñoCorreo.php'));

    //Enviar correos con extensión php
    ob_start();
    include "diseñoCorreo.php";
    $message = ob_get_clean();
    $mail->msgHTML($message);

    // $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


    $mail->CharSet = 'UTF-8';

    $mail->send();
    echo 'Message has been sent';
    header("Location: inicio.php");
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
