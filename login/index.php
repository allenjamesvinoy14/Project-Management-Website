<?php 
    require_once 'controller/authController.php'; 

    // if(isset($_GET['token'])){
    //     $token = $_GET['token'];
    //     verifyUser($token);
    // }

    // below makes sure that I have to login to access the index.php file.

    if(!isset($_SESSION['id'])){
        header("location: login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form-div">

                <?php if(isset($_SESSION['message'])):?>
                    <div class="alert <?php echo $_SESSION['alert-class']; ?>">
                        <?php
                             echo $_SESSION['message']; 
                             unset($_SESSION['message']); // to make the message a flash one.
                             unset($_SESSION['alert-class']);
                        ?> 
                    </div>
                <?php endif; ?>
                
                <!-- Pending: Allen will be replaced with usernane from php. -->
                <h3>Welcome, <?php echo $_SESSION['username']; ?>!</h3>

                <a href="index.php?logout=1" class = "logout">logout</a>

                <!-- Pending: Below should only be displayed when user is not verified. -->
                <?php if(!$_SESSION['verified']): ?>
                    <div class="alert alert-warning">
                        You need to verify your account.<br>The verification link will be sent to 
                        <strong><?php echo $_SESSION['email']; ?></strong>
                    </div>
                <?php endif; ?>

                <!-- <?php if($_SESSION['verified']): ?>
                    <button class="btn btn-block btn-lg btn-primary">I am verified</button>
                <?php endif; ?>  -->
            </div>  
        </div>
    </div>
</body>
</html>