<?php
session_start();
require_once '../control/messageControl.php';
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
                        <li role="presentation" class="active"><a href="../main.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Strona główna</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class='col-xs-12 col-sm-6 col-sm-offset-3'>

                <div id="form-messages" class="success" class="error"></div>
                <?php
                if ("POST" == $_SERVER['REQUEST_METHOD']) {
                    if (isset($_GET['userId']) && !empty($_POST['mailtext'])) {
                        echo 'Wiadomość została wysłana';
                    }
                }
                ?>
                <div class='panel'>
                    <div class='panel-body'>
                        <form id="ajax-contact" action="" method="POST" action="">
                            <div class="form-group">
                                <label for="comment">Treść wiadomości:</label>
                                <textarea class="form-control" rows="5" id="tweet" name="mailtext" maxlength="140"></textarea>
                            </div>
                            <br>
                            <p>
                                <button type='submit' class='btn btn-primary active' id='send'>Wyślij</button>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
