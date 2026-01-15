<?php
namespace Models;
use PDO;

class UserModel{
    private $db;
    
    public function __construct(PDO $db){
        $this->db = $db;
    } 
    
    public function register($email , $password , $name){
        $hash = password_hash($password , PASSWORD_DEFAULT);
        $stmt = this->db->prepare("INSERT INTO users(email , password_hash , name ) VALUES (?,?,?)");
        return $stmt->execute([$email,$hash , $name]);
    }

    public function login($email , $password){
        $stmt = this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user && password_verify($password , $user['password_hash'])) {
            return $user;
        }
        return false;
    }
    public function getUserById($id){
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt ->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function updatePoints($userId , $newTotla , $newEarned = null){
        $sql .= "WHERE id = ?";
        $params[] = $userId;
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }
}