<?php
if (isset($_SESSION['usersname'], $_SESSION['email'], $_SESSION['id'])) {
    header('Location:views/main.php');
} else {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pl-PL">

    <head>
        <meta charset="UTF-8">
        <title>Logowanie</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
        <link href="css/style.css" rel="stylesheet">
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
                    <h1>Logowanie</h1>
                </div>

                <div id="form-messages" class="success" class="error"><h4><?php
                        //log error
                        if ("GET" === $_SERVER['REQUEST_METHOD']) {
                            if (isset($_GET['emailorpass'])) {
                                echo '<p>Nieprawidłowy email lub hasło</p>';
                            }

                            if (isset($_GET['log'])) {
                                echo '<p>Logowanie niepoprawne</p>';
                            }

                            if (isset($_GET['empty'])) {
                                echo '<p>Uzupełnij puste pola</p>';
                            }
                            if (isset($_GET['newuser'])) {
                                echo '<p>Witaj! Możesz teraz zalogować się na swoje konto</p>';
                            }
                            if (isset($_GET['delete'])) {
                                echo '<p>Twoje konto zostało usunięte</p>';
                            }
                            if (isset($_GET['logout'])) {
                                echo '<p>Wpadnij do nas jeszcze :)</p>';
                            }
                        }
                        ?></h4></div>

                <div class='panel'>
                    <div class='panel-body'>
                        <form class="form-horizontal" method="POST" action="views/main.php">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Email:</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Password:</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password" id="pwd" placeholder="Enter password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <label><a href="views/newUser.php">Zarejestruj</a></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary active">Zaloguj</button>
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
