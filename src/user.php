<?php

require_once '/home/marta/Workspace/Project_CL_Twitter/src/dbConnection.php';

class User {

    private $id;
    private $username;
    private $hashPass;
    private $email;

    public function __construct() {
        $this->id = -1;
        $this->username = "";
        $this->email = "";
        $this->hashPass = "";
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getHashPass() {
        return $this->hashPass;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setHashPass($newPass) {
        $newHashedPassword = password_hash($newPass, PASSWORD_BCRYPT);
        $this->hashPass = $newHashedPassword;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function saveToDB(PDO $conn) {
        //dodawanie
        if (-1 == $this->getId()) {

            $sql = 'INSERT INTO `Users`(`id`, `email`, `username`, `hash_pass`) VALUES (null, :email, :username,:hash_pass);';

            $sqlParams = [
                'email' => $this->getEmail(),
                'username' => $this->getUsername(),
                'hash_pass' => $this->getHashPass()
            ];
        }
        //edytowanie
        else {
            $sql = 'Update `Users` SET   
                                        `email` = :email,
                                        `username` = :username, 
                                        `hash_pass` = :hash_pass
                                Where id = :id ;
                        ';
            $sqlParams = [
                'id' => $this->getId(),
                'username' => $this->getUsername(),
                'hash_pass' => $this->getHashPass(),
                'email' => $this->getEmail()
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

    static public function loadUserById(PDO $conn, $id) {
        $stmt = $conn->prepare('SELECT * FROM `Users` WHERE id=:id;');
        $result = $stmt->execute(['id' => $id]);
        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashPass = $row['hash_pass'];
            $loadedUser->email = $row['email'];
            return $loadedUser;
        }
        return null;
    }

    static public function loadAllUsers(PDO $conn) {
        $sql = "SELECT * FROM `Users`;";
        $ret = [];
        $result = $conn->query($sql);
        if ($result !== false && $result->rowCount() != 0) {
            foreach ($result as $row) {
                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->username = $row['username'];
                $loadedUser->hashPass = $row['hash_pass'];
                $loadedUser->email = $row['email'];
                $ret[] = $loadedUser;
            }
        }
        return $ret;
    }

    public function delete(PDO $conn) {
        if ($this->id != -1) {
            $stmt = $conn->prepare('DELETE FROM `Users` WHERE id=:id;');
            $result = $stmt->execute(['id' => $this->id]);
            if ($result === true) {
                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
    }
    
    

}

//$user = new User();
//$user->setEmail('onet@google.pl');
//$user->setHashPass('bbb');
//$user->setUsername('ddd');
//echo $user->saveToDB($conn);
//$new = $user->loadUserById($conn, 16);
//var_dump($new->delete($conn));
//var_dump($new->setEmail('mmm'));
//var_dump($new->getEmail('222'));
//var_dump($new->getHashPass());
//var_dump($new->setHashPass('1233333333333333333333333333333333333'));
//var_dump($new->saveToDB($conn));
