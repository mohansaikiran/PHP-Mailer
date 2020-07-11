<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once "PHPMailer/PHPmailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";


if(isset($_POST["email"])) {

    $email = $_POST["email"];
    $id = rand(1001,9999); //creates a random number --> Use for OTP later

    $mail = new PHPMailer();
    try {
    $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
        );

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'medicochain33@gmail.com';
    $mail->Password = 'medicochain8792';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';

    $url = "http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"])."/resetPassword.php?id=$id";

    $mail->isHTML(true);
    $mail->setFrom('medicochain33@gmail.com', 'MedicoChain');
    $mail->addAddress($email);
    $mail->Subject = "Reset Your OTP";
    $mail->Body = "<h1>You requested for Password Reset.</h1>
                    <a href='$url'>Click this link</a>";

    $mail->send();
    echo "Mail has been sent";
    }
    catch(Exception $e) {
        echo "Something went wrong <br>" . $mail->ErrorInfo;
    }
    exit();
}



?>

<form method="POST">
    <input type="text" name="email" placeholder="Enter Email" autocomplete="off">
    <br>
    <input type="submit" name="submit" value="Reset Password">
</form>