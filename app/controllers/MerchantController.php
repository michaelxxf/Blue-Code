<<<<<<< HEAD
<?php
// app/controllers/MerchantController.php
require_once __DIR__ . '/../../vendor/autoload.php';

// Load environment variables from config/.env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../config');
$dotenv->load();

require_once __DIR__ . '/../models/Merchant.php';
require_once __DIR__ . '/../models/User.php';
use GuzzleHttp\Client;

class MerchantController {

    // Display the merchant signup form
    public function signup() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        require_once __DIR__ . '/../views/merchant_signup.php';
    }

    // Display the merchant dashboard
    public function dashboard() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        require_once __DIR__ . '/../views/merchant_dashboard.php';
    }

    // Process the merchant signup form submission
    public function create() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Check for temporary signup session variables
        if (!isset($_SESSION['temp_email']) || !isset($_SESSION['temp_password'])) {
            header("Location: /bluecode.ng/public/signup.php");
            exit;
        }
        $merchant_email = $_SESSION['temp_email'];
        $passwordHash = $_SESSION['temp_password'];

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            die("Invalid request method. Please submit the form.");
        }
        
        // Collect merchant data from POST
        $merchant_name  = trim($_POST["Merchant_name"]);
        $mcc            = trim($_POST["mcc"]);  // treated as category_code
        $state          = strtoupper(trim($_POST["state"])); // expecting "ACTIVE", etc.
        $first_name     = trim($_POST["first_name"]);
        $last_name      = trim($_POST["last_name"]);
        $phone          = trim($_POST["phone"]);
        $gender         = strtoupper(trim($_POST["gender"]));
        $street         = trim($_POST["street"]);
        $additional     = trim($_POST["additional"]);
        $zip            = trim($_POST["zip"]);
        $place          = trim($_POST["place"]);  // City
        $country        = trim($_POST["country"]);
        $phone_code     = trim($_POST["code"]);

        // Save merchant name for dashboard
        $_SESSION['merchant_name'] = $merchant_name;

        // Combine phone code with phone number and names for contact details
        $merchant_phone = $phone_code . $phone;
        $contact_name = $last_name . " " . $first_name;
        // Generate a unique external ID for the merchant
        $ext_id = uniqid("MERCH_", true);

        // Set default values for missing fields
        $type = "INDIVIDUAL";
        $registration_number = "";
        $vat_number = "";
        $group_id = "1231";  // Default group id
        $meta = ["contract_id" => "", "product" => "bluescan app"];
        $loyalty_in_callback = true;
        $bluecode_listing_id = "";
        
        // Default Transaction Settings
        $transaction_settings = [
            "booking_reference_prefix" => "Thanks for shopping with " . $merchant_name,
            "default_source" => "APP",
            "bluecode" => ["member_id" => "NGA0000187"],
            "instant" => [
                "networks" => ["RT1"],
                "beneficiary_reference" => "Account Reference",
                "beneficiary_name" => $merchant_name
            ],
            "alipay" => ["partner_id" => "", "attribute_mapping" => "MERCHANT_MERCHANT"],
            "monni" => ["member_id" => ""],
            "wechat" => (object)[]
        ];
        
        // Default Settlement Settings
        $settlement = [
            "ultimo_split"   => true,
            "period"         => "WEEKLY",
            "iban"           => "",
            "delay"          => 1,
            "bic"            => "",
            "account_holder" => $merchant_name
        ];
        
        // Default Billing Settings
        $billing = [
            "period"         => "MONTHLY",
            "mandate_id"     => "",
            "is_active"      => false,
            "iban"           => $settlement["iban"],
            "delay"          => 2,
            "bic"            => $settlement["bic"],
            "account_holder" => $merchant_name
        ];
        
        // Build the API payload for Bluecode
        $apiMerchantData = [
            "name" => $merchant_name,
            "type" => $type,
            "registration_number" => $registration_number,
            "vat_number" => $vat_number,
            "category_code" => $mcc,
            "address" => [
                "line_1" => $street,
                "line_2" => $additional,
                "city" => $place,
                "country" => $country,
                "zip" => $zip
            ],
            "contact" => [
                "name" => $contact_name,
                "emails" => [$merchant_email],
                "phone" => $merchant_phone,
                "gender" => $gender
            ],
            "state" => $state,
            "group_id" => $group_id,
            "ext_id" => $ext_id,
            "transaction_settings" => $transaction_settings,
            "fees" => (object)[], // Empty object
            "settlement" => $settlement,
            "billing" => $billing,
            "loyalty_in_callback" => $loyalty_in_callback,
            "meta" => $meta,
            "bluecode_listing_id" => $bluecode_listing_id
        ];

        // Build the payload for the local database
        $dbMerchantData = [
            'ext_id'                 => $ext_id,
            'merchant_name'          => $merchant_name,
            'category_code'          => $mcc,
            'vat_number'             => $vat_number,
            'registration_number'    => $registration_number,
            'group_id'               => $group_id,
            'email'                  => $merchant_email,
            'phone'                  => $merchant_phone,
            'address_addition_info'  => $additional,
            'access_id'              => '',
            'access_secret_key'      => '',
            'address_line1'          => $street,
            'address_line2'          => $additional,
            'address_zip'            => $zip,
            'address_country'        => $country,
            'address_city'           => $place,
            'contact_name'           => $contact_name,
            'contact_email'          => $merchant_email,
            'contact_phone'          => $merchant_phone,
            'contact_gender'         => $gender,
            'phone_code'             => $phone_code,
            'transaction_settings'   => json_encode($transaction_settings),
            'fees'                   => json_encode((object)[]), // Empty JSON object
            'billing'                => json_encode($billing),
            'state'                  => $state
        ];

        // Build the payload for the users table
        $dbUserData = [
            'email'         => $merchant_email,
            'password_hash' => $passwordHash,
            'ext_id'        => $ext_id
        ];
        
        // Send merchant data to Bluecode API
        $apiUrl = $_ENV['BLUECODE_AQUIBASE_DOMAIN'] . "v2/merchants";
        $apiUsername = $_ENV['BLUECODE_AQUIBASE_API_USER'];
        $apiPassword = $_ENV['BLUECODE_AQUIBASE_API_KEY'];
        
        $client = new Client();
        try {
            $response = $client->post($apiUrl, [
                'json' => ["merchant" => $apiMerchantData],
                'auth' => [$apiUsername, $apiPassword],
                'headers' => [
                    'Accept'       => 'application/json',
                    'Content-Type' => 'application/json'
                ]
            ]);
  
            $apiResponse = json_decode($response->getBody(), true);
  
            // Check if API returned access credentials
            if (!isset($apiResponse["data"]["access_id"]) || !isset($apiResponse["data"]["access_secret_key"])) {
                $_SESSION['message'] = '<div class="alert custom-alert alert-danger">Error: API did not return access credentials. ' . json_encode($apiResponse) . '</div>';
                header("Location: /bluecode.ng/public/signup.php");
                exit;
            }
  
            $dbMerchantData['access_id'] = $apiResponse["data"]["access_id"];
            $dbMerchantData['access_secret_key'] = $apiResponse["data"]["access_secret_key"];
  
            // Optionally, save the API response to the acquibaseApi table
            require_once __DIR__ . '/../models/AcquibaseApi.php';
            $acquibaseApiModel = new AcquibaseApi();
            $acquibaseApiModel->save($apiResponse["data"]);
  
        } catch (Exception $e) {
            $_SESSION['message'] = '<div class="alert custom-alert alert-danger">API Error: ' . $e->getMessage() . '</div>';
            header("Location: /bluecode.ng/public/signup.php");
            exit;
        }
        
        // Save merchant record in the local database
        require_once __DIR__ . '/../models/Merchant.php';
        $merchantModel = new Merchant();
        $result1 = $merchantModel->save($dbMerchantData);
  
        // Save user record in the local database
        require_once __DIR__ . '/../models/User.php';
        $userModel = new User();
        $result2 = $userModel->save($dbUserData);
  
        // Clear temporary session data from signup
        unset($_SESSION['temp_email'], $_SESSION['temp_password']);
        
        if ($result1 && $result2) {
            $_SESSION['message'] = '<div class="alert custom-alert alert-success">Merchant registered successfully!</div>';
            header("Location: ../login");
            exit;
        } else {
            $_SESSION['message'] = '<div class="alert custom-alert alert-danger">Error registering merchant in the database.</div>';
            header("Location: /bluecode.ng/public/signup.php");
            exit;
        }
    }
}
?>
=======
<?php
// app/controllers/MerchantController.php
require_once __DIR__ . '/../../vendor/autoload.php';

