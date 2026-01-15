<?php

namespace Models;

use PDO;

class PointsModel{
    private $db;
    public function __construct(PDO $db){
        $this->db = $db;
    }
    public function getBalance($userId){
        $stmt = $this->db->prepare("SELECT total_points FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchColumn() ?? 0;
    }
    public function addPoints($userId , $amount , $description){
        $currentBalance = $this->getBalance($userId);
        $newBalance = $currentBalance + $amount;

        $currentEarned = $this->getEarned($userId);
        $newEarned = $currentEarned + $amount;

        $stmt = $this->db->prepare("INSERT INTO points_transaction (user_id,type,amount,description,balance_after) VALUES (? ,'earned',?,?,?)");
        $stmt->execute([$userId,$amount , $description , $newBalance]);

        $this->db->prepare("UPDATE users SET total_points = ?,earned_points  = ? WHERE id = ?")->execute([$newBalance , $newEarned,$userId]);
    }

    public function deductpoints($userId , $amount , $description , $type = 'redeemed'){
        $currentBalance  = $this->getBalance($userId);
        if($currentBalance < $amount){
            return false;
        }
        $newBalance = $currentBalance - $amount;

        $stmt = $this->db->prepare("INSERT INTO points_transactions (user_id,type,amount,description , balance_after) VALUES (?,?,?,?,?)");
        $stmt->execute([$userId , $type , -$amount , $description , $newBalance]);

        $this->db->prepare("UPDATE users SET total_points = ? WHERE id = ? ")->execute([$newBalance,$userId]);
        return true;
    }

    public function getHistory($userId){
        $stmt = $this->db->prepare("SELECT * FROM points_transactions WHERE user_id  = ? ORDER BY createdat DESC ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    private function getEarned($userId){
        $stmt = $this->db->prepare("SELECT earned_points FROM users WHERE id = ? ");
        $stmt->execute([$userId]);
        return $stmt->fetchColumn() ?? 0;
        
    }

    public function expired($userId , $amount , $description){
        return $this->deductpoints($userId , $amount , $description , 'expired');
    }

}