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
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <title>ProJ</title>

    <script>
    </script>
</head>
<body>

    <?php require '../UI/navbar/navbarheader.php'; ?>
        <li class="nav-item">
            <a class="nav-link" href="../main/myprojects.php">My Projects</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../main/addproject.php">Add Project</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
        </li>
    <?php require '../UI/navbar/navbarfooter.php'; ?>

    <?php 

        $user = unserialize($_SESSION['cur-user']);

        $projects = $user->getProjects();

        foreach($projects as $project):
            $acceptance_status = $project->getAcceptanceStatus();

            if($acceptance_status == 1): 
    ?>
    <div class="main">
            <div class="col-md-8 offset-md-2 justify-content-center projitems">
                <div class="row col-md-8 offset-md-3 col1 center-block">
                    <table>
                        <tr>
                            <td>Project Name:</td> <td><?php echo $project->getProjectName(); ?></td>
                        </tr>
                        <tr>
                            <td>Project Description:</td> <td><?php echo $project->getProjectDesc(); ?></td>
                        </tr>  
                    </table>
                </div>
                <br>
                <?php 
                    $curuser = unserialize($_SESSION['cur-user']);
                    if($project->getProjectLeadDetails() === $curuser->getUserId()): 
                ?>
                    <div class="row col-md-4 offset-md-8 col1 center-block">
                        <button type="submit" id=<?php echo $project->getProjectId(); ?> class="requestbtn btn btn-primary btn-block btn-lg">
                            REVIEW REQUESTS
                        </button> 
                    </div>

                <?php endif; ?>
            </div>
    </div>
    <?php endif; ?>
    <?php endforeach; ?>
</body>
</html>