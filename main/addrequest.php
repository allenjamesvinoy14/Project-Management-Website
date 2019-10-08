<?php
    require '../config/db.php';
    require '../login/controller/authController.php';

    $proj_id = $_GET['id'];
    $bit = 0;
    $insertquery = "INSERT INTO projectmembers (PROJ_ID,USER_ID,ACCEPTED) VALUES(?,?,?)";
    $stmt = $conn->prepare($insertquery);
    $stmt->bind_param('iii',$proj_id,$_SESSION['id'],$bit);
    if($stmt->execute())
    {
        echo "Request Success";
    }
    else{
        echo "Request couldn't be processed. Try again!";
    }
    $stmt->close();
?>