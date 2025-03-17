<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// app/controllers/MerchantBranchController.php

require_once __DIR__ . '/../models/Branch.php';
require_once __DIR__ . '/../models/Merchant.php';
require_once __DIR__ . '/../models/User.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class MerchantBranchController {




    private function generateRandomPassword($length = 10) {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $password = '';
        $maxIndex = strlen($chars) - 1;
        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[random_int(0, $maxIndex)];
        }
        return $password;
    }

    /**
     * Process branch creation: send branch data to Bluecode API and save to local DB.
     */
    public function create() {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            die("Invalid request method.");
        }
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Retrieve merchant external ID (for API) and local merchant ID from session
        $merchantExtId = $_SESSION['merchant_id']; // Set during merchant onboarding
        $merchantId   = $_SESSION['merchant_id'];       // Local DB ID
        $merchantModel = new Merchant(); // Instantiate Merchant model
        $merchant = $merchantModel->getById($_SESSION['merchant_id']);
        $merchantName = $merchant['merchant_name'];

        
        // --- Collect Branch Form Data --- //
        // Basic Branch Details (from first modal)
        $branchName = trim($_POST['branch_name']);
        $bookingRefPrefix = trim($_POST['booking_reference_prefix']);
        $branchState = trim($_POST['state']); // Expected values: "ACTIVE" or "DISABLED"
        $contactPhone = trim($_POST['contact_phone']);
        $contactEmail = trim($_POST['contact_email']);
        $contactGender = isset($_POST['contact_gender']) ? trim($_POST['contact_gender']) : "OTHER";
        
        // Address Details (from second modal)
        $branchAddress = trim($_POST['branch_address']);
        $branchZip = trim($_POST['branch_zip']);
        $branchCity = trim($_POST['branch_city']);
        $branchCountry = trim($_POST['branch_country']); // Must be a 2-letter ISO code
        
        // --- Generate Unique IDs --- //
        $ext_id = uniqid($merchantName, true);
        $merchant_branch_id = $ext_id . "MB"; 

        // --- Generate a 10-character random password for the branch --- //
        $branchPassword = $this->generateRandomPassword(10);

        // Generate a 3-character random string for the branch login ID
        $branchLoginId = $branchName . substr($merchantName, 0, 3) . $this->generateRandomString(3);


        // --- Send the password to the branch's contact email ---
        $subject = "Your Branch Password for {$branchName}";
        $message = "Dear {$merchantName},\n\nWelcome to your new branch {$branchName}! Your branch password is: {$branchPassword}\n\nPlease change it after logging in.\n\n login URL: --- \n\n || Branch Login_id: {$branchLoginId} || \n\n Branch Password: {$branchPassword} ||\n\n Best regards,\nBOW BOW";
        $headers = 'From: miokonkwo023@gmail.com' . "\r\n" .
                    'Reply-To: miokonkwo023@gmail.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
        // Retrieve merchant external ID (for API) and local merchant ID from session
        $merchantExtId = $_SESSION['merchant_id']; // Set during merchant onboarding
        $merchantId   = $_SESSION['merchant_id'];       // Local DB ID
        $merchantModel = new Merchant(); // Instantiate Merchant model        
        $merchant = $merchantModel->getById($_SESSION['merchant_id']);
        $merchantEmail = $merchant;
        
        // --- Build API Payload (as per Bluecode spec) --- //
        $apiPayload = [
            "state" => $branchState,
            "booking_reference_prefix" => $bookingRefPrefix . "-" . $merchantName, // Append merchant name to prefix
            "merchant_branch_id" => $merchant_branch_id,  // Used For payments on the merchant API
            "ext_id" => $ext_id,
            "name" => $branchName,
            "contact" => [
                "name" => $branchName,  // If you have a separate contact name, use it here
                "phone" => $contactPhone,
                "emails" => [$contactEmail],
                "gender" => $contactGender
            ],
            "address" => [
                "city" => $branchCity,
                "zip" => $branchZip,
                "line_1" => $branchAddress,
                "line_2" => "",
                "country" => $branchCountry
            ]
        ];
        
        // --- Call Bluecode API --- //
        $apiUrl = "https://acquibase-api.acq.int.bluecode.ng/v2/merchants/{$merchantExtId}/branches";
        $apiUsername = "fc1f9f72-02c9-47e2-99ea-bc33ba2906d4";
        $apiPassword = "da1616ef-caad-4c7b-b7af-e9b98fb97960";
        $client = new Client();
        
        try {
            $response = $client->post($apiUrl, [
                'json' => [ "branch" => $apiPayload ],
                'auth' => [$apiUsername, $apiPassword],
                'headers' => [
                    'Accept'       => 'application/json',
                    'Content-Type' => 'application/json'
                ]
            ]);
            $apiResponse = json_decode($response->getBody(), true);
            
            if ($response->getStatusCode() == 200 || $response->getStatusCode() == 201) {
                // --- Save Branch to Local DB --- //
                require_once __DIR__ . '/../models/Branch.php';
                $branchModel = new Branch();
                
                $dbData = [
                    "merchant_id" => $merchantId,
                    "ext_id" => $ext_id,
                    "merchant_branch_id" => $merchant_branch_id,
                    "name" => $branchName,
                    "address_city" => $branchCity,
                    "address_line1" => $branchAddress,
                    "address_line2" => "",
                    "Branch_login_id" => $branchLoginId,
                    "Branch_password" => $branchPassword,
                    "address_zip" => $branchZip,
                    "address_country" => $branchCountry,
                    "contact_name" => $branchName,
                    "contact_password" => $branchPassword,
                    "contact_email" => $contactEmail,
                    "contact_phone" => $contactPhone,
                    "contact_gender" => $contactGender,
                    "booking_reference_prefix" => $bookingRefPrefix . "-" . $merchantName,
                    "state" => $branchState,
                    "virtual_terminal" =>"",
                    "inserted_at" => date("Y-m-d H:i:s"),
                    "updated_at" => date("Y-m-d H:i:s")];
                    $saveResult = $branchModel->save($dbData);
                    if ($saveResult) {$_SESSION['message'] = '<div class="alert custom-alert alert-success">Branch created successfully! Branch password has been sent to Branch contact email</div>';
                        // Send email (ensure your server is configured to send email);
                        mail($contactEmail, $subject, $message, $headers);
                        if (mail($contactEmail, $subject, $message, $headers)) {
                            mail(implode(" ", $merchantEmail), $subject, $message, $headers);
                            if (mail(implode("", $merchantEmail), $subject, $message, $headers)) {
                                echo "Password sent successfully to Branch-Email:{$contactEmail} and Merchant-Email:{$merchantEmail}";
                                  
                            }
                            else {
                                echo "Failed to send password to {$merchantEmail} Check {$contactEmail} for password";
                            }
                        } else {
                            echo "Failed to send password to {$contactEmail}";
                            echo "Failed to send password : {$branchPassword} to Branch contact email {$contactEmail} </div>";


                        }
                    } else {$_SESSION['message'] = '<div class="alert custom-alert alert-danger">Error saving branch locally.</div>';
                        exit;
                    }
                } else {
                    throw new Exception("API Error: " . json_encode($apiResponse));
                }
            } catch (RequestException $e) {
                $errorMessage = $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : $e->getMessage();
                $_SESSION['message'] = '<div class="alert custom-alert alert-danger">API Error: ' . $errorMessage . '</div>';
                exit;
                }
                header('Location: setting');
                exit; 
            }
        }
?>