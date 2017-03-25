<?php
require_once '../control/userControl.php';


if ($_SESSION['id'] == null) {
    header('Location:../index.php');
}
?>
<!DOCTYPE html>
<html lang="pl-PL">

    <head>
        <meta charset="UTF-8">
        <title>Ustawienia konta</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
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
                    <h1>Zmiana danych</h1>                         
                    <form method="POST" action="../control/userControl.php">
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button class="btn btn-danger" name="delete">Usuń konto</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div id="form-messages" class="success" class="error"><h4><?php
                        if ("GET" === $_SERVER['REQUEST_METHOD']) {
                            if (isset($_GET['empty'])) {
                                echo '<p>Uzupełnij puste pola.</p>';
                            }
                            if (isset($_GET['wrongpass'])) {
                                echo '<p>Hasła nie są takie same.</p>';
                            }
                            if (isset($_GET['correct'])) {
                                echo '<p>Twoje dane zostały zaktualizowane.</p>';
                            }
                        }
                        ?>
                    </h4></div>

                <div class='panel'>
                    <div class='panel-body'>
                        <form class="form-horizontal" action="../control/userControl.php" method="POST">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Twój mail:</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="editemail" id="email" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="username">Nowa nazwa użytkownika:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="editusername" id="username" placeholder="Enter username">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Nowe hasło:</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="editpassword" id="pwd" placeholder="Enter password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Potwierdź nowe hasło:</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="editpassword2"id="pwd2" placeholder="Repeat password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary active">Zmień dane</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
    <script src="" type="text/javascript"></script>

</html>