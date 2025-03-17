

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['message'])):
?>
    <div class="alert alert-success" role="alert">
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
?>


<?php

// Include your Merchant model (adjust the path if needed)
require_once __DIR__ . '../../../models/Merchant.php';

// Retrieve the merchant record from the database using the merchant_id stored in session
if (isset($_SESSION['merchant_id'])) {
  $merchantModel = new Merchant();
  $merchant = $merchantModel->getById($_SESSION['merchant_id']);
  
}
?>


<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <base href="/bluecode.ng/public/">

    <title>merchant | Dashboard</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="mer-dash/assets/img/favicon/#" />    <!-- Remember to add for production -->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
    integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
      integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
      crossorigin="anonymous"></script>

      <!-- Bootstrap icon-->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

      <!-- Icons. Uncomment required icon fonts -->
      <link rel="stylesheet" href="mer-dash/assets/vendor/fonts/boxicons.css" />

      <!-- Core CSS -->
      <link rel="stylesheet" href="mer-dash/assets/vendor/css/core.css" class="template-customizer-core-css" />
      <link rel="stylesheet" href="mer-dash/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
      <link rel="stylesheet" href="mer-dash/assets/css/demo.css" />
      <!-- My CSS-->
      <link rel="stylesheet" href="mer-dash/assets/css/main.css" />

      <!-- Vendors CSS -->
      <link rel="stylesheet" href="mer-dash/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

      <link rel="stylesheet" href="mer-dash/assets/vendor/libs/apex-charts/apex-charts.css" />

      <!-- Page CSS -->
      <link rel="stylesheet" href="mer-dash/assets/vendor/css/pages/page-misc.css" />

      <!-- Helpers -->
      <script src="mer-dash/assets/vendor/js/helpers.js"></script>

      <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
      <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
      <script src="mer-dash/assets/js/config.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      <!-- Include QuaggaJS from a CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
      <style>
        #video-container {
      width: 300px;
      height: 200px;
      border: 1px solid gray;
      background: #000;
      display: none;
      margin-top: 1em;
      }

        #video {
          width: 300px;
          height: 200px;
          border: 1px solid gray;
          background: #000;
        }
        #result {
          margin-top: 1em;
          font-weight: bold;
        }

        #close-camera {
      position: absolute;
      bottom: 5px;
      left: 50%;
      transform: translateX(-50%);
      padding: 5px 10px;
      background: #dc3545;
      border: none;
      color: #fff;
      cursor: pointer;
      border-radius: 4px;
      }
  </style>
  </head>

  <body>

