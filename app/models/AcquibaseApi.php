<?php
// app/models/AcquibaseApi.php

require_once __DIR__ . '/../../config/config.php'; // Loads $pdo

class AcquibaseApi {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    /**
     * Save the API response data to the acquibaseApi table.
     *
     * Expects $data to be an associative array matching the API response "data" structure.
     */
    public function save($data) {
        $sql = "INSERT INTO acquibaseApi 
                (ext_id, name, category_code, type, registration_number, vat_number, meta, transaction_settings, settlement, fees, billing, contact, address, access_id, access_secret_key, state, inserted_at, updated_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['ext_id'] ?? '',
            $data['name'] ?? '',
            $data['category_code'] ?? '',
            $data['type'] ?? '',
            $data['registration_number'] ?? '',
            $data['vat_number'] ?? '',
            isset($data['meta']) ? json_encode($data['meta']) : '{}',
            isset($data['transaction_settings']) ? json_encode($data['transaction_settings']) : '{}',
            isset($data['settlement']) ? json_encode($data['settlement']) : '{}',
            isset($data['fees']) ? json_encode($data['fees']) : '{}',
            isset($data['billing']) ? json_encode($data['billing']) : '{}',
            isset($data['contact']) ? json_encode($data['contact']) : '{}',
            isset($data['address']) ? json_encode($data['address']) : '{}',
            $data['access_id'] ?? '',
            $data['access_secret_key'] ?? '',
            $data['state'] ?? '',
            $data['inserted_at'] ?? date("Y-m-d H:i:s"),
            $data['updated_at'] ?? date("Y-m-d H:i:s")
        ]);
    }
}
?>
