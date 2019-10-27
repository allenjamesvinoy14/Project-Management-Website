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
        $(function(){
            $(".requestbtn").on('click',function(){
                str = this.id;
                window.location = "../main/reviewrequests.php?id="+str+"&review=1";
            });
        });
        
        $(function(){
            $(".projitems").on('click',function(){
                window.location = "../main/test.php";
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
            <a class="nav-link" href="../main/addproject.php">Add Project</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
        </li>
    <?php require_once '../UI/navbar/navbar-footer.php'; ?>

    <?php for($i=0;$i<$_SESSION['myprojcount'];$i++): ?>
    <?php if($_SESSION['accepted'][$i] == 1 and $_SESSION['userid'][$i]==$_SESSION['id']): ?>
    <div class="main">
            <div onmouseover="changecolor(this)" onmouseout="colortodefault(this)" class="col-md-8 offset-md-2 justify-content-center projitems">
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
    <?php require_once '../UI/Main Elements/footer.php'; ?>
</body>
</html>
