<?php
    require '../config/db.php'; 
    require '../login/controller/authController.php';
    require_once '../classes/Project.php';
    require_once '../classes/User.php';
    require_once '../classes/Skill.php';

    $emailQuery = "SELECT * FROM projects";

    $result = $conn->query($emailQuery); 
    $count = $result->num_rows;

    $_SESSION['projcount'] = $count;
    
    $_SESSION['projects'] = array(); //session variable that maintains all the projects in the website.


    //The below foreach is to fetch project details from the database and store it in an array of project objects.
    foreach($result as $res){
        $project = new Project($res['proj_name'],$res['proj_desc'],$res['projlead_id']);
        $project->setProjectId($res['proj_id']);

        $getskillsquery = "SELECT skillid,skillname FROM skills AS s INNER JOIN projectskills ON s.id=skillid WHERE projectid=?";
        $skillparams = array($project->getProjectId());
        $resultskills = $conn->query($getskillsquery,$skillparams);

        foreach($resultskills as $rskill){
            $skill = new Skill($rskill['skillid'],$rskill['skillname']);
            $project->addSkill($skill);
        }

        array_push($_SESSION['projects'],$project);
    }


    //if new project is added
    if(isset($_POST['addproject-btn'])){
        $user = $_SESSION['cur-user'];
        $newproject = new Project($_POST['projname'],$_POST['projdesc'],$user->getUserId()); 

        //adding project to the database.
        $insertquery = "INSERT INTO projects (PROJ_NAME,PROJ_DESC,PROJLEAD_ID) VALUES(?,?,?)";
        $addprojectparams = array($newproject->getProjectName(),$newproject->getProjectDesc(),$newproject->getProjectLeadDetails());

        $insertresult = $conn->query($insertquery,$addprojectparams);


        $get_lastid_query = "SELECT LAST_INSERT_ID()";
        $result = $conn->query($get_lastid_query);

        $result = $result->fetch_assoc();
        $newproject->setProjectId($result['LAST_INSERT_ID()']);

        if(!$insertresult){
            $_SESSION['insert-proj-error']="Database error: Failed to complete transaction: create new project";
            header('location:../main/addproject.php');
            exit();
        }


        // adding skills data to the projectskills table. A seperate table is maintained to ensure 3NF.

        $skills = $_POST['skillset'];
        $str_arr=explode(",", $skills);
        
        $projectskill_insert_query = "INSERT INTO projectskills (PROJECTID,SKILLID) VALUES(?,?)";
        $get_skillid_query = "SELECT id FROM skills WHERE skillname=?";

        for($i=0;$i<count($str_arr)-1;$i++){

            $skillname = trim($str_arr[$i]);

            if($skillname!==''||$skillname!==' '){
                $tparams = array($skillname);  
        
                $result = $conn->query($get_skillid_query,$tparams); 
                $skill = $result->fetch_assoc();

                $newskill = new Skill($skill['id'],$skillname);

                $newproject->addSkill($newskill);

                $insertsqlparams = array($newproject->getProjectId(),$newskill->getSkillId());

                $insertsql = $conn->query($projectskill_insert_query,$insertsqlparams);
            }
        }
        header('location:../main/index.php');
        exit();
    }

    if(isset($_GET['myprojects'])){
        $get_my_project_query = "SELECT * FROM projectmembers INNER JOIN projects USING(proj_id) WHERE accepted = 1 AND user_id=?";
        $get_project_params = array($_SESSION['cur-user']->getUserId());

        $resultmyproj = $conn->query($get_my_project_query,$get_project_params);

        if(!empty($resultmyproj)){

            $count = $resultmyproj->num_rows;

            $_SESSION['myprojcount'] = $count;
            // $_SESSION['myprojects'] = array();

            // $_SESSION['myprojid'] = array();
            // $_SESSION['proj_id'] = array();
            // $_SESSION['userid'] = array();
            // $_SESSION['accepted'] = array();
            // $_SESSION['proj_name'] = array();
            // $_SESSION['proj_desc'] = array();
            // $_SESSION['projlead_id'] = array();

            foreach($resultmyproj as $resmp){
                $proj = new Project($resmp['proj_name'],$resmp['proj_desc'],$resmp['projlead_id']);
                $proj->setAcceptanceStatus($resmp['accepted']);
                $proj->setProjectId($resmp['id']);

                $_SESSION['cur-user']->addProject($proj);
                // array_push($_SESSION['myprojid'],$resmp['id']);
                // array_push($_SESSION['proj_id'],$resmp['proj_id']);
                // array_push($_SESSION['userid'],$resmp['user_id']);
                // array_push($_SESSION['accepted'],$resmp['accepted']);
                // array_push($_SESSION['proj_name'],$resmp['proj_name']);
                // array_push($_SESSION['proj_desc'],$resmp['proj_desc']);
                // array_push($_SESSION['projlead_id'],$resmp['projlead_id']);
            }
        }
    }
?>