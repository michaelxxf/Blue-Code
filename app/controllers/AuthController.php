<?php
// app/controllers/AuthController.php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../models/Merchant.php';
require_once __DIR__ . '/../models/User.php';

class AuthController {

    private $pdo;

    public function __construct($pdo) {
        global $pdo; // Access the PDO instance from config
        $this->pdo = $pdo;
    }

    // Display the login view
    public function login() {

        require_once __DIR__ . '../../views/login.php';
    }

    // Process the login form submission
    public function processLogin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
          }
          
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = trim($_POST['merchant_email']);
            $password = $_POST['password'];
        
            // Check the users table for email
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verify pass and go to merchant dashboard else
            if ($user && password_verify($password, $user['password_hash'])) {
                // Set user session variable
                $_SESSION['merchant_id'] = $user['ext_id'];
                $_SESSION['merchant_ext_id'] = $merchant['ext_id']; // For API use
            
                // Check the merchant table and compare ext_id with user table
                $stmt = $this->pdo->prepare("SELECT * FROM merchants WHERE ext_id = ?");
                $stmt->execute([$user['ext_id']]);
                $merchant = $stmt->fetch(PDO::FETCH_ASSOC);
            
                if ($merchant) {
                    // Set merchant-specific session variables
                    $_SESSION['merchant_id'] = $merchant['ext_id'];
                    $_SESSION['merchant_ext_id'] = $merchant['ext_id']; // For API use                  
                    header("Location: merchant/dashboard");
                    exit;

                }else {
                    if(isset($_SESSION['message'])) {
                    $_SESSION['message'] = '<div class="alert custom-alert alert-danger alert-dismissible" role="alert">User exists but not registered as a merchant.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    require_once __DIR__ . '../../views/merchant_signup.php';
                    }
                       }
            }else {
                $_SESSION['error'] = '<div class="alert custom-alert alert-danger alert-dismissible" role="alert">Invalid email or password.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                header("Location: login");
                exit;
            }
        }
    }
    
    //Display the signup view
    public function signup() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        require_once __DIR__ . '../../views/signup.php';
    }

    // Process the signup form submission by storing in a session and going to merchant signup
    public function processSignup() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Get email and password from signup form
            $email = trim($_POST['merchant_email']);
            $password = trim($_POST['pass']); 
            $repeat_password = trim($_POST['re_pass'] ?? '');
    
            // Check if passwords match
            if ($password !== $repeat_password) {
                $_SESSION['message'] = '<div class="alert custom-alert alert-danger" role="alert">Passwords do not match!</div>';
                header("Location: signup");
                exit;
            }
    
            // Hash the password
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            
            // Store email and hashed password in session
            $_SESSION['temp_email'] = $email;
            $_SESSION['temp_password'] = $password_hash;
            
            // Redirect to merchant onboarding page
            require_once __DIR__ . '/../views/merchant_Signup.php';
            exit;
        }
    }
    

}

?>
