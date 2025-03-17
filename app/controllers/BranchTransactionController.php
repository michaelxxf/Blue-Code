<<<<<<< HEAD
<?php
// app/controllers/BranchTransactionController.php
require_once __DIR__ . '/../models/Transaction.php';
require_once __DIR__ . '/../models/Branch.php';
require_once __DIR__ . '/../../vendor/autoload.php';

// Load environment variables from config/.env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../config');
$dotenv->load();
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class BranchTransactionController {

    private $pdo;
    private $transactionModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->transactionModel = new Transaction($pdo);
    }

    /**
     * Generate a QR code for payment and create a transaction via Bluecode API.
     */
    public function payment() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            die("Invalid request method. Please submit the form.");
        }
        // Collect amount and (optionally) barcode data from POST
        $amount = $_POST['amount'];
        $barcode = $_POST['barcode']; // Branch may scan customer barcode or use QR API
        $customer_tip = $_POST['tip']; // Optional tip amount
        $customer_email = $_POST['customer_email']; // Optional to send reciept to customer email

        // Validate amount and barcode
        if (!is_numeric($amount) || $amount <= 0) {
            die("Invalid amount. Please enter a valid amount.");
        }
        if (empty($barcode)) {
            die("Barcode is required. Please scan the customer's barcode.");
        }

        // Get branch ext_id from session
        $branchExtId = $_SESSION['branch_id']; // This is set when the branch logs in

        // Generate a unique merchant transaction ID
        $merchantTxId = uniqid("tx_", true);

        // Build Bluecode API payload for payment
        $apiPayload = [
            "branch_ext_id"      => $branchExtId,
            "merchant_tx_id"     => $merchantTxId,
            "scheme"             => "AUTO",
            "barcode"            => $barcode,
            "total_amount"       => $amount,
            "requested_amount"   => $amount,
            "consumer_tip_amount"=> 0,
            "currency"           => "NGN",
            "slip"               => "Payment received"
        ];

        $client = new Client();
        $apiUrl = $_ENV['BLUECODE_MERCHANT_DOMAIN'] . "v4/payment";
        $apiUsername = $_ENV['MERCHANT_ACCESS'];
        $apiPassword = $_ENV['MERCHANT_SECRET'];

        try {
            $response = $client->post($apiUrl, [
                'json'    => ["payment" => $apiPayload],
                'auth'    => [$apiUsername, $apiPassword],
                'headers' => [
                    'Accept'       => 'application/json',
                    'Content-Type' => 'application/json'
                ]
            ]);

            $apiResponse = json_decode($response->getBody(), true);

            if ($response->getStatusCode() == 200 || $response->getStatusCode() == 201) {
                // Optionally, capture the acquirer transaction ID from the API response:
                $acquirerTxId = isset($apiResponse["data"]["acquirer_tx_id"]) ? $apiResponse["data"]["acquirer_tx_id"] : null;

                // Save the transaction in the local database
                $transactionData = [
                    "branch_id"       => $branchExtId,
                    "merchant_tx_id"  => $merchantTxId,
                    "acquirer_tx_id"  => $acquirerTxId,
                    "amount"          => $amount,
                    "currency"        => "NGN",
                    "status"          => "REGISTERED" // or other status as per API response
                ];
                $this->transactionModel->save($transactionData);

                $_SESSION['message'] = "Payment transaction created successfully.";
                header("Location: /branch/dashboard");
                exit;
            } else {
                $_SESSION['error'] = "Payment API error: " . $apiResponse['message'];
                header("Location: /branch/dashboard");
                exit;
            }
        } catch (RequestException $e) {
            $errorMessage = $e->hasResponse() 
                ? $e->getResponse()->getBody()->getContents() 
                : $e->getMessage();
            $_SESSION['error'] = "Payment API Request error: " . $errorMessage;
            header("Location: /branch/dashboard");
            exit;
        }
    }

    /**
     * Check transaction status using merchant_tx_id.
     */
    public function status() {
        session_start();
        $merchantTxId = $_POST['merchant_tx_id'];
        $client = new Client();
        $apiUrl = $_ENV['BLUECODE_MERCHANT_DOMAIN'] . "v4/status/?merchant_tx_id=" . urlencode($merchantTxId);
        $apiUsername = $_ENV['MERCHANT_ACCESS'];
        $apiPassword = $_ENV['MERCHANT_SECRET'];
        try {
            $response = $client->post($apiUrl, [
                'auth'    => [$apiUsername, $apiPassword],
                'headers' => [
                    'Accept'       => 'application/json',
                    'Content-Type' => 'application/json'
                ]
            ]);
            $apiResponse = json_decode($response->getBody(), true);
            $_SESSION['message'] = "Transaction status: " . json_encode($apiResponse);
            header("Location: /branch/dashboard");
            exit;
        } catch (RequestException $e) {
            $errorMessage = $e->hasResponse() 
                ? $e->getResponse()->getBody()->getContents() 
                : $e->getMessage();
            $_SESSION['error'] = "Status API error: " . $errorMessage;
            header("Location: /branch/dashboard");
            exit;
        }
    }

    /**
     * Cancel a transaction.
     */
    public function cancel() {
        session_start();
        $merchantTxId = $_POST['merchant_tx_id'];
        $client = new Client();
        $apiUrl = $_ENV['BLUECODE_MERCHANT_DOMAIN'] . "v4/cancel/?merchant_tx_id=" . urlencode($merchantTxId);
        $apiUsername = $_ENV['MERCHANT_ACCESS'];
        $apiPassword = $_ENV['MERCHANT_SECRET'];
        try {
            $response = $client->post($apiUrl, [
                'auth'    => [$apiUsername, $apiPassword],
                'headers' => [
                    'Accept'       => 'application/json',
                    'Content-Type' => 'application/json'
                ]
            ]);
            $_SESSION['message'] = "Transaction canceled successfully.";
            header("Location: /branch/dashboard");
            exit;
        } catch (RequestException $e) {
            $errorMessage = $e->hasResponse() 
                ? $e->getResponse()->getBody()->getContents() 
                : $e->getMessage();
            $_SESSION['error'] = "Cancel API error: " . $errorMessage;
            header("Location: /branch/dashboard");
            exit;
        }
    }

    /**
     * Process a refund for a transaction.
     */
    public function refund() {
        session_start();
        $merchantTxId = $_POST['merchant_tx_id'];
        $client = new Client();
        // Adjust endpoint if Bluecode has a refund endpoint
        $apiUrl = $_ENV['BLUECODE_MERCHANT_DOMAIN'] . "v4/refund";
        $apiUsername = $_ENV['MERCHANT_ACCESS'];
        $apiPassword = $_ENV['MERCHANT_SECRET'];
        $apiPayload = [
            "merchant_tx_id" => $merchantTxId,
            // Add any additional refund parameters as per API documentation
        ];
        try {
            $response = $client->post($apiUrl, [
                'json'    => ["refund" => $apiPayload],
                'auth'    => [$apiUsername, $apiPassword],
                'headers' => [
                    'Accept'       => 'application/json',
                    'Content-Type' => 'application/json'
                ]
            ]);
            $_SESSION['message'] = "Refund processed successfully.";
            header("Location: /branch/dashboard");
            exit;
        } catch (RequestException $e) {
            $errorMessage = $e->hasResponse() 
                ? $e->getResponse()->getBody()->getContents() 
                : $e->getMessage();
            $_SESSION['error'] = "Refund API error: " . $errorMessage;
            header("Location: /branch/dashboard");
            exit;
        }
    }

    // Additional methods for other branch-specific actions can be added here.
}
?>
=======
<?php
// app/controllers/BranchTransactionController.php
require_once __DIR__ . '/../models/Transaction.php';
require_once __DIR__ . '/../models/Branch.php';
require_once __DIR__ . '/../../vendor/autoload.php';

