<?php
    require '../config/db.php';
    require '../login/controller/authController.php';

    $all_projects_fetch_query = "SELECT * FROM projects";
    $stmt = $conn->prepare($all_projects_fetch_query);
    $stmt->execute(); 

    $result = $stmt->get_result();  
    $stmt->close();

    $count = $result->num_rows;
    $_SESSION['projcount'] = $count;

    $_SESSION['projid'] = array();
    $_SESSION['projname'] = array();
    $_SESSION['projdesc'] = array();
    $_SESSION['display-request'] = array();

    foreach($result as $res){
        array_push($_SESSION['projid'],$res['proj_id']);
        array_push($_SESSION['projname'],$res['proj_name']);
        array_push($_SESSION['projdesc'],$res['proj_desc']);
    }

    for($i=0;$i<$count;$i++){
        $cur = $_SESSION['projid'][$i];

        $check_member_of_project_query = "SELECT * FROM projects INNER JOIN projectmembers USING(proj_id) WHERE proj_id=? AND user_id=?";
        $stmt = $conn->prepare($check_member_of_project_query);
        $stmt->bind_param('ii',$cur,$_SESSION['id']);
        $stmt->execute();

        $list = $stmt->get_result();
        $stmt->close();

        $temp = 0;
        if($list->num_rows==1)
        {
            $temp=1;
        }

        array_push($_SESSION['display-request'],$temp);
    }

    $get_skills_query = "SELECT skillname FROM projectskills as ps INNER JOIN skills as s ON ps.skillid = s.id WHERE projectid = ?";

    for($i=0;$i<$count;$i++){
        $cur = $_SESSION['projid'][$i];
        $key = $cur."skills";

        $_SESSION[$key] = array();
        
        $stmt = $conn->prepare($get_skills_query);
        $stmt->bind_param('i',$cur);
        $stmt->execute();

        $list = $stmt->get_result();
        $stmt->close();

        foreach($list as $item){
            array_push($_SESSION[$key],$item['skillname']);
        }
    }

    if(isset($_POST['addproject-btn'])){
        $projectname = $_POST['projname'];
        $projectdesc = $_POST['projdesc'];

        //1. Adding project into projects table
        $insertquery = "INSERT INTO projects (PROJ_NAME,PROJ_DESC,PROJLEAD_ID) VALUES(?,?,?)";
        $stmt = $conn->prepare($insertquery);
        $stmt->bind_param('ssi',$projectname,$projectdesc,$_SESSION['id']);
        $stmt->execute();
        $stmt->close();

        $get_lastid_query = "SELECT LAST_INSERT_ID()";
        $stmt = $conn->prepare($get_lastid_query);
        //$stmt->execute();

        if(!$stmt->execute()){
            $_SESSION['insert-proj-error']="Database error: Failed to complete transaction: create new project";
            header('location:../main/addproject.php');
            exit();
        }

        $result = $stmt->get_result();
        $stmt->close();
        //1. ends 

        $result = $result->fetch_assoc();
        $projid = $result['LAST_INSERT_ID()'];

        //2. Adding the project head as a project member of the project by default
        $insert_into_project_members_query = "INSERT INTO projectmembers (PROJ_ID,USER_ID,ACCEPTED) VALUES(?,?,?)";
        $bit = 1;
        $stmt = $conn->prepare($insert_into_project_members_query);
        $stmt->bind_param('iii',$projid,$_SESSION['id'],$bit);
        $stmt->execute();
        $stmt->close();
        //2. ends


        //3. Adding skills required for the project into a seperate table to maintain normalisation.

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
        //3. ends


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
    if(isset($_GET['myprojects'])){
        $get_my_project_query = "SELECT * FROM projectmembers INNER JOIN projects USING(proj_id) WHERE accepted = 1 AND user_id=?";

        $stmt = $conn->prepare($get_my_project_query);
        $stmt->bind_param('i',$_SESSION['id']);
        
        if($stmt->execute()){
            $resultmyproj = $stmt->get_result();

            $count = $resultmyproj->num_rows;
            $_SESSION['myprojcount'] = $count;

            //CHANGE THIS TO THE SCHEMA OF THE JOIN RESULT

            $_SESSION['myprojid'] = array();
            $_SESSION['proj_id'] = array();
            $_SESSION['userid'] = array();
            $_SESSION['accepted'] = array();
            $_SESSION['proj_name'] = array();
            $_SESSION['proj_desc'] = array();
            $_SESSION['projlead_id'] = array();


            foreach($resultmyproj as $resmp){
                array_push($_SESSION['myprojid'],$resmp['id']);
                array_push($_SESSION['proj_id'],$resmp['proj_id']);
                array_push($_SESSION['userid'],$resmp['user_id']);
                array_push($_SESSION['accepted'],$resmp['accepted']);
                array_push($_SESSION['proj_name'],$resmp['proj_name']);
                array_push($_SESSION['proj_desc'],$resmp['proj_desc']);
                array_push($_SESSION['projlead_id'],$resmp['projlead_id']);
            }
        }
        $stmt->close();
    }

    if(isset($_GET['review'])){
        $projectid = $_GET['id'];
        $_SESSION['requests-projid'] = $projectid;
        
        $get_requests_query = "SELECT user_id,username,email FROM projectmembers INNER JOIN users as u ON user_id = u.id WHERE accepted = 0 AND proj_id=?";

        $stmt = $conn->prepare($get_requests_query);
        $stmt->bind_param('i',$projectid);

        if($stmt->execute()){
            $resultrequests = $stmt->get_result();

            $count = $resultrequests->num_rows;
            $_SESSION['requestcount'] = $count;

            //CHANGE THIS TO THE SCHEMA OF THE JOIN RESULT

            $_SESSION['requests-user_id'] = array();
            $_SESSION['requests-username'] = array();
            $_SESSION['requests-email'] = array();


            foreach($resultrequests as $resmp){
                array_push($_SESSION['requests-user_id'],$resmp['user_id']);
                array_push($_SESSION['requests-username'],$resmp['username']);
                array_push($_SESSION['requests-email'],$resmp['email']);
            }
        }
        $stmt->close();
    }

    if(isset($_GET['projid'])){
        $id = $_GET['projid'];

        $idx = -1;
        for($i=0;$i<$count;$i++){
            if($_SESSION['projid'][$i] == $id){
                $idx = $i;    
            }
        }

        $_SESSION['display-project-name'] = $_SESSION['projname'][$idx];
        $_SESSION['display-project-desc'] = $_SESSION['projdesc'][$idx];
        $_SESSION['display-project-id'] = $id;

        $find_users_query = "SELECT username FROM projectmembers as pm INNER JOIN users as u ON pm.user_id = u.id WHERE pm.proj_id = ? AND accepted = 1";
        $stmt = $conn->prepare($find_users_query);
        $stmt->bind_param('i',$id);
        $stmt->execute();

        $usernames = $stmt->get_result();
        $membercount = $usernames->num_rows;

        $stmt->close();
        
        $_SESSION['usernames'] = array();
        $_SESSION['membercount'] = $membercount;

        foreach($usernames as $u){
            array_push($_SESSION['usernames'],$u['username']);
        }
    }
?>