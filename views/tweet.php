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
        <title>Tweet</title>
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
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class='col-xs-12 col-sm-6 col-sm-offset-3'>
                <div class='page-header'>
                    <h3>Informacje o tweet</h3>
                </div>

                <div id="form-messages" class="success" class="error"></div>

                <div class='panel'>
                    <?php
                    oneTweet($conn);
                    ?>
                </div>

                <div class='panel'>
                    <div class='panel-body'>
                        <form id="ajax-contact" action="" method="POST">
                            <div class="form-group">
                                <label for="comment">Dodaj komentarz:</label>
                                <textarea class="form-control" rows="5" id="comment" name="comment" maxlength="140"></textarea>
                            </div>
                            <br>
                            <p>
                                <button type='submit' class='btn btn-primary active' id='add'>Dodaj</button>
                            </p>
                        </form>
                    </div>
                </div>

            </div>
            <div class="container">
                <div class='col-xs-12 col-sm-6 col-sm-offset-3'>
                    <div class='page-header'>
                        <h5>Komentarze</h5>
                    </div>
                    <div class="panel">

                    </div>
                    <div class='panel'>
                        <div class='panel-body'>

                            <?php
                            loadCommentsToTweet($conn);
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>
