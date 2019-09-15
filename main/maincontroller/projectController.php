<?php
    require '../config/db.php'; 
    require '../login/controller/authController.php';

    $emailQuery = "SELECT * FROM projects";
    $stmt = $conn->prepare($emailQuery);
    $stmt->execute(); 

    $result = $stmt->get_result();  
    $count = $result->num_rows;
    $res = $result->fetch_assoc();
    $_SESSION['projid'] = $res['proj_id'];
    $_SESSION['projname'] = $res['proj_name'];
    $_SESSION['projdesc'] = $res['proj_desc'];
    $_SESSION['projcount'] = $count;
    
    $stmt->close();
?>