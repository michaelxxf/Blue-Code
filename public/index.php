<?php
// public/index.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';

// Get the URL path from the request
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remove subfolder prefix if needed (adjust based on your local URL structure)
$subfolder = '/bluecode.ng/public';
if (strpos($request, $subfolder) === 0) {
    $request = substr($request, strlen($subfolder));
}
if ($request === '') {
    $request = '/';
}

switch ($request) {
    case '/':
    case '/home':
        require_once __DIR__ . '/../app/controllers/HomeController.php';
        $controller = new HomeController();
        $controller->index();
        break;
        
    case '/login':
        require_once __DIR__ . '/../app/controllers/AuthController.php';
        $controller = new AuthController($pdo);
        $controller->login();
        break;

    case '/process-login':
        require_once __DIR__ . '/../app/controllers/AuthController.php';
        $controller = new AuthController($pdo);
        $controller->processLogin();
        break;
        
    case '/signup':
        require_once __DIR__ . '/../app/controllers/AuthController.php';
        $controller = new AuthController($pdo);
        $controller->signup();
        break;
        
    case '/process-signup':
        require_once __DIR__ . '/../app/controllers/AuthController.php';
        $controller = new AuthController($pdo);
        $controller->processSignup();
        break;
        
    case '/merchant/signup':
        require_once __DIR__ . '/../app/views/merchant_signup.php';
        break;

    case '/merchant/process-signup':
        require_once __DIR__ . '/../app/controllers/MerchantController.php';
        $controller = new MerchantController();
        $controller->create();
        break;
    
    case '/merchant/dashboard':
        require_once __DIR__ . '/../app/controllers/MerchantController.php';
        $controller = new MerchantController();
        $controller->dashboard();
        break;

    case '/merchant/setting':
        require_once __DIR__ . '/../app/controllers/MerchantSettingController.php';
        $controller = new MerchantSettingController();
        $controller->index();
        break;

    case '/merchant/setting/update':
        require_once __DIR__ . '/../app/controllers/MerchantSettingController.php';
        $controller = new MerchantSettingController();
        $controller->updateSettings();
        break;

    case '/merchant/branch':
        require_once __DIR__ . '/../app/controllers/MerchantSettingController.php';
        $controller = new MerchantSettingController();
        $controller->branch();
        break;

    case '/merchant/process-branch':
        require_once __DIR__ . '/../app/controllers/MerchantBranchController.php';
        $controller = new MerchantBranchController();
        $controller->create();
        break;

    case '/branch/login':
        require_once __DIR__ . '/../app/controllers/BranchController.php';
        $controller = new BranchController();
        $controller->login();
        break;

    case '/branch/process-login':
        require_once __DIR__ . '/../app/controllers/BranchController.php';
        $controller = new BranchController();
        $controller->processLogin();
        break;

    case '/branch/dashboard':
        require_once __DIR__ . '/../app/controllers/BranchController.php';
        $controller = new BranchController();
        $controller->index();
        break;

    case '/maintenance':
        include '..app/views/under-maintenance.html';
        break;

    case '/logout':
        header('Location: /bluecode.ng/app/views/logout.php'); // Redirect to the home page or any other desired page after logouta
        
        break;

    case 'branch/payment':
        require_once __DIR__ . '/../app/controllers/BranchTransactionController.php';
        $controller = new BranchTransactionController();
        $controller->payment();
        
    default:
        http_response_code(404);
        include '../app/views/404.html';
        break;
}
?>
