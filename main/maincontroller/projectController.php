<?php
    require '../config/db.php'; 
    require '../login/controller/authController.php';
    require_once '../classes/Project.php';
    require_once '../classes/Skill.php';

    $emailQuery = "SELECT * FROM projects";

    $result = $conn->query($emailQuery); 
    $count = $result->num_rows;

    $_SESSION['projcount'] = $count;
    
    $_SESSION['projects'] = array();

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

    if(isset($_POST['addproject-btn'])){

        $newproject = new Project($_POST['projname'],$_POST['projdesc'],$_SESSION['cur-user']->getUserId());

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
?>