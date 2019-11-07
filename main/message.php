<?php
    require '../config/db.php';
    require '../login/controller/authController.php';

    $sendmessagequery = "INSERT INTO messages VALUES(?,?)";

    for($i=0;$i<$_SESSION['membercount'];$i++){
        if($_SESSION['memberids']!=$_SESSION['id']){
            $stmt = $conn->prepare($sendmessagequery);
            $stmt->bind_param('ii',$_SESSION['memberids'],$_SESSION['id']);
            $stmt->execute();
            $stmt->close();
        }
    }
?>