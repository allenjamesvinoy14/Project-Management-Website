<?php
    require 'maincontroller/projectController.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="stylemain.css">
    <link rel="stylesheet" href="../style.css">
    <title>ProJ</title>

    <script>
        $(function(){
            $(".requestbtn").on('click',function(){
                window.location.replace('../main/test.php');
            });
        });
    </script>
</head>
<body>

    <?php require '../UI/navbar/navbarheader.php'; ?>
        <li class="nav-item">
            <a class="nav-link" href="../main/myprojects.php?myprojects=1">My Projects</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../main/addproject.php">Add Project</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
        </li>
    <?php require '../UI/navbar/navbarfooter.php'; ?>

    <?php for($i=0;$i<$_SESSION['projcount'];$i++): ?>
    <div class="main">
            <div class="col-md-8 offset-md-2 justify-content-center projitems">
                <div class="row col-md-8 offset-md-3 col1 center-block">
                    <table>
                        <tr>
                            <td>Project Name:</td> <td><?php echo $_SESSION['projects'][$i]->getProjectName(); ?></td>
                        </tr>
                        <tr>
                            <td>Project Description:</td> <td><?php echo $_SESSION['projects'][$i]->getProjectDesc(); ?></td>
                        </tr> 
                        <tr>
                            <td>Skills: </td> 
                            <td>
                                <?php
                                    $c = 0;
                                    $skills = $_SESSION['projects'][$i]->getSkills();
                                    foreach($skills as $s)
                                    {
                                        echo $s->getSkillName();
                                        $c++;
                                        if($c!=count($skills))
                                            echo ",";
                                    }
                                ?> 
                            </td>
                        </tr>  
                    </table>
                </div>
                <br>
                <div class="row col-md-4 offset-md-8 col1 center-block">
                    <button type="submit" name=
                        <?php 
                            $proj = unserialize($_SESSION['projects'][$i]);
                            echo proj->getProjectId();
                        ?> 
                        class="requestbtn btn btn-primary btn-block btn-lg">
                            REQUEST TO JOIN
                    </button> 
                </div>
            </div>
    </div>
    <?php endfor; ?>
</body>
</html>