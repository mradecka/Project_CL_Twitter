<?php
session_start();
require_once '../control/userControl.php';


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
                        <li role="presentation" class="active"><a href="main.php">Home</a></li>
                        <li role="presentation"><a href="user.php">Twój profil</a></li>
                        <li role="presentation"><a href="#">Wiadomości</a></li>
                        <li role="presentation"><a href="settings.php">Ustawienia</a></li>
                        <li role="presentation"><a href="logout.php">Wyloguj się</a></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="container">
            <div class='col-xs-12 col-sm-6 col-sm-offset-3'>
                <div class='page-header'>
                    <h3>Strona użytkownika</h3>

                </div>
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary btn-md"><a style="color: white" class="text-center" href="./index.php">Wyślij wiadomość</a></button>
                </div>

                <div class='panel'>
                    <div class='panel-body'>
                        <ol id="tweets">
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
    <script src="" type="text/javascript"></script>

</html>
