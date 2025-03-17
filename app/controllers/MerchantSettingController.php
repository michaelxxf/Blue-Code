<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
    die();
    }

?>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// In your settings update controller (e.g., app/controllers/SettingsController.php)
require_once __DIR__ . '/../../vendor/autoload.php';

// Load environment variables from config/.env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../config');
$dotenv->load();

require_once __DIR__ . '/../models/Merchant.php';
require_once __DIR__ . '/../models/User.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


// Get merchant ID from session (assumed to be set on login/onboarding)
$merchantExtId = $_SESSION['merchant_id'];



class MerchantSettingController {


    // Display the merchant-branch page
    public function branch() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
    }
    require_once __DIR__ . '/../views/merchant_branch.php';
}




    // Display the merchant-settings page
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
            $merchantExtId = $_SESSION['merchant_id'];
        }
        $merchantExtId = $_SESSION['merchant_id'];
        require_once __DIR__ . '/../views/merchant_settings.php';
    }
        
    // Process the settings form submission (including two file uploads)
    public function updateSettings() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Ensure the request method is POST
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            die("Invalid request method.");
        }
        
        // Start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        };
        
        // Get merchant ID from session (assumed to be set on login/onboarding)
        $merchantExtId = $_SESSION['merchant_id'];
        
        // Define upload directory (adjust path as needed)
        $uploadDir = __DIR__ . '/../../public/uploads/merchant/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 7777, true);
        }
        
        // --- Process File Uploads ---
        // 1. User profile picture (field name: merchant_logo)
        $userPicPath = '';
        if (isset($_FILES['merchant_logo']) && $_FILES['merchant_logo']['error'] === UPLOAD_ERR_OK) {
            $tmpPath = $_FILES['merchant_logo']['tmp_name'];
            $origName = $_FILES['merchant_logo']['name'];
            $extension = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array($extension, $allowed)) {
                $newFileName = 'merchant_logo_' . $merchantExtId . '.' . $extension;
                $destPath = $uploadDir . $newFileName;
                if (move_uploaded_file($tmpPath, $destPath)) {
                    // Save relative path (adjust if needed)
                    $userPicPath = '/uploads/merchant/' . $newFileName;
                }
            }
        }
        
        
        // --- Collect Text/Select Fields from the Form ---
        // User details
        $firstName   = trim($_POST['firstName']);
        $lastName    = trim($_POST['lastName']);
        $merchantEmail       = trim($_POST['email']);
        $gender      = trim($_POST['gender']);
        $phoneNumber = trim($_POST['phoneNumber']);
        $position    = trim($_POST['position']);
        $phoneCode   = trim($_POST['code']);  // e.g., country dialing code
        
        // Combine phone code and number for user
        $userPhone = $phoneCode . $phoneNumber;

        // Combine first_name and last_name for user
        $userName = $firstName . ' ' . $lastName;
        
        // Merchant details
        $merchantCompany = trim($_POST['merchantCompany']);
        $mcc             = trim($_POST['mcc']);
        $merType         = trim($_POST['mer_type']);
        $merRegNo        = trim($_POST['mer_reg_no']);
        $vatNo           = trim($_POST['vatNo']);
        $merAddress      = trim($_POST['mer_address']);
        $merCity         = trim($_POST['mer_city']);
        $merZip          = trim($_POST['mer_zip']);
        $merCountry      = trim($_POST['mer_country']);
        
        // --- Build Data Array to Update Merchant Settings ---
        // The keys here should match the column names in your merchants table.
        $updateData = [
            // User details
            'contact_name'      => $userName,
            'contact_gender'          => $gender,
            'contact_phone'           => $userPhone,
            'merchant_logo'        => $userPicPath,
            // Merchant details
            'merchant_name'   => $merchantCompany,
            'merchant_email'  => $merchantEmail,
            'category_code'   => $mcc,
            'registration_number' => $merRegNo,
            'vat_number'      => $vatNo,
            'address_line1'     => $merAddress,
            'address_addition_info'        => $merCity,
            'address_zip'         => $merZip,
            'address_country'     => $merCountry,
            'merchant_logo'   => $userPicPath
        ];

        // Build the API payload as expected by Bluecode:
        $apiMerchantData = [
            "name" => $merchantCompany,
            "type" => $merType,
            "registration_number" => $merRegNo,
            "vat_number" => $vatNo,
            "category_code" => $mcc,
            "address" => [
                "line_1" => $merAddress,
                "city" => $merCity,
                "country" => $merCountry,
                "zip" => $merZip
            ],
            "contact" => [
                "name" => $userName,
                "emails" => [$merchantEmail],
                "phone" => $userPhone,
                "gender" => $gender
            ],
        ];



        // Send merchant data to Bluecode API (Aquibase)
        $apiUrl = $_ENV['BLUECODE_AQUIBASE_DOMAIN'] . "v2/merchants/" . $merchantExtId;
        $apiUsername = $_ENV['BLUECODE_AQUIBASE_API_USER'];
        $apiPassword = $_ENV['BLUECODE_AQUIBASE_API_KEY'];
        
        $client = new Client();
        try {
            $response = $client->put($apiUrl, [
                'json' => ["merchant" => $apiMerchantData],
                'auth' => [$apiUsername, $apiPassword],
                'headers' => [
                    'Accept'       => 'application/json',
                    'Content-Type' => 'application/json'
                ]
            ]);
            // Decode response
            $apiResponse = json_decode($response->getBody(), true);
            // Check API Response
            if ($response->getStatusCode() == 200) {
                // Update Merchant Settings in Database
                $merchantModel = new Merchant();
                $result = $merchantModel->updateMerchantSettings($merchantExtId, $updateData);
                // Update User Settings in Database
                $userModel = new User();
                $result = $userModel->updateUserSettings($merchantExtId, $updateData);
                
                // Mark merchant as no longer new
                $merchantModel->updateIsNew($merchantExtId, false);
                
                if ($result) {
                    $_SESSION['message'] = '<div class="alert custom-alert alert-success">Settings updated successfully!</div>';
                    header("Location: ../dashboard");
                    exit;
                } else {
                    $_SESSION['message'] = '<div class="alert custom-alert alert-danger">Error updating settings.</div>';
                    exit;
                        }
            }else {
                $_SESSION['message'] = '<div class="alert custom-alert alert-danger">Error updating merchant settings. API Error: ' . $apiResponse['message'] . '</div>';
                exit;
            }
        } catch (RequestException $e) {
            // Handle API errors
            $errorMessage = $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : $e->getMessage();
            $_SESSION['message'] = '<div class="alert custom-alert alert-danger">API Error: ' . $errorMessage . '</div>';
            exit;
        }
    }
}

?>