// Load environment variables from config/.env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../config');
$dotenv->load();
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class BranchTransactionController {

    private $pdo;
    private $transactionModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->transactionModel = new Transaction($pdo);
    }

    /**
     * Generate a QR code for payment and create a transaction via Bluecode API.
     */
    public function payment() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            die("Invalid request method. Please submit the form.");
        }
        // Collect amount and (optionally) barcode data from POST
        $amount = $_POST['amount'];
        $barcode = $_POST['barcode']; // Branch may scan customer barcode or use QR API
        $customer_tip = $_POST['tip']; // Optional tip amount
        $customer_email = $_POST['customer_email']; // Optional to send reciept to customer email

        // Validate amount and barcode
        if (!is_numeric($amount) || $amount <= 0) {
            die("Invalid amount. Please enter a valid amount.");
        }
        if (empty($barcode)) {
            die("Barcode is required. Please scan the customer's barcode.");
        }

        // Get branch ext_id from session
        $branchExtId = $_SESSION['branch_id']; // This is set when the branch logs in

        // Generate a unique merchant transaction ID
        $merchantTxId = uniqid("tx_", true);

        // Build Bluecode API payload for payment
        $apiPayload = [
            "branch_ext_id"      => $branchExtId,
            "merchant_tx_id"     => $merchantTxId,
            "scheme"             => "AUTO",
            "barcode"            => $barcode,
            "total_amount"       => $amount,
            "requested_amount"   => $amount,
            "consumer_tip_amount"=> 0,
            "currency"           => "NGN",
            "slip"               => "Payment received"
        ];

        $client = new Client();
        $apiUrl = $_ENV['BLUECODE_MERCHANT_DOMAIN'] . "v4/payment";
        $apiUsername = $_ENV['MERCHANT_ACCESS'];
        $apiPassword = $_ENV['MERCHANT_SECRET'];

        try {
            $response = $client->post($apiUrl, [
                'json'    => ["payment" => $apiPayload],
                'auth'    => [$apiUsername, $apiPassword],
                'headers' => [
                    'Accept'       => 'application/json',
                    'Content-Type' => 'application/json'
                ]
            ]);

            $apiResponse = json_decode($response->getBody(), true);

            if ($response->getStatusCode() == 200 || $response->getStatusCode() == 201) {
                // Optionally, capture the acquirer transaction ID from the API response:
                $acquirerTxId = isset($apiResponse["data"]["acquirer_tx_id"]) ? $apiResponse["data"]["acquirer_tx_id"] : null;

                // Save the transaction in the local database
                $transactionData = [
                    "branch_id"       => $branchExtId,
                    "merchant_tx_id"  => $merchantTxId,
                    "acquirer_tx_id"  => $acquirerTxId,
                    "amount"          => $amount,
                    "currency"        => "NGN",
                    "status"          => "REGISTERED" // or other status as per API response
                ];
                $this->transactionModel->save($transactionData);

                $_SESSION['message'] = "Payment transaction created successfully.";
                header("Location: /branch/dashboard");
                exit;
            } else {
                $_SESSION['error'] = "Payment API error: " . $apiResponse['message'];
                header("Location: /branch/dashboard");
                exit;
            }
        } catch (RequestException $e) {
            $errorMessage = $e->hasResponse() 
                ? $e->getResponse()->getBody()->getContents() 
                : $e->getMessage();
            $_SESSION['error'] = "Payment API Request error: " . $errorMessage;
            header("Location: /branch/dashboard");
            exit;
        }
    }

    /**
     * Check transaction status using merchant_tx_id.
     */
    public function status() {
        session_start();
        $merchantTxId = $_POST['merchant_tx_id'];
        $client = new Client();
        $apiUrl = $_ENV['BLUECODE_MERCHANT_DOMAIN'] . "v4/status/?merchant_tx_id=" . urlencode($merchantTxId);
        $apiUsername = $_ENV['MERCHANT_ACCESS'];
        $apiPassword = $_ENV['MERCHANT_SECRET'];
        try {
            $response = $client->post($apiUrl, [
                'auth'    => [$apiUsername, $apiPassword],
                'headers' => [
                    'Accept'       => 'application/json',
                    'Content-Type' => 'application/json'
                ]
            ]);
            $apiResponse = json_decode($response->getBody(), true);
            $_SESSION['message'] = "Transaction status: " . json_encode($apiResponse);
            header("Location: /branch/dashboard");
            exit;
        } catch (RequestException $e) {
            $errorMessage = $e->hasResponse() 
                ? $e->getResponse()->getBody()->getContents() 
                : $e->getMessage();
            $_SESSION['error'] = "Status API error: " . $errorMessage;
            header("Location: /branch/dashboard");
            exit;
        }
    }

    /**
     * Cancel a transaction.
     */
    public function cancel() {
        session_start();
        $merchantTxId = $_POST['merchant_tx_id'];
        $client = new Client();
        $apiUrl = $_ENV['BLUECODE_MERCHANT_DOMAIN'] . "v4/cancel/?merchant_tx_id=" . urlencode($merchantTxId);
        $apiUsername = $_ENV['MERCHANT_ACCESS'];
        $apiPassword = $_ENV['MERCHANT_SECRET'];
        try {
            $response = $client->post($apiUrl, [
                'auth'    => [$apiUsername, $apiPassword],
                'headers' => [
                    'Accept'       => 'application/json',
                    'Content-Type' => 'application/json'
                ]
            ]);
            $_SESSION['message'] = "Transaction canceled successfully.";
            header("Location: /branch/dashboard");
            exit;
        } catch (RequestException $e) {
            $errorMessage = $e->hasResponse() 
                ? $e->getResponse()->getBody()->getContents() 
                : $e->getMessage();
            $_SESSION['error'] = "Cancel API error: " . $errorMessage;
            header("Location: /branch/dashboard");
            exit;
        }
    }

    /**
     * Process a refund for a transaction.
     */
    public function refund() {
        session_start();
        $merchantTxId = $_POST['merchant_tx_id'];
        $client = new Client();
        // Adjust endpoint if Bluecode has a refund endpoint
        $apiUrl = $_ENV['BLUECODE_MERCHANT_DOMAIN'] . "v4/refund";
        $apiUsername = $_ENV['MERCHANT_ACCESS'];
        $apiPassword = $_ENV['MERCHANT_SECRET'];
        $apiPayload = [
            "merchant_tx_id" => $merchantTxId,
            // Add any additional refund parameters as per API documentation
        ];
        try {
            $response = $client->post($apiUrl, [
                'json'    => ["refund" => $apiPayload],
                'auth'    => [$apiUsername, $apiPassword],
                'headers' => [
                    'Accept'       => 'application/json',
                    'Content-Type' => 'application/json'
                ]
            ]);
            $_SESSION['message'] = "Refund processed successfully.";
            header("Location: /branch/dashboard");
            exit;
        } catch (RequestException $e) {
            $errorMessage = $e->hasResponse() 
                ? $e->getResponse()->getBody()->getContents() 
                : $e->getMessage();
            $_SESSION['error'] = "Refund API error: " . $errorMessage;
            header("Location: /branch/dashboard");
            exit;
        }
    }

    // Additional methods for other branch-specific actions can be added here.
}
?>
>>>>>>> cb2db00 (Initial commit)
