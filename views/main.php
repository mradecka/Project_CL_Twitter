<?php
require_once '../control/userControl.php';
require_once '../control/tweetControl.php';


if ($_SESSION['id'] == null) {
    header('Location:../index.php?log');
}
?>

<!DOCTYPE html>
<html lang="pl-PL">

    <head>
        <meta charset="UTF-8">
        <title>Strona główna</title>
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
                        <li role="presentation" class="active"><a href="main.php">Home</a></li>
                        <li role="presentation"><a href="user.php?userId=<?php echo $_SESSION['id'] ?>">Twój profil</a></li>
                        <li role="presentation"><a href="#">Wiadomości</a></li>
                        <li role="presentation"><a href="settings.php">Ustawienia</a></li>
                        <li role="presentation"><a href="../index.php?logout">Wyloguj się</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class='col-xs-12 col-sm-6 col-sm-offset-3'>
                <div class='page-header'>
                    <h3>Witaj! <?php echo $_SESSION['username']; ?>.</h3>
                </div>

                <div id="form-messages" class="success" class="error"></div>

                <div class='panel'>
                    <div class='panel-body'>
                        <form id="ajax-contact" action="" method="POST" action="">
                            <div class="form-group">
                                <label for="comment">Dodaj nowy tweet:</label>
                                <textarea class="form-control" rows="5" id="tweet" name="newtweet" maxlength="140"></textarea>
                            </div>
                            <br>
                            <p>
                                <button type='submit' class='btn btn-primary active' id='add'>Dodaj</button>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="container">
            <div class='col-xs-12 col-sm-6 col-sm-offset-3'>
                <div class='page-header'>
                    <h2>Wszystkie tweety</h2>
                </div>
                <div class="panel">

                </div>
                <div class='panel'>
                    <div class='panel-body'>

                        <?php
                        loadTweets($conn);
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </body>

</html>
