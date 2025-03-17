<<<<<<< HEAD
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// app/controllers/MerchantBranchController.php

require_once __DIR__ . '/../models/Branch.php';
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../models/Merchant.php';
require_once __DIR__ . '/../models/User.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;



class BranchController {

    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }


     /**
     * Display the branch login form.
     */
    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        require_once __DIR__ . '/../views/branch_login.php';
    }

    /**
     * Display branch dashboard: list all branches.
     */
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['merchant_id']) || !isset($_SESSION['branch_id'])) {
            require_once __DIR__ . '/../views/branch_login.php';
            exit;
        }
        if (isset($_SESSION['branch_id']) && isset($_SESSION['merchant_id'])) {
            // Get the local merchant ID from session
            $branchExtId = $_SESSION['branch_id'];
            $merchantId = $_SESSION['merchant_id'];
            // Instantiate the Branch model and get branches for this merchant
            $branchModel = new Branch();
            $branches = $branchModel->getById($merchantId);
            
            
            // Include the dashboard view and pass $branches for dynamic display
            require_once __DIR__ . '/../views/branch_dashboard.php';
                exit;
        }

    }

    public function processLogin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // If the user is already logged in, redirect to dashboard.
        if (isset($_SESSION['merchant_id']) && isset($_SESSION['branch_id'])) {
            header("Location: branch/dashboard");
            exit;
        }
    
        // Process the form only on a POST request.
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Ensure the Branch model is included
            require_once __DIR__ . '/../models/Branch.php';
            
            // Initialize the model before using it.
            $branchModel = new Branch();
    
            // Get input values
            $branchName = trim($_POST['branch_name'] ?? '');
            $password   = trim($_POST['branch_password'] ?? '');
    
            // Get branch details by name
            $branch = $branchModel->getByName($branchName);
            if ($branch) {
                if ($password === $branch['branch_password']) {
                    // Successful login: set session variables and redirect.
                    $_SESSION['branch_id'] = $branch['ext_id'];
                    $_SESSION['merchant_id'] = $branch['merchant_id'];
                    header("Location: dashboard");
                    exit;
                } else {
                    // Wrong password
                    $_SESSION['error'] = "Invalid branch credentials";
                    header("Location: login");
                    exit;
                }
            } else {
                // Branch not found
                $_SESSION['error'] = "Branch not found";
                header("Location: login");
                exit;
            }
        } else {
            // For GET requests, show the login page.
            require_once __DIR__ . '/../views/branch_login.php';
            exit;
        }
    }
    

    /**
     * Display branch dashboard (list branches, etc.).
     */
    public function dashboard() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['branch_id'])) {
            header("Location: branch/login");
            exit;
        }
        $branchModel = new Branch();
        $branch = $branchModel->getById($_SESSION['branch_id']);
        require_once __DIR__ . '/../views/branch_dashboard.php';
    }

}

=======
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// app/controllers/MerchantBranchController.php

require_once __DIR__ . '/../models/Branch.php';
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../models/Merchant.php';
require_once __DIR__ . '/../models/User.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;



class BranchController {

    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }


     /**
     * Display the branch login form.
     */
    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        require_once __DIR__ . '/../views/branch_login.php';
    }

    /**
     * Display branch dashboard: list all branches.
     */
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['merchant_id']) || !isset($_SESSION['branch_id'])) {
            require_once __DIR__ . '/../views/branch_login.php';
            exit;
        }
        if (isset($_SESSION['branch_id']) && isset($_SESSION['merchant_id'])) {
            // Get the local merchant ID from session
            $branchExtId = $_SESSION['branch_id'];
            $merchantId = $_SESSION['merchant_id'];
            // Instantiate the Branch model and get branches for this merchant
            $branchModel = new Branch();
            $branches = $branchModel->getById($merchantId);
            
            
            // Include the dashboard view and pass $branches for dynamic display
            require_once __DIR__ . '/../views/branch_dashboard.php';
                exit;
        }

    }

    public function processLogin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // If the user is already logged in, redirect to dashboard.
        if (isset($_SESSION['merchant_id']) && isset($_SESSION['branch_id'])) {
            header("Location: branch/dashboard");
            exit;
        }
    
        // Process the form only on a POST request.
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Ensure the Branch model is included
            require_once __DIR__ . '/../models/Branch.php';
            
            // Initialize the model before using it.
            $branchModel = new Branch();
    
            // Get input values
            $branchName = trim($_POST['branch_name'] ?? '');
            $password   = trim($_POST['branch_password'] ?? '');
    
            // Get branch details by name
            $branch = $branchModel->getByName($branchName);
            if ($branch) {
                if ($password === $branch['branch_password']) {
                    // Successful login: set session variables and redirect.
                    $_SESSION['branch_id'] = $branch['ext_id'];
                    $_SESSION['merchant_id'] = $branch['merchant_id'];
                    header("Location: dashboard");
                    exit;
                } else {
                    // Wrong password
                    $_SESSION['error'] = "Invalid branch credentials";
                    header("Location: login");
                    exit;
                }
            } else {
                // Branch not found
                $_SESSION['error'] = "Branch not found";
                header("Location: login");
                exit;
            }
        } else {
            // For GET requests, show the login page.
            require_once __DIR__ . '/../views/branch_login.php';
            exit;
        }
    }
    

    /**
     * Display branch dashboard (list branches, etc.).
     */
    public function dashboard() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['branch_id'])) {
            header("Location: branch/login");
            exit;
        }
        $branchModel = new Branch();
        $branch = $branchModel->getById($_SESSION['branch_id']);
        require_once __DIR__ . '/../views/branch_dashboard.php';
    }

}

>>>>>>> cb2db00 (Initial commit)
?>