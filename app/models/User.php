<?php
// app/Models/Merchant.php

require_once __DIR__ . '/../../config/config.php'; // This sets up $pdo


class User {
    private $pdo;

    public function __construct() {
        global $pdo; // Access the PDO instance from config
        $this->pdo = $pdo;
    }

    // Save to users table
    public function save($data) {
        $sql = "INSERT INTO users (email, password_hash, ext_id) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['email'],
            $data['password_hash'],
            $data['ext_id']
        ]);
    }


    public function getById($merchantId) {
        $sql = "SELECT * FROM merchants WHERE ext_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$merchantId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function updateUserSettings($merchantId, $data) {
        // Adjust the SQL statement to update only the fields you need.
        $sql = "UPDATE users SET 
                    email = ?
                WHERE ext_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['merchant_email'],
            $merchantId
        ]);
    
    }
}


?>