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
    <div class="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="../main/index.php">ProJ</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="mr-auto"></div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../main/myprojects.php">My Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../main/addproject.php">Add Project</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <?php for($i=0;$i<$_SESSION['myprojcount'];$i++): ?>
    <?php if($_SESSION['accepted'][$i] == 1 and $_SESSION['userid'][$i]==$_SESSION['id']): ?>
    <div class="main">
            <div class="col-md-8 offset-md-2 justify-content-center projitems">
                <div class="row col-md-8 offset-md-3 col1 center-block">
                    <table>
                        <tr>
                            <td>Project Name:</td> <td><?php echo $_SESSION['proj_name'][$i]; ?></td>
                        </tr>
                        <tr>
                            <td>Project Description:</td> <td><?php echo $_SESSION['proj_desc'][$i]; ?></td>
                        </tr>  
                    </table>
                </div>
                <br>
                <?php if($_SESSION['projlead_id'][$i] === $_SESSION['id']): ?>
                <div class="row col-md-4 offset-md-8 col1 center-block">
                    <button type="submit" id=<?php echo $_SESSION['proj_id'][$i]?> class="requestbtn btn btn-primary btn-block btn-lg">
                        REVIEW REQUESTS
                    </button> 
                </div>
                <?php endif; ?>
            </div>
    </div>
    <?php endif; ?>
    <?php endfor; ?>
</body>
</html>