<?php 

use PDO;

class RewardModel{
    private $db;
    public function __construct(PDO $db){
        $this->db = $db;
    }

    public function getAvialableRewards(){
        $stmt = $this->db->query("SELECT * FROM rewards WHERE stock > 0");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRewardById($id){
        $stmt = $this->db->prepare("SELECT * FROM rewards WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function redeem($id){
        $stmt = $this->db->prepare("UPDATE rewards SET stock = stock-1 WHERE id = ? AND stock > 0 ");
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    
        }

}