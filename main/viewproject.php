<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="projectstyle.css">
    <script src="https://kit.fontawesome.com/2462b6baab.js" crossorigin="anonymous"></script>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <title>ProJ</title>
    <style>
    /* width */
    ::-webkit-scrollbar {
    width: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
    background: #f1f1f1; 
    }
    
    /* Handle */
    ::-webkit-scrollbar-thumb {
    background: #888; 
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
    background: #555; 
    }
    </style>
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

    <div class="container-fluid">
        <div class="page-header pt-4 pl-3">
            <h1>Project Title</h1>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row pt-4">
            <div class="col-md-8">
                <div class="jumbotron desc" style = "height: 450px">
                    <h2 class="mb-3">Project Description</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, fugit. In tempore atque error! Consequuntur sint, neque recusandae ad enim officia. Omnis fugit officiis nam dolorem sapiente iste laudantium eveniet.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="jumbotron" style = "height:330px;">
                <h4 class="mb-3">Project Members</h4>
                    <div class="container member-list" style = " height:100%; overflow-y:scroll;">
                        <div class="member">
                            <i class="fas fa-user"></i>
                            <p class="username"> Allen James </p>
                        </div>
                        <div class="member">
                            <i class="fas fa-user"></i>
                            <p class="username"> Allen James </p>
                        </div>
                        <div class="member">
                            <i class="fas fa-user"></i>
                            <p class="username"> Allen James </p>
                        </div>  
                    </div>
                </div>
                <button class="btn btn-primary btn-lg">Send Message</button>
            </div>
        </div>
    </div>
    <?php require_once '../UI/Main Elements/footer.php'; ?>
</body>
</html>