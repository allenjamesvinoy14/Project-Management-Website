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
                $.ajax({
                    type : 'GET',
                    url : '../main/acceptrequest.php',
                    dataType : 'html',
                    data: {
                        id : str
                    },
                    success : function(data){                                               
                        alert(data);
                    }   
                });
            });
        });
    </script>
</head>
<body>

    <?php require_once '../UI/navbar/navbar-header.php'; ?>
        <li class="nav-item">
            <a class="nav-link" href="../main/myprojects.php">My Projects</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
        </li>
    <?php require_once '../UI/navbar/navbar-footer.php'; ?>

    <div class="containter">
        <div class="row">
            <div class="col center-block heading">
                <h3> Requests! </h3>
            </div>
        </div>
    </div>

    <?php for($i=0;$i<$_SESSION['requestcount'];$i++): ?>
    <div class="main">
            <div class="col-md-8 offset-md-2 justify-content-center projitems">
                <div class="row col-md-8 offset-md-3 col1 center-block">
                    <table>
                        <tr>
                            <td>User Name:</td> <td><?php echo $_SESSION['requests-username'][$i]; ?></td>
                        </tr>
                        <tr>
                            <td>Email:</td> <td><?php echo $_SESSION['requests-email'][$i]; ?></td>
                        </tr>  
                        <tr>
                            <td>Message:</td> <td> I believe I am a right fit for this project! </td>
                        </tr>
                    </table>
                </div>
                <br>
                <div class="row col-md-4 offset-md-8 col1 center-block">
                    <button type="submit" id=<?php echo $_SESSION['requests-user_id'][$i]?> class="requestbtn btn btn-primary btn-block btn-lg">
                        ACCEPT
                    </button> 
                    <button type="submit" id=<?php echo $_SESSION['requests-user_id'][$i]?> class="requestbtn btn btn-primary btn-block btn-lg">
                        REJECT
                    </button>
                </div>
            </div>
    </div>
    <?php endfor; ?>
</body>
</html>
