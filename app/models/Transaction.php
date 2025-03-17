<<<<<<< HEAD
<?php
// app/models/Transaction.php
require_once __DIR__ . '/../../config/config.php'; // sets up $pdo

class Transaction {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Save a new transaction record to the local database
    public function save($data) {
        $sql = "INSERT INTO transactions 
                (branch_id, merchant_tx_id, acquirer_tx_id, amount, currency, status, created_at)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['branch_id'],
            $data['merchant_tx_id'],
            $data['acquirer_tx_id'],
            $data['amount'],
            $data['currency'],
            $data['status'],
            date("Y-m-d H:i:s")
        ]);
    }
    
    // add methods to fetch transactions for a branch, etc.

    public function getTransactions($branch_id) {
        $sql = "SELECT * FROM transactions WHERE branch_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$branch_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
=======
<?php
// app/models/Transaction.php
require_once __DIR__ . '/../../config/config.php'; // sets up $pdo

class Transaction {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Save a new transaction record to the local database
    public function save($data) {
        $sql = "INSERT INTO transactions 
                (branch_id, merchant_tx_id, acquirer_tx_id, amount, currency, status, created_at)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['branch_id'],
            $data['merchant_tx_id'],
            $data['acquirer_tx_id'],
            $data['amount'],
            $data['currency'],
            $data['status'],
            date("Y-m-d H:i:s")
        ]);
    }
    
    // add methods to fetch transactions for a branch, etc.

    public function getTransactions($branch_id) {
        $sql = "SELECT * FROM transactions WHERE branch_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$branch_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
>>>>>>> cb2db00 (Initial commit)
