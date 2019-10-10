<?php
    require '../config/db.php'; 
    require '../login/controller/authController.php';

    $emailQuery = "SELECT * FROM projects";
    // $stmt = $conn->prepare($emailQuery);
    // $stmt->execute(); 

    $result = $conn->query($emailQuery); 
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

    if(isset($_POST['addproject-btn'])){
        $projectname = $_POST['projname'];
        $projectdesc = $_POST['projdesc'];
        
        // $_SESSION['globalskills'] = $skills;
        // header('location:../main/new.php');

        $insertquery = "INSERT INTO projects (PROJ_NAME,PROJ_DESC,PROJLEAD_ID) VALUES(?,?,?)";
        $addprojectparams = array($projectname,$projectdesc,$_SESSION['id']);

        $insertresult = $conn->query($insertquery,$addprojectparams);


        $get_lastid_query = "SELECT LAST_INSERT_ID()";
        $result = $conn->query($get_lastid_query);

        $result = $result->fetch_assoc();
        $projid = $result['LAST_INSERT_ID()'];
        // $_SESSION['pid'] = $result;
        // header('location:../main/new.php');
        // exit();


        if(!$insertresult){
            $_SESSION['insert-proj-error']="Database error: Failed to complete transaction: create new project";
            header('location:../main/addproject.php');
            exit();
        }

        $skills = $_POST['skillset'];
        $str_arr=explode(",", $skills);
        
        $projectskill_insert_query = "INSERT INTO projectskills (PROJECTID,SKILLID) VALUES(?,?)";
        $get_skillid_query = "SELECT id FROM skills WHERE skillname=?";

        for($i=0;$i<count($str_arr)-1;$i++){

            $temp = trim($str_arr[$i]);

            if($temp!==''||$temp!==' '){
                $tparams = array($temp);  
        
                $result = $conn->query($get_skillid_query,$tparams); 

                $skill = $result->fetch_assoc();
                $skillid = $skill['id'];

                $insertsqlparams = array($projid,$skillid);

                $insertsql = $conn->query($projectskill_insert_query,$insertsqlparams);
            }
        }
        header('location:../main/index.php');
        exit();
    }
?>