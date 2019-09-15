<?php

    // to use sessions we need to start a session at the top of the page.
    session_start();

    require '../config/db.php';
    //require_once 'emailController.php';

    $errors = array();
    $username = "";
    $email = "";

    //if user clicks on the sign up button

    if(isset($_POST['signup-btn'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordc = $_POST['passwordc'];

        // server side validation

        if(empty($username))
        {
            $errors['username'] = "Username required";
        }
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            $errors['email'] = "Email address invalid!";
        }
        if(empty($email))
        {
            $errors['email'] = "Email required";
        }
        if(empty($password))
        {
            $errors['password'] = "Password required";
        }

        if($password !== $passwordc)
        {
            $errors['password'] = "Two passwords doesn't match!";
        }

        // No other user has the same email!

        $emailQuery = "SELECT * FROM users WHERE email = ? LIMIT 1";
        $stmt = $conn->prepare($emailQuery);
        $stmt->bind_param('s',$email);
        $stmt->execute(); 
        $result = $stmt->get_result();  
        $userCount = $result->num_rows;
        $stmt->close();

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
            $token = bin2hex(random_bytes(50)); //string of size 100
            $verified = false;

            $sql = "INSERT INTO users (USERNAME,EMAIL,VERIFIED,TOKEN,PASSWORD) VALUES(?,?,?,?,?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssbss',$username,$email,$verified,$token,$password);
            if($stmt->execute()){
                // login user => putting some values inside a session; session variables are accessible across pages.

                $user_id = $conn->insert_id;
                $_SESSION['id'] = $user_id;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['verified'] = $verified;
                //set flash message

                //sendVerificationEmail($email,$token);

                $_SESSION['message'] = "You are now logged in!";
                $_SESSION['alert-class'] = "alert-success"; 
                header('location: index.php');
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

            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss',$usernameemail,$usernameemail);
            $stmt->execute(); 

            $result = $stmt->get_result();  
            $user = $result->fetch_assoc();

            if($password===$user['password']){
                //login successful 
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['verified'] = $user['verified'];

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
 
    function verifyUser($token){
        global $conn; 
        $sql = "SELECT * FROM users WHERE token = '$token' LIMIT 1";
        $result = mysqli_query($conn,$sql);

        if($result->num_rows>0){
            $user = $result->fetch_assoc();
            $update_query = "UPDATE users SET verified = 1 WHERE token = '$token'";

            if(mysqli_query($conn,$update_query)){
                // log user in
                $_SESSION['verified'] = $user['verified'];
                $_SESSION['message'] = "Your email was succesfully verified";
                header('location: index.php');
                exit();
            }else{
                echo 'User not found';  
            }
        }
    }
?>