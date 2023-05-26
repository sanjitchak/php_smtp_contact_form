<?php
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];

    $mail = new PHPMailer;
    try {
        //Server settings
        $mail->SMTPDebug = 0;                                 
        $mail->isSMTP();                                      
        $mail->Host = 'smtp.hostinger.com';                     
        $mail->SMTPAuth = true;                               
        $mail->Username = 'from@test.com';                 
        $mail->Password = 'test123';                           
        $mail->SMTPSecure = 'ssl';                           
        $mail->Port = 465;                                    

        //Recipients
        $mail->setFrom('from@test.com', 'From User');
        $mail->addAddress('to@example.com', 'To User');    

        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = 'Form Submission: ' . $name;
        $mail->Body    = "Received a form submission:<br>Name: $name<br>Email: $email<br>Phone: $phone<br>Message: $message";

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}
?>
