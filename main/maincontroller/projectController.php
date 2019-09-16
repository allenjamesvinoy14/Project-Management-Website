<?php
    require '../config/db.php'; 
    require '../login/controller/authController.php';

    $emailQuery = "SELECT * FROM projects";
    $stmt = $conn->prepare($emailQuery);
    $stmt->execute(); 

    $result = $stmt->get_result();  
    $count = $result->num_rows;
    $_SESSION['projcount'] = $count;

    $_SESSION['projid'] = array();
    $_SESSION['projname'] = array();
    $_SESSION['projdesc'] = array();

    foreach($result as $res){
        array_push($_SESSION['projid'],$res['proj_id']);
        array_push($_SESSION['projname'],$res['proj_name']);
        array_push($_SESSION['projdesc'],$res['proj_desc']);
    }
    $stmt->close();
?>