<?php

use PDO;

class GoodsModel{
    private $db;

    public function __construct(PDO $db){
        $this->db = $db;
    }

    public function getAllGoods(){
        $stmt = $this->db->query("SELECT * FROM goods");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function gatGoodById($id){
        $stmt = $this->db->prepare("SELECT * FROM goods WHERE id = ? ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buy($id){
        $stmt = $this->db->prepare("UPDATE goods SET quantity = quantity - 1 WHERE id=? AND quantity > 0");
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }
}