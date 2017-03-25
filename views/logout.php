<?php

if ($_SESSION['id'] == null) {
    header('Location:../index.php');
}


session_start();
if("GET" === $_SERVER['REQUEST_METHOD']) {
    session_unset();
    header('Location:../index.php');
}
