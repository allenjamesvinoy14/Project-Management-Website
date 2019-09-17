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
    <link rel="stylesheet" href="style.css">
    <title>ProJ</title>
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
                    <a class="nav-link" href="../main/addproject.php">Add Project</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    </div>
    <div class="main">
        <?php
            for($i=0;$i<$_SESSION['projcount'];$i++){
                echo '<div class="col-md-8 offset-md-2 h-100 row justify-content-center projitems mt-5 mb-5">';
                    echo '<table>';
                        echo '<tr>';
                            echo '<td>Project ID:</td> <td>'.$_SESSION['projid'][$i].'</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td>Project Name:</td> <td>'.$_SESSION['projname'][$i].'</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td>Project Description:</td> <td>'.$_SESSION['projdesc'][$i].'</td>';
                        echo '</tr>';    
                    echo '</table>';
                echo '</div>';
            }
        ?>
    </div>
</body>
</html>