
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['message'])):
?>
    <!-- <div class="alert alert-success" role="alert">
        <?= $_SESSION['message']; ?>
    </div>
<?php
    unset($_SESSION['message']);
endif;

if (isset($_SESSION['error'])):
?>
    <div class="alert alert-danger" role="alert">
        <?= $_SESSION['error']; ?>
    </div>
<?php
    unset($_SESSION['error']);
endif;
?> -->
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if (!isset($_SESSION['merchant_ext_id']) || !isset($_SESSION['merchant_id'])) {
        header("Location: signup");
        $_SESSION['message'] = '<div class="alert custom-alert alert-danger" role="alert">Session error Sign up or Login again</div>';
        exit;
    }
    }
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
die();

?>

