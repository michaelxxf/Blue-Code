<<<<<<< HEAD
<?php
// app/models/Branch.php

require_once __DIR__ . '/../../config/config.php'; // This sets up $pdo

class Branch {
    private $pdo;
    
    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }
    
    /**
     * Save branch data to the database.
     * Expects $data as an associative array with keys matching your DB columns:
     * merchant_id, ext_id, merchant_branch_id, name, address_city, address_line1, address_line2, 
     * address_zip, address_country, contact_name, contact_email, contact_phone, contact_gender, 
     * booking_reference_prefix, state, virtual_terminal, inserted_at, updated_at.
     */
    public function save($data) {
        $sql = "INSERT INTO branches 
                (merchant_id, ext_id, merchant_branch_id, name, Branch_login_id, branch_password, address_city, address_line1, address_line2, address_zip, address_country, contact_name, contact_email, contact_phone, contact_gender, booking_reference_prefix, state, virtual_terminal, inserted_at, updated_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['merchant_id'],
            $data['ext_id'],
            $data['merchant_branch_id'],
            $data['name'],
            $data['Branch_login_id'],
            $data['Branch_password'],
            $data['address_city'],
            $data['address_line1'],
            $data['address_line2'],
            $data['address_zip'],
            $data['address_country'],
            $data['contact_name'],
            $data['contact_email'],
            $data['contact_phone'],
            $data['contact_gender'],
            $data['booking_reference_prefix'],
            $data['state'],
            $data['virtual_terminal'],
            $data['inserted_at'],
            $data['updated_at']
        ]);
    }
    
    /**
     * Retrieve all branches for a given merchant.
     */
    public function getBranchesByMerchant($merchantId) {
        $sql = "SELECT * FROM branches WHERE merchant_id = ? ORDER BY inserted_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$merchantId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get branch by its name (for branch login)
    public function getByName($branchName) {
        $sql = "SELECT * FROM branches WHERE Branch_login_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$branchName]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Get branch by its external ID
    public function getById($extId) {
        $sql = "SELECT * FROM branches WHERE ext_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$extId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}
?>
=======
<?php
// app/models/Branch.php

require_once __DIR__ . '/../../config/config.php'; // This sets up $pdo

class Branch {
    private $pdo;
    
    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }
    
    /**
     * Save branch data to the database.
     * Expects $data as an associative array with keys matching your DB columns:
     * merchant_id, ext_id, merchant_branch_id, name, address_city, address_line1, address_line2, 
     * address_zip, address_country, contact_name, contact_email, contact_phone, contact_gender, 
     * booking_reference_prefix, state, virtual_terminal, inserted_at, updated_at.
     */
    public function save($data) {
        $sql = "INSERT INTO branches 
                (merchant_id, ext_id, merchant_branch_id, name, Branch_login_id, branch_password, address_city, address_line1, address_line2, address_zip, address_country, contact_name, contact_email, contact_phone, contact_gender, booking_reference_prefix, state, virtual_terminal, inserted_at, updated_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['merchant_id'],
            $data['ext_id'],
            $data['merchant_branch_id'],
            $data['name'],
            $data['Branch_login_id'],
            $data['Branch_password'],
            $data['address_city'],
            $data['address_line1'],
            $data['address_line2'],
            $data['address_zip'],
            $data['address_country'],
            $data['contact_name'],
            $data['contact_email'],
            $data['contact_phone'],
            $data['contact_gender'],
            $data['booking_reference_prefix'],
            $data['state'],
            $data['virtual_terminal'],
            $data['inserted_at'],
            $data['updated_at']
        ]);
    }
    
    /**
     * Retrieve all branches for a given merchant.
     */
    public function getBranchesByMerchant($merchantId) {
        $sql = "SELECT * FROM branches WHERE merchant_id = ? ORDER BY inserted_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$merchantId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get branch by its name (for branch login)
    public function getByName($branchName) {
        $sql = "SELECT * FROM branches WHERE Branch_login_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$branchName]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Get branch by its external ID
    public function getById($extId) {
        $sql = "SELECT * FROM branches WHERE ext_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$extId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}
?>
>>>>>>> cb2db00 (Initial commit)
