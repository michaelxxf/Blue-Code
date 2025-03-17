<?php
// app/Models/Merchant.php
require_once __DIR__ . '/../../config/config.php'; // This sets up $pdo


class Merchant {
    private $pdo;

    public function __construct() {
        global $pdo; // Access the PDO instance from config
        $this->pdo = $pdo;
    }

    /**
     * Save merchant data to the database.
     *
     * Expects $data to be an associative array with keys:
     * ext_id, merchant_name, category_code, vat_number, registration_number, group_id,
     * merchant_email, phone, address_addition_info, address_line1, address_line2, address_zip,
     * address_country, address_city, contact_name, contact_email, contact_phone,
     * contact_gender, phone_code, transaction_settings, fees, billing, state.
     */
    public function save($data) {       //Save to users Table as well
        $sql = "INSERT INTO merchants 
                (ext_id, registration_number, group_id, vat_number, merchant_name, category_code, access_id, access_secret_key, address_addition_info, address_line1, address_line2, address_zip, address_country, contact_name, contact_email, contact_phone, contact_gender, transaction_settings, fees, billing, state) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([

            $data['ext_id'],
            $data['registration_number'],
            $data['group_id'],
            $data['vat_number'],
            $data['merchant_name'],
            $data['category_code'],
            $data['access_id'],
            $data['access_secret_key'],
            $data['address_addition_info'],
            $data['address_line1'],
            $data['address_line2'],
            $data['address_zip'],
            $data['address_country'],
            $data['contact_name'],
            $data['contact_email'],
            $data['contact_phone'],
            $data['contact_gender'],
            $data['transaction_settings'],
            $data['fees'],
            $data['billing'],
            $data['state']
        ]);


        $_SESSION['merchant_id'] = $dbMerchantData['ext_id']; // Set the merchant ID in the session
    }

   
    public function updateMerchantSettings($merchantId, $data) {
        // Adjust the SQL statement to update only the fields you need.
        $sql = "UPDATE merchants SET 
                    contact_name = ?,
                    contact_gender = ?,
                    contact_email = ?,
                    contact_phone = ?,
                    merchant_logo = ?,
                    merchant_name = ?,
                    category_code = ?,
                    registration_number = ?,
                    vat_number = ?,
                    address_line1 = ?,
                    address_zip = ?,
                    address_country = ?
                WHERE ext_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['contact_name'],
            $data['contact_gender'],
            $data['merchant_email'],
            $data['contact_phone'],
            $data['merchant_logo'],
            $data['merchant_name'],
            $data['category_code'],
            $data['registration_number'],
            $data['vat_number'],
            $data['address_line1'],
            $data['address_zip'],
            $data['address_country'],
            $merchantId
        ]);

        // If merchant_email == your_email

        try {
            $stmt = $pdo->prepare("INSERT INTO users (email, password_hash) VALUES (?, ?)");
            $stmt->execute([$email, $password_hash]);

            // Store the user session
            $_SESSION['user_email'] = $email;
            $_SESSION['message'] = '<div class="alertcustom-alert  alert-success" role="alert">Information Saved!</div>';
            header("Location: merchant/signup");
            

        } catch (PDOException $e) {
            // Handle the error
            $_SESSION['message'] = '<div class="alert custom-alert alert-danger" role="alert">Error: ' . $e->getMessage() . '</div>';
        }
    }

    public function updateIsNew($merchantId, $isNew) {
        $sql = "UPDATE merchants SET is_new = ? WHERE ext_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$isNew, $merchantId]);
    }
    
    public function getById($merchantId) {
        $sql = "SELECT * FROM merchants WHERE ext_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$merchantId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}



?>

