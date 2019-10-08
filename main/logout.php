<?php
    require_once '../login/controller/authController.php';

    session_destroy();
    foreach($_SESSION as $sess)
    {
        unset($sess);
    }
    header('location: ../index.php');
    exit();
?>