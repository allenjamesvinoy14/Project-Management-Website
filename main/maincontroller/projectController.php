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

    if(isset($_POST['addproject-btn'])){
        $projectname = $_POST['projname'];
        $projectdesc = $_POST['projdesc'];
        
        // $_SESSION['globalskills'] = $skills;
        // header('location:../main/new.php');

        $insertquery = "INSERT INTO projects (PROJ_NAME,PROJ_DESC,PROJLEAD_ID) VALUES(?,?,?)";
        $stmt = $conn->prepare($insertquery);
        $stmt->bind_param('ssi',$projectname,$projectdesc,$_SESSION['id']);
        $stmt->execute();
        $stmt->close();

        $get_lastid_query = "SELECT LAST_INSERT_ID()";
        $stmt = $conn->prepare($get_lastid_query);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_assoc();
        $projid = $result['LAST_INSERT_ID()'];
        // $_SESSION['pid'] = $result;
        // header('location:../main/new.php');
        // exit();
        if(!$stmt->execute()){
            $_SESSION['insert-proj-error']="Database error: Failed to complete transaction: create new project";
            header('location:../main/addproject.php');
            exit();
        }
        $stmt->close();

        $skills = $_POST['skillset'];
        $str_arr=explode(",", $skills);
        
        $projectskill_insert_query = "INSERT INTO projectskills (PROJECTID,SKILLID) VALUES(?,?)";
        $get_skillid_query = "SELECT id FROM skills WHERE skillname=?";

        for($i=0;$i<count($str_arr)-1;$i++){

            $temp = trim($str_arr[$i]);

            if($temp!==''||$temp!==' '){
                $stmt = $conn->prepare($get_skillid_query);

                $stmt->bind_param('s',$temp);
                $stmt->execute();   
        
                $result = $stmt->get_result(); 

                $skill = $result->fetch_assoc();
                $skillid = $skill['id'];

                $insertsql = $conn->prepare($projectskill_insert_query);
                $insertsql->bind_param('ii',$projid,$skillid);
                $insertsql->execute();
                
                $stmt->close();
                $insertsql->close();
            }
        }
        header('location:../main/index.php');
        exit();
    }
    // if(isset($_GET['requestid'])){
    //     $proj_id = $_GET['requestid'];
    //     $bit = 0;
    //     $insertquery = "INSERT INTO projectmembers (PROJ_ID,USER_ID,ACCEPTED) VALUES(?,?,?)";
    //     $stmt = $conn->prepare($insertquery);
    //     $stmt->bind_param('iii',$proj_id,$_SESSION['id'],$bit);
    //     if($stmt->execute())
    //     {
    //         echo "Request Success";
    //     }
    //     else{
    //         echo "Request couldn't be processed. Try again!";
    //     }
    //     $stmt->close();
    // }
?>