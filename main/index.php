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
            $(".requestbtn").on('click',function(){
 
                cv = prompt("Why do you want to join this project?")
                while(cv=="")
                {
                    cv = prompt("Why do you want to join this project?")
                }

                if(cv!=null){
                    str = this.id;
                    $.ajax({
                        type : 'GET',
                        url : '../main/addrequest.php',
                        dataType : 'html',
                        data: {
                            id : str
                        },
                        success : function(data){                                               
                            alert(data);
                        }   
                    });
                }
            });
        });

        $(function(e){
            $(".projitems").on('click',function(e){
                curid = this.id;
                e.stopPropagation();
                window.location = "../main/viewproject.php?projid="+curid;
            });
        });

        function changecolor(t){
            t.style.background = "#89ABE3FF";
            t.style.transition = "0.5s";
            t.style.cursor = "pointer";
            t.style.color = "#333D79FF";
        }

        function colortodefault(t){
            t.style.background = "#0063B2FF";
            t.style.color = "white";
        }


    </script>
</head>
<body>
    <?php require_once '../UI/navbar/navbar-header.php'; ?>
        <li class="nav-item">
            <a class="nav-link" href="../main/notifications.php">Notifications</a>
        </li>
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
            <div class="col center-block heading">
                <h3> Ongoing Projects! </h3>
            </div>
        </div>
    </div>
    <?php for($i=0;$i<$_SESSION['projcount'];$i++): ?>
    <div class="main">
            <div id=<?php echo $_SESSION['projid'][$i]?> onmouseover="changecolor(this)" onmouseout="colortodefault(this)" class="col-md-8 offset-md-2 justify-content-center projitems">
                <div class="row col-md-8 offset-md-2 col1 center-block projitem">
                    <table>
                        <tr>
                            <td>Project Name:</td> <td><?php echo $_SESSION['projname'][$i]; ?></td>
                        </tr>
                        <tr>
                            <td>Project Description:</td> <td class = "description"><?php echo $_SESSION['projdesc'][$i]; ?></td>
                        </tr>  
                    </table>
                </div>
                <div class="skills">
                    <div class="row row col-md-8 offset-md-2 ">
                        <?php 
                            $key = $_SESSION['projid'][$i]."skills";
                            foreach($_SESSION[$key] as $skill): ?>
                                <button class="btn btn-default skillitems"><?php echo $skill; ?></button>
                        <?php endforeach; ?>                                              
                    </div>
                </div>
                <br>
                <?php if($_SESSION['display-request'][$i]==0): ?>
                <div class="row col-md-4 offset-md-8 col1 center-block">
                    <button type="submit" id=<?php echo $_SESSION['projid'][$i]?> class="requestbtn btn btn-primary btn-block btn-lg">
                        REQUEST TO JOIN
                    </button> 
                </div>
                <?php else: ?>
                <div class="row col-md-4 offset-md-8 col1 center-block">
                    <button type="submit" id=<?php echo $_SESSION['projid'][$i]?> class="requestbtn btn btn-primary btn-block btn-lg hide">
                        REQUEST TO JOIN
                    </button> 
                </div>
                <?php endif; ?>
            </div>
    </div>
    <?php endfor; ?>
    <?php require_once '../UI/Main Elements/footer.php'; ?>
</body>
</html>
