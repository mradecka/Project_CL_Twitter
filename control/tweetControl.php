<?php

require_once (__DIR__ . '/../src/tweet.php');
require_once (__DIR__ . '/../src/comment.php');


addTweet($conn);
addComment($conn);

function loadTweets($conn) {

    $tweet = new Tweet();
    $tweetsArray = $tweet->loadAllTweets($conn);
    foreach ($tweetsArray as $loadtweet) {
        $user = new User();
        $search = $user->loadUserById($conn, $loadtweet->getUserId());
        echo'<div class = "media">
        <div class = "media-left">
        <h1><span class="glyphicon glyphicon-send" aria-hidden="true"></span></h1>
        </div>
        <div class = "media-right">
        <h4 class = "media-heading"><a href="./user.php?userId=' . $loadtweet->getUserId() . '">' . $search->getUsername() . '</a></h4>
        <div><a href="./tweet.php?tweetId=' . $loadtweet->getId() . '">' . $loadtweet->getText() . '</a></div>
        <h6><p>' . $loadtweet->getCreationDate() . '</p> </h6>
        </div>
        </div>';
    }
}


function oneTweet($conn) {
    if ("GET" == $_SERVER['REQUEST_METHOD']) {
        if (!empty($_GET['tweetId'])) {

            $tweet = new Tweet();
            $oneTweet = $tweet->loadTweetById($conn, $_GET['tweetId']);
            $user = new User();
            $search = $user->loadUserById($conn, $oneTweet->getUserId());
            echo'<div class = "media">
                <div class = "media-left">
                    <h1><span class="glyphicon glyphicon-send" aria-hidden="true"></span></h1>
                </div>
                <div class = "media-right">
        <h4 class = "media-heading"><a href="./user.php?userId=' . $oneTweet->getUserId() . '">' . $search->getUsername() . '</a></h4>
        <div>' . $oneTweet->getText() . '</div>
        <p>' . $oneTweet->getCreationDate() . '</p> 
                </div>
            </div>';
        }
    }
}

function addTweet($conn) {
    if ("POST" === $_SERVER['REQUEST_METHOD']) {
        if (!empty($_POST['newtweet'])) {
            $id = $_SESSION['id'];
            $newtweet = new Tweet();
            $newtweet->setUserId($id);
            $newtweet->setCreationDate();
            $newtweet->setText($_POST['newtweet']);
            $newtweet->saveToDB($conn);
        }
    }
}

function loadCommentsToTweet($conn) {
    if ("GET" == $_SERVER['REQUEST_METHOD']) {
        $postId = $_GET['tweetId'];
        $comment = new Comment();
        $commentsArray = $comment->loadAllCommentsByPostId($conn, $postId);
        foreach ($commentsArray as $loadcomment) {
            $user = new User();
            $search = $user->loadUserById($conn, $loadcomment->getUserId());
            echo'<div class = "media">
        <div class = "media-left">
        <h1><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></h1>
        </div>
        <div class = "media-right">
        
        <div>' . $loadcomment->getText() . '</div>
        <h5 class = "media-heading"><a href="./user.php?userId=' . $loadcomment->getUserId() . '">' . $search->getUsername() . '</a></h5>
        <h6 ><p>' . $loadcomment->getCreation_date() . '</p></h6> 
        </div>
        </div>';
        }
    }
}

function addComment($conn) {
    if (isset($_GET['tweetId']) && !empty($_GET['tweetId'])) {
        $postId = $_GET['tweetId'];
        if ("POST" === $_SERVER['REQUEST_METHOD']) {
            if (!empty($_POST['comment'])) {
                $id = $_SESSION['id'];
                $newcomment = new Comment();
                $newcomment->setUserId($_SESSION['id']);
                $newcomment->setCreation_date($id);
                $newcomment->setPostId($postId);
                $newcomment->setText($_POST['comment']);
                $newcomment->saveToDB($conn);
            }
        }
    }
}
?>


