<?php
header('Content-Type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$response = ["status" => "error"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'harshmodi084@gmail.com';
        $mail->Password   = '';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('harshmodi084@gmail.com', 'Portfolio Contact');
        $mail->addReplyTo($_POST['email'], $_POST['name']);
        $mail->addAddress('harshmodi084@gmail.com');

        $mail->Subject = "New Contact Message";
        $mail->Body = "
        Name: {$_POST['name']}
        Email: {$_POST['email']}
        Phone: {$_POST['phone']}
        Message: {$_POST['message']}
        ";

        $mail->send();

        $response["status"] = "success";

    } catch (Exception $e) {
        $response["message"] = $mail->ErrorInfo;
    }
}

echo json_encode($response);
exit;
