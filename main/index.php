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
    <?php for($i=0;$i<$_SESSION['projcount'];$i++): ?>
    <div class="main">
            <div class="col-md-8 offset-md-2 justify-content-center projitems">
                <div class="row col-md-8 offset-md-3 col1 center-block">
                    <table>
                        <tr>
                            <td>Project Name:</td> <td><?php echo $_SESSION['projname'][$i]; ?></td>
                        </tr>
                        <tr>
                            <td>Project Description:</td> <td><?php echo $_SESSION['projdesc'][$i]; ?></td>
                        </tr>  
                    </table>
                </div>
                <br>
                <div class="row col-md-4 offset-md-8 col1 center-block">
                    <button type="submit" name=<?php echo $_SESSION['projid'][$i]?> class="requestbtn btn btn-primary btn-block btn-lg">
                        REQUEST TO JOIN
                    </button> 
                </div>
            </div>
    </div>
    <?php endfor; ?>
</body>
</html>