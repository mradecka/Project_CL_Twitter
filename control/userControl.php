<?php

session_start();
require_once '../src/user.php';

if ("POST" === $_SERVER['REQUEST_METHOD']) {
    //login 
    if (isset($_POST['email']) && isset($_POST['password'])) {

        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = new User();
            $usersArray = $user->loadAllUsers($conn);
            foreach ($usersArray as $user) {
                if ($user->getEmail() == $email) {
                    if (password_verify($password, $user->getHashPass())) {
                        $_SESSION['username'] = $user->getUsername();
                        $_SESSION['email'] = $user->getEmail();
                        $_SESSION['id'] = $user->getId();
                        header('Location:../views/main.php');
                    }
                } else {
                    header('Location:../index.php?emailorpass');
                }
            }
        } else {
            header('Location:../index.php?empty');
        }
    }

//register new user
    if (isset($_POST['newusername']) && isset($_POST['newemail']) && isset($_POST['newpassword']) && isset($_POST['newpassword2'])) {

        if (!empty($_POST['newusername']) && !empty($_POST['newemail']) && !empty($_POST['newpassword']) && !empty($_POST['newpassword2'])) {
            $email = $_POST['newemail'];
            $user = new User();
            $usersArray = $user->loadAllUsers($conn);
            foreach ($usersArray as $user) {
                if ($user->getEmail() == $email) {
                    $existMail = true;
                }
            }
            if ($existMail == true) {
                header('Location:../views/newUser.php?emailexist');
            } else if ($existMail == false && $_POST['newpassword'] === $_POST['newpassword2']) {
                $user = new User();
                $user->setHashPass($_POST['newpassword']);
                $user->setUsername($_POST['newusername']);
                $user->setEmail($_POST['newemail']);
                $result = $user->saveToDB($conn);
                header('Location: ../index.php?newuser');
            } else {
                header('Location:../views/newUser.php?wrongpass');
            }
        } else {
            header('Location:../views/newUser.php?empty');
        }
    }


//edit user
    if (isset($_POST['editusername']) && isset($_POST['editemail']) && isset($_POST['editpassword']) && isset($_POST['editpassword2'])) {

        if (!empty($_POST['editusername']) && !empty($_POST['editemail']) && !empty($_POST['editpassword']) && !empty($_POST['editpassword2'])) {
            if ($_POST['editpassword'] === $_POST['editpassword2']) {
                $username = $_POST['editusername'];
                $email = $_POST['editemail'];
                $password = $_POST['editpassword'];
                $user = new User();
                $usersArray = $user->loadAllUsers($conn);
                var_dump($_SESSION);
                foreach ($usersArray as $userEdit) {
                    if ($userEdit->getId() == $_SESSION['id']) {
                        $id = $userEdit->getId();
                        $userEdit->loadUserById($conn, $id);
                        $userEdit->setUsername($username);
                        $userEdit->setEmail($email);
                        $userEdit->setHashPass($password);
                        $userEdit->saveToDB($conn);
                        header('Location: ../views/settings.php?correct');
                    }
                }
            } else {
                header('Location:../views/settings.php?wrongpass');
            }
        } else {
            header('Location:../views/settings.php?empty');
        }
    }

//delete user
    if (isset($_POST['delete'])) {
        $user = new User();
        $usersArray = $user->loadAllUsers($conn);
        foreach ($usersArray as $userDelete) {
            if ($userDelete->getId() == $_SESSION['id']) {
                $id = $user->getId();
                $userDelete->loadUserById($conn, $id);
                $userDelete->delete($conn);
                session_unset();
                header('Location:../index.php?delete');
            }
        }
    }
}


if ("GET" == $_SERVER['REQUEST_METHOD']) {

    //load account of one user
    function oneUser($conn) {
        if ("GET" == $_SERVER['REQUEST_METHOD']) {
            if (!empty($_GET['userId'])) {
                $tweet = new Tweet();
                $tweetsArray = $tweet->loadAllTweets($conn);
                foreach ($tweetsArray as $loadtweet) {
                    $user = new User();
                    $search = $user->loadUserById($conn, $_GET['userId']);

                    if ($_GET['userId'] == $loadtweet->getUserId()) {

                        echo'<div class = "media">
                <div class = "media-left">
                    <h1><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span></h1>
                </div>
                <div class = "media-right">
                    <div><a href="./tweet.php?tweetId='.$loadtweet->getId().'">'. $loadtweet->getText() . '</a></div>
                    <p>' . $loadtweet->getCreationDate() . '</p> 
                </div>
            </div>';
                    }
                }
            }
        }
    }
    // print name of user
    function hello($conn) {
        if (!empty($_GET['userId'])) {
            $id = $_GET['userId'];
        } else {
            $id = $_SESSION['id'];
        }
        $user = new User();
        $helloUser = $user->loadUserById($conn, $id);
        $username = $helloUser->getUsername();
        return $username;
    }
    //log out
    if ("GET" == $_SERVER['REQUEST_METHOD']) {
        if (isset($_GET['logout'])) {
            session_unset();
            header('Location:../index.php?byebye');
        }
    }
}
?>


