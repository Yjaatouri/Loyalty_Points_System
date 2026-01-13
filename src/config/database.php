<?php


function getDbConnection() {
    $host = 'localhost';
    $dbname = 'loyaltyPoints';
    $user = 'root'; 
    $pass = 'Yahya2025@'; 

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}