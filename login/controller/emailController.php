<?php
    require_once 'vendor/autoload.php'; // automatically loads any class coming from the libraries in the vendor folder
    require_once 'config/db.php';

    // Create the Transport
    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
    ->setUsername(EMAIL)
    ->setPassword(PASSWORD);   

    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

    // Send the message

    function sendEmailVerification($useremail,$token){

        global $mailer;

        $body='';


        // Create a message
        $message = (new Swift_Message('ProJ: Verify you email address!'))
        ->setFrom(EMAIL)
        ->setTo($useremail)
        ->setBody($body,'text/html');

        $result = $mailer->send($message);
        
    }
?>