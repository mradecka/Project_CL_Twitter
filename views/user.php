<?php
require_once '../control/userControl.php';
require_once '../control/tweetControl.php';


if ($_SESSION['id'] == null) {
    header('Location:../index.php');
}
?>

<!DOCTYPE html>
<html lang="pl-PL">

    <head>
        <meta charset="UTF-8">
        <title>Mój Twitter</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="../css/style.css" rel="stylesheet">
    </head>

    <body>
        <div id="ban">
        </div>
        <nav class='navbar navbar-default'>
            <div class='container'>
                <div class="navbar-header">
                    <ul class="nav nav-tabs">
                         <li role="presentation" class="active"><a href="main.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Strona główna</a></li>
                        <li role="presentation"><a href="user.php?userId=<?php echo $_SESSION['id'] ?>"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Twój profil</a></li>
                        <li role="presentation"><a href="#"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Wiadomości</a></li>
                        <li role="presentation"><a href="settings.php"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Ustawienia</a></li>
                        <li role="presentation"><a href="../index.php?logout"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Wyloguj się</a></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="container">
            <div class='col-xs-12 col-sm-6 col-sm-offset-3'>
                <div class='page-header'>
                    <h3>Strona użytkownika <?php echo hello($conn); ?></h3>

                </div>
                <div class="col-sm-offset-2 col-sm-10">
                </div>

                <div class='panel'>
                    <div class='panel-body'>
                        <div class='panel-body'>

                            <?php
                            oneUser($conn)
                            
                            ?>
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
    <script src="" type="text/javascript"></script>

</html>
