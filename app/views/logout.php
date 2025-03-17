<<<<<<< HEAD
<?php
session_start();

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Expire all cookies (Loop through all cookies and delete them)
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode('; ', $_SERVER['HTTP_COOKIE']);
    foreach ($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time() - 3600, '/'); // Expire the cookie
        setcookie($name, '', time() - 3600, '/', $_SERVER['HTTP_HOST']); // Expire on specific domain
    }
}

// Redirect to login page or homepage
header("Location: login.php"); // Change this to your preferred logout redirection page
exit;
=======
<?php
session_start();

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Expire all cookies (Loop through all cookies and delete them)
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode('; ', $_SERVER['HTTP_COOKIE']);
    foreach ($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time() - 3600, '/'); // Expire the cookie
        setcookie($name, '', time() - 3600, '/', $_SERVER['HTTP_HOST']); // Expire on specific domain
    }
}

// Redirect to login page or homepage
header("Location: login.php"); // Change this to your preferred logout redirection page
exit;
>>>>>>> cb2db00 (Initial commit)
?>