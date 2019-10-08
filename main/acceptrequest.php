<?php
    require 'maincontroller/projectController.php';

    $user_id = $_GET['id'];

    $proj_id = $_SESSION['requests-projid'];

    $update_query = "UPDATE projectmembers SET accepted=1 WHERE proj_id=? AND user_id=?";

    $stmt = $conn->prepare($update_query);

    $stmt->bind_param('ii',$proj_id,$user_id);

    if($stmt->execute()){
        echo "Success";
    }
    else{
        echo "Failure";
    }

    $stmt->close();
?>