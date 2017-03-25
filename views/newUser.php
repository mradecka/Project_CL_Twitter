<?php
require_once '../control/userControl.php';
?>

<!DOCTYPE html>
<html lang="pl-PL">

    <head>
        <meta charset="UTF-8">
        <title>Zarejestruj się</title>
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
                </div>
            </div>
        </nav>

        <div class="container">
            <div class='col-xs-12 col-sm-6 col-sm-offset-3'>
                <div class='page-header'>
                    <h1>Rejestracja</h1>
                </div>

                <div id="form-messages" class="success" class="error"><h4><?php
                        if ("GET" === $_SERVER['REQUEST_METHOD']) {
                            if (isset($_GET['emailexist'])) {
                                echo '<p>Konto o podanym adresie email już istnieje.</p>';
                            }
                            if (isset($_GET['empty'])) {
                                echo '<p>Uzupełnij puste pola.</p>';
                            }
                            if (isset($_GET['wrongpass'])) {
                                echo '<p>Hasła nie są takie same.</p>';
                            }
                        }
                        ?>
                    </h4></div>

                <div class='panel'>
                    <div class='panel-body'>
                        <form class="form-horizontal" action="" method="POST">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="newusername">Nazwa użytkownika:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="newusername" id="username" placeholder="Enter username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Email:</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="newemail" id="email" placeholder="Enter email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Hasło:</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="newpassword" id="pwd" placeholder="Enter password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Potwierdź hasło:</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="newpassword2"id="pwd2" placeholder="Repeat password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary active">Zarejestruj się</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>