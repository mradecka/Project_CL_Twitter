<?php
require_once '../src/user.php';
require_once '../src/message.php';

if ("POST" == $_SERVER['REQUEST_METHOD']) {
    if (!empty($_POST['mailtext'])) {
        $message = new Message();
        $message->setCreationDate();
        $message->setOpen(0);
        $message->setSenderId((int) $_SESSION['id']);
        $message->setReceiverId((int) $_GET['userId']);
        $message->setText($_POST['mailtext']);
        $message->saveToDB($conn);
    }
}

function send($conn) {

    $send = new Message();
    $sendArray = $send->loadSendMessages($conn);
    foreach ($sendArray as $loadmessage) {
        $user = new User();
        $search = $user->loadUserById($conn, $loadmessage->getReceiverId());
        echo'<div class = "media">
        <div class = "media-left">
        <h1><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></h1>
        </div>
        <div class = "media-right">
        <h4 class = "media-heading"><a href="./user.php?userId=' . $loadmessage->getReceiverId() . '">Odbiorca: ' . $search->getUsername() . '</a></h4>
        <div>' . $loadmessage->getText() . '</div>
        <h6><p>' . $loadmessage->getCreationDate() . '</p> </h6>
        </div>
        </div>';
    }
}

function receiver($conn) {

    $send = new Message();
    $sendArray = $send->loadReceiverIdMessages($conn);
    foreach ($sendArray as $loadmessage) {
        $user = new User();
        $search = $user->loadUserById($conn, $loadmessage->getReceiverId());
        echo'<div class = "media">
        <div class = "media-left">
        <h1><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></h1>
        </div>
        <div class = "media-right">
        <h4 class = "media-heading"><a href="./user.php?userId=' . $loadmessage->getReceiverId() . '">Nadawca: ' . $search->getUsername() . '</a></h4>
        <div>' . $loadmessage->getText() . '</div>
        <h6><p>' . $loadmessage->getCreationDate() . '</p> </h6>
        </div>
        </div>';
    }
}