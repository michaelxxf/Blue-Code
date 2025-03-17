<<<<<<< HEAD
<?php
// Controller Method:
// Create a method in your MerchantController.php (or a dedicated TransactionSettingsController.php) that receives the POST data, validates it, and updates the merchant's record in the database.
// Example:
// php
// Copy
// Edit
public function saveTransactionSettings() {
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        die("Invalid request method.");
    }
    // Retrieve and sanitize input data
    $bookingReference = trim($_POST['booking_reference_prefix']);
    $bluecodeMemberId = trim($_POST['bluecode_member_id']);
    $defaultSource    = trim($_POST['default_source']);
    $instantNetworks  = trim($_POST['instant_networks']);
    $beneficiaryName  = trim($_POST['beneficiary_name']);
    $beneficiaryRef   = trim($_POST['beneficiary_reference']);

    // Convert instant networks to JSON (assuming comma-separated input)
    $networksArray = array_map('trim', explode(',', $instantNetworks));
    $instantSettings = [
        'networks' => $networksArray,
        'beneficiary_name' => $beneficiaryName,
        'beneficiary_reference' => $beneficiaryRef
    ];

    // Build transaction settings array
    $transactionSettings = [
        'booking_reference_prefix' => $bookingReference,
        'bluecode' => [
            'member_id' => $bluecodeMemberId
        ],
        'default_source' => $defaultSource,
        'instant' => $instantSettings
    ];

    // Save these settings to the merchant's record in the database
    // (Assuming you have a Merchant model with an updateTransactionSettings method)
    $merchant = new Merchant();
    $result = $merchant->updateTransactionSettings($_SESSION['merchant_id'], json_encode($transactionSettings));
    if ($result) {
        $_SESSION['message'] = '<div class="alert custom-alert custom-alert alert-success" role="alert">Transaction settings saved successfully!</div>';
    } else {
        $_SESSION['message'] = '<div class="alert alert-danger" role="alert">Failed to save transaction settings.</div>';
    }
    header("Location: /merchant/dashboard");
    exit;
}



// Model Update:
// In your Merchant.php model, add a method to update the transaction_settings field:
// php
// Copy
// Edit
public function updateTransactionSettings($merchantId, $settingsJson) {
    $sql = "UPDATE merchants SET transaction_settings = ? WHERE ext_id = ?";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([$settingsJson, $merchantId]);
}
// Routing:
// In your routing file (or index.php), add a route that directs requests from /merchant/transaction-settings to your controller method.
// This transaction settings form, along with the controller and model updates, will allow you to capture and store transaction-specific settings from your merchants. Let me know if you need additional details or further integration help!

=======
<?php
// Controller Method:
// Create a method in your MerchantController.php (or a dedicated TransactionSettingsController.php) that receives the POST data, validates it, and updates the merchant's record in the database.
// Example:
// php
// Copy
// Edit
public function saveTransactionSettings() {
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        die("Invalid request method.");
    }
    // Retrieve and sanitize input data
    $bookingReference = trim($_POST['booking_reference_prefix']);
    $bluecodeMemberId = trim($_POST['bluecode_member_id']);
    $defaultSource    = trim($_POST['default_source']);
    $instantNetworks  = trim($_POST['instant_networks']);
    $beneficiaryName  = trim($_POST['beneficiary_name']);
    $beneficiaryRef   = trim($_POST['beneficiary_reference']);

    // Convert instant networks to JSON (assuming comma-separated input)
    $networksArray = array_map('trim', explode(',', $instantNetworks));
    $instantSettings = [
        'networks' => $networksArray,
        'beneficiary_name' => $beneficiaryName,
        'beneficiary_reference' => $beneficiaryRef
    ];

    // Build transaction settings array
    $transactionSettings = [
        'booking_reference_prefix' => $bookingReference,
        'bluecode' => [
            'member_id' => $bluecodeMemberId
        ],
        'default_source' => $defaultSource,
        'instant' => $instantSettings
    ];

    // Save these settings to the merchant's record in the database
    // (Assuming you have a Merchant model with an updateTransactionSettings method)
    $merchant = new Merchant();
    $result = $merchant->updateTransactionSettings($_SESSION['merchant_id'], json_encode($transactionSettings));
    if ($result) {
        $_SESSION['message'] = '<div class="alert custom-alert custom-alert alert-success" role="alert">Transaction settings saved successfully!</div>';
    } else {
        $_SESSION['message'] = '<div class="alert alert-danger" role="alert">Failed to save transaction settings.</div>';
    }
    header("Location: /merchant/dashboard");
    exit;
}



// Model Update:
// In your Merchant.php model, add a method to update the transaction_settings field:
// php
// Copy
// Edit
public function updateTransactionSettings($merchantId, $settingsJson) {
    $sql = "UPDATE merchants SET transaction_settings = ? WHERE ext_id = ?";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([$settingsJson, $merchantId]);
}
// Routing:
// In your routing file (or index.php), add a route that directs requests from /merchant/transaction-settings to your controller method.
// This transaction settings form, along with the controller and model updates, will allow you to capture and store transaction-specific settings from your merchants. Let me know if you need additional details or further integration help!

>>>>>>> cb2db00 (Initial commit)
?>