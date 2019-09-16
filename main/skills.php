<?php
    require '../config/db.php'; 

    $st = $_GET['term'];  
    
    //get matched data from skills table
    $Query = 'SELECT * FROM skills WHERE skillname LIKE "%'.$st.'%" ORDER BY skillname ASC';

    $stmt = $conn->prepare($Query);
    $stmt->execute(); 
    $result = $stmt->get_result(); 

    while ($row = $result->fetch_assoc()) {
        $data[] = $row['skillname'];
    }
    
    //return json data
    echo json_encode($data);
?>