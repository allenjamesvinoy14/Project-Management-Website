<?php
    
    require 'constants.php';

    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);


    $conn = new mysqli($server,$username,$pass,$db);

    if($conn->connect_error){
        die("Database Error: ".$conn->connect_error);
    }
    
?>