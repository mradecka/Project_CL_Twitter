<?php

include_once (__DIR__ . '/../src/dbConnection.php');

class Tweet {

    private $id;
    private $userId;
    private $text;
    private $creationDate;

    public function __construct() {
        $this->id = -1;
        $this->userId = '';
        $this->text = '';
        $this->creationDate = '';
    }

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getText() {
        return $this->text;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function setCreationDate() {
        $this->creationDate = date('Y-m-d H:i:s');
    }

    //    add new tweet
    public function saveToDB(PDO $conn) {
        //dodawanie
        if (-1 == $this->getId()) {

            $sql = 'INSERT INTO `Tweets`(`id`, `userId`, `text`, `creationDate`) VALUES (null, :userId, :text ,:creationDate);';
            
            $sqlParams = [
                'userId' => $this->getUserId(),
                'text' => $this->getText(),
                'creationDate' => $this->getCreationDate()
            ];
        }

        try {

            $query = $conn->prepare($sql);
            $result = $query->execute($sqlParams);

            return $result;
        } catch (PDOException $ex) {
            echo $ex->getMessage() . '<hr>';
            return false;
        }
    }

    //    loadTweetById()
    
    static public function loadTweetById(PDO $conn, $id) {
        $stmt = $conn->prepare('SELECT * FROM `Tweets` WHERE id=:id;');
        $result = $stmt->execute(['id' => $id]);
        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $loadedTweet = new Tweet();
                $loadedTweet->id = $row['id'];
                $loadedTweet->userId = $row['userId'];
                $loadedTweet->text = $row['text'];
                $loadedTweet->creationDate = $row['creationDate'];
            return $loadedTweet;
        }
        return null;
    }
    
    //    loadAllTweets()
    static public function loadAllTweets(PDO $conn) {

        $sql = "SELECT * FROM `Tweets`ORDER BY `creationDate` DESC;";
        $ret = [];
        $result = $conn->query($sql);
        if ($result !== false && $result->rowCount() != 0) {
            foreach ($result as $row) {
                $loadedTweet = new Tweet();
                $loadedTweet->id = $row['id'];
                $loadedTweet->userId = $row['userId'];
                $loadedTweet->text = $row['text'];
                $loadedTweet->creationDate = $row['creationDate'];
                $ret[] = $loadedTweet;
            }
        }
        return $ret;
    }
}