// Load environment variables from config/.env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../config');
$dotenv->load();

require_once __DIR__ . '/../models/Merchant.php';
require_once __DIR__ . '/../models/User.php';
use GuzzleHttp\Client;

class MerchantController {

    // Display the merchant signup form
    public function signup() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        require_once __DIR__ . '/../views/merchant_signup.php';
    }

    // Display the merchant dashboard
    public function dashboard() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        require_once __DIR__ . '/../views/merchant_dashboard.php';
    }

    // Process the merchant signup form submission
    public function create() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Check for temporary signup session variables
        if (!isset($_SESSION['temp_email']) || !isset($_SESSION['temp_password'])) {
            header("Location: /bluecode.ng/public/signup.php");
            exit;
        }
        $merchant_email = $_SESSION['temp_email'];
        $passwordHash = $_SESSION['temp_password'];

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            die("Invalid request method. Please submit the form.");
        }
        
        // Collect merchant data from POST
        $merchant_name  = trim($_POST["Merchant_name"]);
        $mcc            = trim($_POST["mcc"]);  // treated as category_code
        $state          = strtoupper(trim($_POST["state"])); // expecting "ACTIVE", etc.
        $first_name     = trim($_POST["first_name"]);
        $last_name      = trim($_POST["last_name"]);
        $phone          = trim($_POST["phone"]);
        $gender         = strtoupper(trim($_POST["gender"]));
        $street         = trim($_POST["street"]);
        $additional     = trim($_POST["additional"]);
        $zip            = trim($_POST["zip"]);
        $place          = trim($_POST["place"]);  // City
        $country        = trim($_POST["country"]);
        $phone_code     = trim($_POST["code"]);

        // Save merchant name for dashboard
        $_SESSION['merchant_name'] = $merchant_name;

        // Combine phone code with phone number and names for contact details
        $merchant_phone = $phone_code . $phone;
        $contact_name = $last_name . " " . $first_name;
        // Generate a unique external ID for the merchant
        $ext_id = uniqid("MERCH_", true);

        // Set default values for missing fields
        $type = "INDIVIDUAL";
        $registration_number = "";
        $vat_number = "";
        $group_id = "1231";  // Default group id
        $meta = ["contract_id" => "", "product" => "bluescan app"];
        $loyalty_in_callback = true;
        $bluecode_listing_id = "";
        
        // Default Transaction Settings
        $transaction_settings = [
            "booking_reference_prefix" => "Thanks for shopping with " . $merchant_name,
            "default_source" => "APP",
            "bluecode" => ["member_id" => "NGA0000187"],
            "instant" => [
                "networks" => ["RT1"],
                "beneficiary_reference" => "Account Reference",
                "beneficiary_name" => $merchant_name
            ],
            "alipay" => ["partner_id" => "", "attribute_mapping" => "MERCHANT_MERCHANT"],
            "monni" => ["member_id" => ""],
            "wechat" => (object)[]
        ];
        
        // Default Settlement Settings
        $settlement = [
            "ultimo_split"   => true,
            "period"         => "WEEKLY",
            "iban"           => "",
            "delay"          => 1,
            "bic"            => "",
            "account_holder" => $merchant_name
        ];
        
        // Default Billing Settings
        $billing = [
            "period"         => "MONTHLY",
            "mandate_id"     => "",
            "is_active"      => false,
            "iban"           => $settlement["iban"],
            "delay"          => 2,
            "bic"            => $settlement["bic"],
            "account_holder" => $merchant_name
        ];
        
        // Build the API payload for Bluecode
        $apiMerchantData = [
            "name" => $merchant_name,
            "type" => $type,
            "registration_number" => $registration_number,
            "vat_number" => $vat_number,
            "category_code" => $mcc,
            "address" => [
                "line_1" => $street,
                "line_2" => $additional,
                "city" => $place,
                "country" => $country,
                "zip" => $zip
            ],
            "contact" => [
                "name" => $contact_name,
                "emails" => [$merchant_email],
                "phone" => $merchant_phone,
                "gender" => $gender
            ],
            "state" => $state,
            "group_id" => $group_id,
            "ext_id" => $ext_id,
            "transaction_settings" => $transaction_settings,
            "fees" => (object)[], // Empty object
            "settlement" => $settlement,
            "billing" => $billing,
            "loyalty_in_callback" => $loyalty_in_callback,
            "meta" => $meta,
            "bluecode_listing_id" => $bluecode_listing_id
        ];

        // Build the payload for the local database
        $dbMerchantData = [
            'ext_id'                 => $ext_id,
            'merchant_name'          => $merchant_name,
            'category_code'          => $mcc,
            'vat_number'             => $vat_number,
            'registration_number'    => $registration_number,
            'group_id'               => $group_id,
            'email'                  => $merchant_email,
            'phone'                  => $merchant_phone,
            'address_addition_info'  => $additional,
            'access_id'              => '',
            'access_secret_key'      => '',
            'address_line1'          => $street,
            'address_line2'          => $additional,
            'address_zip'            => $zip,
            'address_country'        => $country,
            'address_city'           => $place,
            'contact_name'           => $contact_name,
            'contact_email'          => $merchant_email,
            'contact_phone'          => $merchant_phone,
            'contact_gender'         => $gender,
            'phone_code'             => $phone_code,
            'transaction_settings'   => json_encode($transaction_settings),
            'fees'                   => json_encode((object)[]), // Empty JSON object
            'billing'                => json_encode($billing),
            'state'                  => $state
        ];

        // Build the payload for the users table
        $dbUserData = [
            'email'         => $merchant_email,
            'password_hash' => $passwordHash,
            'ext_id'        => $ext_id
        ];
        
        // Send merchant data to Bluecode API
        $apiUrl = $_ENV['BLUECODE_AQUIBASE_DOMAIN'] . "v2/merchants";
        $apiUsername = $_ENV['BLUECODE_AQUIBASE_API_USER'];
        $apiPassword = $_ENV['BLUECODE_AQUIBASE_API_KEY'];
        
        $client = new Client();
        try {
            $response = $client->post($apiUrl, [
                'json' => ["merchant" => $apiMerchantData],
                'auth' => [$apiUsername, $apiPassword],
                'headers' => [
                    'Accept'       => 'application/json',
                    'Content-Type' => 'application/json'
                ]
            ]);
  
            $apiResponse = json_decode($response->getBody(), true);
  
            // Check if API returned access credentials
            if (!isset($apiResponse["data"]["access_id"]) || !isset($apiResponse["data"]["access_secret_key"])) {
                $_SESSION['message'] = '<div class="alert custom-alert alert-danger">Error: API did not return access credentials. ' . json_encode($apiResponse) . '</div>';
                header("Location: /bluecode.ng/public/signup.php");
                exit;
            }
  
            $dbMerchantData['access_id'] = $apiResponse["data"]["access_id"];
            $dbMerchantData['access_secret_key'] = $apiResponse["data"]["access_secret_key"];
  
            // Optionally, save the API response to the acquibaseApi table
            require_once __DIR__ . '/../models/AcquibaseApi.php';
            $acquibaseApiModel = new AcquibaseApi();
            $acquibaseApiModel->save($apiResponse["data"]);
  
        } catch (Exception $e) {
            $_SESSION['message'] = '<div class="alert custom-alert alert-danger">API Error: ' . $e->getMessage() . '</div>';
            header("Location: /bluecode.ng/public/signup.php");
            exit;
        }
        
        // Save merchant record in the local database
        require_once __DIR__ . '/../models/Merchant.php';
        $merchantModel = new Merchant();
        $result1 = $merchantModel->save($dbMerchantData);
  
        // Save user record in the local database
        require_once __DIR__ . '/../models/User.php';
        $userModel = new User();
        $result2 = $userModel->save($dbUserData);
  
        // Clear temporary session data from signup
        unset($_SESSION['temp_email'], $_SESSION['temp_password']);
        
        if ($result1 && $result2) {
            $_SESSION['message'] = '<div class="alert custom-alert alert-success">Merchant registered successfully!</div>';
            header("Location: ../login");
            exit;
        } else {
            $_SESSION['message'] = '<div class="alert custom-alert alert-danger">Error registering merchant in the database.</div>';
            header("Location: /bluecode.ng/public/signup.php");
            exit;
        }
    }
}
?>
>>>>>>> cb2db00 (Initial commit)
