<?php

require_once (__DIR__ . '/../src/dbConnection.php');

class Comment {

    private $id;
    private $userId;
    private $postId;
    private $creation_date;
    private $text;

    public function __construct() {
        $this->id = -1;
        $this->userId = "";
        $this->postId = "";
        $this->creation_date = "";
        $this->text = "";
    }

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getPostId() {
        return $this->postId;
    }

    public function getCreation_date() {
        return $this->creation_date;
    }

    public function getText() {
        return $this->text;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setPostId($postId) {
        $this->postId = $postId;
    }

    public function setCreation_date() {
        $this->creation_date = date('Y-m-d H:i:s');
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function saveToDB(PDO $conn) {
        //dodawanie
        if (-1 == $this->getId()) {

            $sql = 'INSERT INTO `Comments`(`id`, `userId`, `postId`, `creation_date`, `text`) VALUES (null, :userId, :postId,:creation_date, :text);';

            $sqlParams = [
                'userId' => $this->getUserId(),
                'postId' => $this->getPostId(),
                'creation_date' => $this->getCreation_date(),
                'text' => $this->getText()
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

    static public function loadCommentById(PDO $conn, $id) {
        $stmt = $conn->prepare('SELECT * FROM `Comments` WHERE id=:id;');
        $result = $stmt->execute(['id' => $id]);
        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $loadedComment = new Comment();
            $loadedComment->id = $row['id'];
            $loadedComment->userId = $row['userId'];
            $loadedComment->postId = $row['postId'];
            $loadedComment->creation_date = $row['creation_date'];
            $loadedComment->text = $row['text'];
            return $loadedComment;
        }
        return null;
    }

    static public function loadAllCommentsByPostId(PDO $conn, $postId) {
        $stmt = $conn->prepare('SELECT * FROM `Comments` WHERE `postId`=:postId ORDER BY `creation_date` DESC;');
        $stmt->execute(['postId' => $postId]);
        $result = $stmt->fetchAll();
        $ret = [];
            foreach ($result as $row) {
                $loadedComment = new Comment();
                $loadedComment->id = $row['id'];
                $loadedComment->userId = $row['userId'];
                $loadedComment->postId = $row['postId'];
                $loadedComment->creation_date = $row['creation_date'];
                $loadedComment->text = $row['text'];
                $ret[] = $loadedComment;
            }
       
        return $ret;
    }

    
     static public function howManyComments(PDO $conn, $postId) {
        $stmt = $conn->prepare('SELECT * FROM `Comments` WHERE `postId`=:postId;');
        $stmt->execute(['postId' => $postId]);
        $result = $stmt->fetchAll();
        return count($result);
    }

}

