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
    <script src="https://kit.fontawesome.com/2462b6baab.js" crossorigin="anonymous"></script>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <title>ProJ</title>

    <script>

        $(function(e){
            $(".request").on('click',function(e){
                window.location = "../main/reviewrequests.php?id=34&review=1";
            });
        });

        function changecolor(t){
            t.style.background = "#87CEEB";
            t.style.transition = "0.5s";
            t.style.cursor = "pointer";
            t.style.color = "#0063B2FF";
        }

        function colortodefault(t){
            t.style.background = "#333D79";
            t.style.color = "white";
        }
    </script>
</head>
<body>
    <?php require_once '../UI/navbar/navbar-header.php'; ?>
        <li class="nav-item">
            <a class="nav-link" href="../main/myprojects.php?myprojects=1">My Projects</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../main/addproject.php">Add Project</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
        </li>
    <?php require_once '../UI/navbar/navbar-footer.php'; ?>

    <div class="containter">
        <div class="row">
            <div class="col center-block nothead">
                <h3> NOTIFICATIONS </h3>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="col-md-8 offset-md-2 justify-content-center projitems acceptance">
            <div class="row col-md-8 offset-md-2 col1 center-block projitem">
                <table>
                    <tr>
                        <td>@rahul has accepted your request to join the Noise Cancellation Project</td>
                    </tr> 
                </table>
            </div>
        </div>
        <br>
        <div class="col-md-8 offset-md-2 justify-content-center projitems rejection">
            <div class="row col-md-8 offset-md-2 col1 center-block projitem">
                <table>
                    <tr>
                        <td>@pritvi has rejected your request to join the Random App Project</td>
                    </tr> 
                </table>
            </div>
        </div>
        <br>    
        <div class="col-md-8 offset-md-2 justify-content-center projitems">
            <div class="row col-md-8 offset-md-2 col1 center-block projitem">
                <table>
                    <tr>
                        <td>@rahul: Noise Cancellation Project</td>
                    </tr> 
                    <tr>
                        <td>The deadline for all assingments is 2/11/2019</td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <div class="col-md-8 offset-md-2 justify-content-center projitems request">
            <div onmouseover="changecolor(this)" onmouseout="colortodefault(this)" class="row col-md-8 offset-md-2 col1 center-block projitem">
                <table>
                    <tr>
                        <td>@rahul: Finance App Project</td>
                    </tr> 
                    <tr>
                        <td>Request: I believe I am a right fit for this project.</td>
                    </tr> 
                </table>
            </div>
        </div>
        <br>
    </div>
    <?php require_once '../UI/Main Elements/footer.php'; ?>
</body>
</html>
