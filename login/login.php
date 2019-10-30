<?php require_once 'controller/authController.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/2462b6baab.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Login</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../main/stylemain.css">
</head>
<body>
    <div class="header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="../main/index.php">ProJ</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form-div login">
                <form action="login.php" method="post">
                    <h3 class="text-center">Login</h3>

                    <?php if(count($errors)>0): ?>
                        <div class="alert alert-danger">
                            <?php foreach($errors as $error): ?>
                                <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="form-group">
                        <label for="username">Username/Email</label>
                        <input type="text" name="username" value = "<?php echo $username; ?>" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control form-control-lg">
                    </div>
    
                    <div class="form-group">
                        <button type="submit" style="background-color: #0063B2FF !important;" name="login-btn" class="btn btn-primary btn-block btn-lg">
                            Login
                        </button>
                    </div>
                    <p class="text-center">Not yet a member? <a style="color: #0063B2FF !important;" href="signup.php">Sign Up </a></p>
                </form>
            </div>
        </div>
    </div>
    <?php require_once '../UI/Main Elements/footer.php'; ?>
</body>
</html>