<?php

include_once (__DIR__ . '/../src/dbConnection.php');

class Message {

    private $id;
    private $text;
    private $senderId;
    private $receiverId;
    private $open;
    private $creationDate;

    public function __construct() {
        $this->id = -1;
        $this->text = '';
        $this->senderId = '';
        $this->receiverId = '';
        $this->open = 0;
        $this->creationDate = '';
    }
    public function getOpen() {
        return $this->open;
    }

    public function setOpen($open) {
        $this->open = $open;
    }

        public function getId() {
        return $this->id;
    }

    public function getText() {
        return $this->text;
    }

    public function getSenderId() {
        return $this->senderId;
    }

    public function getReceiverId() {
        return $this->receiverId;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function setSenderId($senderId) {
        $this->senderId = $senderId;
    }

    public function setReceiverId($receiverId) {
        $this->receiverId = $receiverId;
    }

    public function setCreationDate() {
        $this->creationDate = date('Y-m-d H:i:s');
    }

    //    add new tweet
    public function saveToDB(PDO $conn) {
        //dodawanie
        if (-1 == $this->getId()) {

            $sql = 'INSERT INTO `Messages` (`id`, `text`, `senderId`, `receiverId`, `open`, `creationDate`) VALUES (NULL, :text, :senderId, :receiverId, :open, :creationDate);';
            $sqlParams = [
                'text' => $this->getText(),
                'senderId' => $this->getSenderId(),
                'receiverId' => $this->getReceiverId(),
                'open' => $this->open,
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

    static public function loadMessagesById(PDO $conn, $id) {
        $stmt = $conn->prepare('SELECT * FROM `Messages` WHERE id=:id;');
        $result = $stmt->execute(['id' => $id]);
        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $loadedMessage = new Message();
            $loadedMessage->id = $row['id'];
            $loadedMessage->text = $row['text'];
            $loadedMessage->senderId = $row['senderId'];
            $loadedMessage->receiverId = $row['receiverId'];
            $loadedMessage->open = $row['open'];
            $loadedMessage->creationDate = $row['creationDate'];
            return $loadedMessage;
        }
        return null;
    }
    
        static public function loadSendMessages(PDO $conn) {        
        $sql = 'SELECT * FROM `Messages` WHERE senderId='.$_SESSION['id'].';';
        $ret = [];
        $result = $conn->query($sql);
        if ($result !== false && $result->rowCount() != 0) {
            foreach ($result as $row) {
                $loadedMessage = new Message();
                $loadedMessage->id = $row['id'];
                $loadedMessage->text = $row['text'];
                $loadedMessage->senderId = $row['senderId'];
                $loadedMessage->receiverId = $row['receiverId'];
                $loadedMessage->open = $row['open'];
                $loadedMessage->creationDate = $row['creationDate'];
                $ret[] = $loadedMessage;
            }
        }
        return $ret;
    }
    
        static public function loadReceiverIdMessages(PDO $conn) {
        $sql = 'SELECT * FROM `Messages` WHERE receiverId='.$_SESSION['id'].';';
        $ret = [];
        $result = $conn->query($sql);
        if ($result !== false && $result->rowCount() != 0) {
            foreach ($result as $row) {
                $loadedMessage = new Message();
                $loadedMessage->id = $row['id'];
                $loadedMessage->text = $row['text'];
                $loadedMessage->senderId = $row['senderId'];
                $loadedMessage->receiverId = $row['receiverId'];
                $loadedMessage->open = $row['open'];
                $loadedMessage->creationDate = $row['creationDate'];
                $ret[] = $loadedMessage;
            }
        }
        return $ret;
    }

    //    loadAllTweets()
    static public function loadAllMessages(PDO $conn) {

        $sql = "SELECT * FROM `Messages`ORDER BY `creationDate` DESC;";
        $ret = [];
        $result = $conn->query($sql);
        if ($result !== false && $result->rowCount() != 0) {
            foreach ($result as $row) {
                $loadedMessage = new Message();
                $loadedMessage->id = $row['id'];
                $loadedMessage->text = $row['text'];
                $loadedMessage->senderId = $row['senderId'];
                $loadedMessage->receiverId = $row['receiverId'];
                $loadedMessage->open = $row['open'];
                $loadedMessage->creationDate = $row['creationDate'];
                $ret[] = $loadedMessage;
            }
        }
        return $ret;
    }

}