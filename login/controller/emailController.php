<?php
    require_once 'vendor/autoload.php'; // automatically loads any class coming from the libraries in the vendor folder
    require_once 'config/db.php';

    // Create the Transport
    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
    ->setUsername(EMAIL)
    ->setPassword(PASS);   

    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

    // Send the message

    function sendVerificationEmail($useremail,$token){

        global $mailer;

        $body='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Document</title>
        </head>
        <body>
            <div class="wrapper">
                <p>Thank you for signing up on our website. Please click on the link below to verify email.</p>
                 <a href="http://localhost/login/index.php?token='.$token.'">
                    Verify your email address
                </a>
            </div>
        </body>
        </html>';


        // Create a message
        $message = (new Swift_Message('ProJ: Verify you email address!'))
        ->setFrom(EMAIL)
        ->setTo($useremail)
        ->setBody($body,'text/html');

        $result = $mailer->send($message);
        
    }
?>