<?php require_once 'maincontroller/projectController.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Register</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="stylemain.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script>
        $(function() {
            function split( val ) {
                return val.split( /,\s*/ );
            }
            function extractLast( term ) {
                return split( term ).pop();
            }
            
            $("#skills").bind( "keydown", function( event ) {
                if ( event.keyCode === $.ui.keyCode.TAB &&
                    $( this ).autocomplete( "instance" ).menu.active ) {
                    event.preventDefault();
                }
            })
            .autocomplete({
                minLength: 1,
                source: function( request, response ) {
                    // delegate back to autocomplete, but extract the last term
                    $.getJSON("../main/skills.php", { term : extractLast( request.term )},response);
                },
                focus: function() {
                    // prevent value inserted on focus
                    return false;
                },
                select: function( event, ui ) {
                    var terms = split( this.value );
                    // remove the current input
                    terms.pop();
                    // add the selected item
                    terms.push( ui.item.value );
                    // add placeholder to get the comma-and-space at the end
                    terms.push( "" );
                    this.value = terms.join( ", " );
                    return false;
                }
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
                <?php if(isset($_SESSION['insert-proj-error'])):?>
                    <div class="alert alert-danger">
                        <?php
                            echo $_SESSION['insert-proj-error']; 
                            unset($_SESSION['insert-proj-error']);
                        ?> 
                    </div>
                <?php endif; ?>
                <form action="addproject.php" method="post">
                    <h3 class="text-center">ADD PROJECT</h3>

                    <div class="form-group">
                        <label for="projname">Project Name: </label>
                        <input type="text" name="projname" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="projdesc">Project Description: </label>
                        <textarea name="projdesc" class="form-control form-control-lg"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="skills">Skills: </label>
                        <input id = "skills" name="skillset" size = "50" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="addproject-btn" class="btn btn-primary btn-block btn-lg addbutton">
                            ADD YOUR PROJECT
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php require_once '../UI/Main Elements/footer.php'; ?>
</body>
</html>