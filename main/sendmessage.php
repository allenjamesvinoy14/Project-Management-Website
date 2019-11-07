<?php require_once 'maincontroller/projectController.php';
    $_SESSION['message-id-cur'] = $_GET['sendid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/2462b6baab.js" crossorigin="anonymous"></script>
    <title>Register</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="stylemain.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script>
        $(function(){
            $(".sendbtn").on('click',function(){
                $.ajax({
                    type : 'GET',
                    url : '../main/message.php',
                    dataType : 'html',
                    data: {
                        message: "send"
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
            <a class="nav-link" href="../main/myprojects.php?myprojects=1">My Projects</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
        </li>
    <?php require_once '../UI/navbar/navbar-footer.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 form-div">
                <h3 class="text-center">SEND MESSAGE</h3>
                <div class="form-group">
                    <label for="projdesc">Message: </label>
                    <textarea name="projdesc" class="form-control form-control-lg" rows="8"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block btn-lg sendbtn">
                        SEND MESSAGE
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php require_once '../UI/Main Elements/footer.php'; ?>
</body>
</html>