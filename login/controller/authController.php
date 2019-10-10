<?php

    // to use sessions we need to start a session at the top of the page.
    if (session_status() == PHP_SESSION_NONE) {
        session_start(); 
    }
    else {
        header("location: ../index.php"); 
    }

    require_once '../config/db.php';

    $conn = new DatabaseConnection();

    //require_once 'emailController.php'

    $errors = array();
    $username = "";
    $email = "";

    //if user clicks on the sign up button

    require_once '../classes/User.php';
    
    if(isset($_POST['signup-btn'])){
        // $username = $_POST['username'];
        // $email = $_POST['email'];
        // $password = $_POST['password'];

        $passwordc = $_POST['passwordc'];
        $token = bin2hex(random_bytes(50)); //string of size 100
        $verified = false;

        $newuser = new User($_POST['username'],$_POST['email'],$_POST['password'],$token,$verified);

        // server side validation

        if(empty($newuser->getUsername()))
        {
            $errors['username'] = "Username required";
        }
        if(!filter_var($newuser->getEmail(),FILTER_VALIDATE_EMAIL))
        {
            $errors['email'] = "Email address invalid!";
        }
        if(empty($newuser->getEmail()))
        {
            $errors['email'] = "Email required";
        }
        if(empty($newuser->getPassword()))
        {
            $errors['password'] = "Password required";
        }

        if($password !== $passwordc)
        {
            $errors['password'] = "Two passwords doesn't match!";
        }

        // No other user has the same email!

        $emailQuery = "SELECT * FROM users WHERE email = ? LIMIT 1";
        $params = array($newuser->getEmail());
    
        $result = $conn->query($emailQuery,$params); 
        $userCount = $result->num_rows;

        if($userCount === 1)
        {
            $errors['email'] = "Email already exists!";
        }

        if(count($errors) === 0) //count gives the number of elements in the array
        {
            // some tasks before saving the user     
            // 1. hashing the password
            // 2. generating token    

            // $password = password_hash($password,PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (USERNAME,EMAIL,VERIFIED,TOKEN,PASSWORD) VALUES(?,?,?,?,?)";
            $paramsinsert = array($newuser->getUsername(),$newuser->getEmail(),$newuser->getVerificationStatus(),$newuser->getToken(),$newuser->getPassword());
            
            // $stmt = $conn->prepare($sql);
            // $stmt->bind_param('ssbss',$username,$email,$verified,$token,$password);

            $resultnew = $conn->query($sql,$paramsinsert);
            if(!empty($resultnew)){
                // login user => putting some values inside a session; session variables are accessible across pages.

                // $user_id = $conn->insert_id;
                // $_SESSION['id'] = $user_id;
                header('location: ../login/login.php');
                exit();
            } else{
                $errors['db_error'] = "Database error: Failed to complete transaction: register user";
            }
        }
    }

    //if user clicks on the login button
    if(isset($_POST['login-btn'])){
        $usernameemail = $_POST['username'];
        $password = $_POST['password'];

        // server side validation

        if(empty($usernameemail))
        {
            $errors['username'] = "Username/Email required";
        }
        if(empty($password))
        {
            $errors['password'] = "Password required";
        }

        if(count($errors)===0){
            $sql = "SELECT * FROM users WHERE email=? OR username = ? LIMIT 1";

            $paramsselect = array($usernameemail,$usernameemail);

            $result = $conn->query($sql,$paramsselect);

            $user = $result->fetch_assoc();

            if($password===$user['password']){
                //login successful 

                $loginuser = new User($user['username'],$user['email'],$user['password'],$user['token'],$user['verified']);
                $loginuser->setUserId($user['id']);

                //current user object is saved in the session.
                $_SESSION['cur-user'] = $loginuser;

                //set flash message
                $_SESSION['message'] = "You are now logged in!";
                $_SESSION['alert-class'] = "alert-success"; 
                header('location: ../main/index.php');
                exit();
            }
            else{
                $errors['login-fail'] = "Wrong credentials!";
            }
        }
    }    

    //logout user

    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['verified']);
        header('location: login.php');
        exit();
    }
 
    // function verifyUser($token){
    //     global $conn; 
    //     $sql = "SELECT * FROM users WHERE token = '$token' LIMIT 1";
    //     $result = mysqli_query($conn,$sql);

    //     if($result->num_rows>0){
    //         $user = $result->fetch_assoc();
    //         $update_query = "UPDATE users SET verified = 1 WHERE token = '$token'";

    //         if(mysqli_query($conn,$update_query)){
    //             // log user in
    //             $_SESSION['verified'] = $user['verified'];
    //             $_SESSION['message'] = "Your email was succesfully verified";
    //             header('location: index.php');
    //             exit();
    //         }else{
    //             echo 'User not found';  
    //         }
    //     }
    // }
?>