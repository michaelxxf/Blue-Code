

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
require_once __DIR__ . '../../models/Merchant.php';
require_once __DIR__ . '../../models/User.php';
require_once __DIR__ . '../../models/Transaction.php';

// Retrieve the merchant record from the database using the merchant_id stored in session
if (isset($_SESSION['merchant_id'])) {
  $merchantModel = new Merchant();
  $merchant = $merchantModel->getById($_SESSION['merchant_id']);
  
  $userModel = new User();
  $user = $userModel->getById($merchant['ext_id']);
  
}
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="assets/"
  data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <base href="/bluecode.ng/public/">

  <title>merchant | Settings</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="mer-dash/assets/img/favicon/#" /> <!-- Remember to add for production -->

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

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

  <!-- Helpers -->
  <script src="mer-dash/assets/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="mer-dash/assets/js/config.js"></script>
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="merchant/dashboard" class="app-brand-link">
            <span class="app-brand-logo demo">
              <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <defs>
                  <path
                    d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                    id="path-1"></path>
                  <path
                    d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                    id="path-3"></path>
                  <path
                    d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                    id="path-4"></path>
                  <path
                    d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                    id="path-5"></path>
                </defs>
                <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                    <g id="Icon" transform="translate(27.000000, 15.000000)">
                      <g id="Mask" transform="translate(0.000000, 8.000000)">
                        <mask id="mask-2" fill="white">
                          <use xlink:href="#path-1"></use>
                        </mask>
                        <use fill="#696cff" xlink:href="#path-1"></use>
                        <g id="Path-3" mask="url(#mask-2)">
                          <use fill="#696cff" xlink:href="#path-3"></use>
                          <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                        </g>
                        <g id="Path-4" mask="url(#mask-2)">
                          <use fill="#696cff" xlink:href="#path-4"></use>
                          <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                        </g>
                      </g>
                      <g id="Triangle"
                        transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) ">
                        <use fill="#696cff" xlink:href="#path-5"></use>
                        <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                      </g>
                    </g>
                  </g>
                </g>
              </svg>
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">BOW BOW</span>
          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
          <!-- Dashboard -->
          <li class="menu-item">
            <a href="merchant/dashboard" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div data-i18n="Analytics">Dashboard</div>
            </a>
          </li>



          <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pages</span>
          </li>
          
          <li class="menu-item">
            <a href="merchant/branch" class="menu-link">
              <i class="menu-icon tf-icons bx bx-collection"></i>
              <div data-i18n="Basic">Branch</div>
            </a>
          </li>

          <li class="menu-item">
            <a href="cards-basic.html" class="menu-link">
              <i class="menu-icon tf-icons bx bx-chat"></i>
              <div data-i18n="Basic">Chat</div>
            </a>
          </li>

          <li class="menu-item">
              <a href="cards-basic.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-money"></i>
                <div data-i18n="Basic">Transaction history</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="cards-basic.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-time"></i>
                <div data-i18n="Basic">Time Line</div>
              </a>
            </li>

          <li class="menu-item active open">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-dock-top"></i>
              <div data-i18n="Account Settings">Account Settings</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item active">
                <a href="pages-account-settings-account.html" class="menu-link">
                  <div data-i18n="Account">General</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="pages-account-settings-notifications.html" class="menu-link">
                  <div data-i18n="Notifications">Notifications</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="pages-account-settings-connections.html" class="menu-link">
                  <div data-i18n="Connections">Transactions</div>
                </a>
              </li>
            </ul>
          </li>


          <li class="menu-item">
            <a href="https://github.com/themeselection/BOW BOW-html-admin-template-free/issues" target="_blank"
              class="menu-link">
              <i class="menu-icon tf-icons bx bx-support"></i>
              <div data-i18n="Support">Support</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="https://themeselection.com/demo/BOW BOW-bootstrap-html-admin-template/documentation/" target="_blank"
              class="menu-link">
              <i class="menu-icon tf-icons bx bx-file"></i>
              <div data-i18n="Documentation">Documentation</div>
            </a>
          </li>
        </ul>
      </aside>
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->

        <nav
          class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
          id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
              <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input type="text" class="form-control border-0 shadow-none" placeholder="Search..."
                  aria-label="Search..." />
              </div>
            </div>
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <!--begin::Notifications Dropdown Menu-->
              <li class="nav-item dropdown">
                <a class="nav-link" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                  <i class="bi bi-bell-fill"></i>
                  <span class="navbar-badge badge text-bg-warning">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                  <span class="dropdown-item dropdown-header">15 Notifications</span>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <i class="bi bi-envelope me-2"></i> 4 new messages
                    <span class="float-end text-secondary fs-7">3 mins</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <i class="bi bi-people-fill me-2"></i> 8 friend requests
                    <span class="float-end text-secondary fs-7">12 hours</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                    <span class="float-end text-secondary fs-7">2 days</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item dropdown-footer"> See All Notifications </a>
                </div>
              </li>
              <!-- end::Notifications Dropdown items-->
              <!-- User -->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <div class="avatar avatar-online">
                    <img src=<?php echo $merchant['merchant_logo']; ?> alt class="w-px-40 h-auto rounded-circle" />
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar avatar-online">
                            <img src=<?php echo $merchant['merchant_logo']; ?> alt class="w-px-40 h-auto rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <span class="fw-semibold d-block">User</span>
                          <small class="text-muted">Admin</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <i class="bx bx-user me-2"></i>
                      <span class="align-middle">My Profile</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <i class="bx bx-cog me-2"></i>
                      <span class="align-middle">Settings</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <span class="d-flex align-items-center align-middle">
                        <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                        <span class="flex-grow-1 align-middle">Settlement</span>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="logout">
                      <i class="bx bx-power-off me-2"></i>
                      <span class="align-middle">Log Out</span>
                    </a>
                  </li>
                </ul>
              </li>
              <!--/ User -->
            </ul>
          </div>
        </nav>

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
              <span class="text-muted fw-light">Account Settings /</span> General
            </h4>

            <!-- Navigation Pills -->
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
              <li class="nav-item">
                <a class="nav-link active" href="javascript:void(0);">
                  <i class="bx bx-user me-1"></i> General
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="pages-account-settings-notifications.html">
                  <i class="bx bx-bell me-1"></i> Notifications
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="pages-account-settings-connections.html">
                  <i class="bx bx-link-alt me-1"></i> Transactions
                </a>
              </li>
            </ul>

            <!-- Merged Form Starts Here -->
            <form id="formAccountSettings" method="POST" action="merchant/setting/update">
              <div class="row">
                <!-- Form 1: User Details -->
                <div class="col-md-6">
                  <div class="card mb-4">
                    <!-- Card Header -->
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Profile Deatails</h5>
                      <small class="text-muted float-end">User's Details</small>
                    </div>
                    <!-- Card Body: Merchant pic upload -->
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="mer-dash/assets/img/avatars/1.png" alt="user-avatar" class="d-block rounded"
                          height="100" width="100" id="uploadedAvatar" />
                        <div class="button-wrapper">
                          <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Merchant photo</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input type="file" name="merchant_logo" id="upload" class="account-file-input" hidden
                              accept="image/png, image/jpeg" />
                          </label>
                          <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Reset</span>
                          </button>
                          <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                        </div>
                      </div>
                    </div>
                    <hr class="my-0" />
                    <!-- Card Body: User Details Fields -->
                    <div class="card-body">
                      <div class="row">
                        <div class="mb-3 col-md-6">
                          <label for="firstName" class="form-label">First Name</label>
                          <input class="form-control" type="text" id="firstName" name="firstName" placeholder="John"
                            autofocus />
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="lastName" class="form-label">Last Name</label>
                          <input class="form-control" type="text" name="lastName" id="lastName" placeholder="Doe"  />
                        </div>
                        <div class="mb-3">
                          <label for="email" class="form-label">User login/Merchant E-mail <i class="bi bi-asterisk"></i></label>
                          <input class="form-control" type="text" id="email" name="email" 
                            placeholder=<?php echo $merchant['contact_email']; ?> />
                        </div>
                        <div class="mb-3">
                          <label for="gender" class="form-label">Gender</label>
                          <select id="currency" name="gender" class="select2 form-select">
                            <option value="MALE">MALE</option>
                            <option value="FEMALE">FEMALE</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="phoneNumber">Phone Number</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><select name="code" id="code" class="form-select code">
                              <option value="" placeholder="Code +">code +</option>
                            </select></span>
                            <input type="text" id="phoneNumber" name="phoneNumber" class="form-control"
                              placeholder=<?php echo preg_replace('/^\+?\d{1,3}/', '', $merchant['contact_phone']); ?> pattern="(\d{3}-\d{3}-\d{4}|\d{10})"
                              />
                          </div>
                        </div>
                        <div class="mb-3">
                          <label for="position" class="form-label">Position <i class="bi bi-asterisk"></i></label>
                          <select name="position" class="form-select">
                            <option value="position">Position</option>
                            <option value="director">Director</option>
                            <option value="manager">Manager</option>
                            <option value="employee">Employee</option>
                            <option value="CEO">CEO</option>
                            <option value="Founder">Founder</option>
                            <option value="CO-founder">CO-founder</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


                <!-- Form 2: Merchant Details -->
                <div class="col-md-6">
                  <div class="card mb-4">
                    <!-- Card Header -->
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Merchant Details</h5>
                      <small class="text-muted float-end">Merchant's form</small>
                    </div>
                    <!-- Card Body: Merchant pic upload -->
                      <hr class="my-0" />
                      <div class="card-body">
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-company">Merchant Name <i class="bi bi-asterisk"></i></label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-company2" class="input-group-text">
                              <i class="bx bx-buildings"></i>
                            </span>
                            <input type="text" id="basic-icon-default-company" name="merchantCompany"
                              class="form-control" placeholder=<?php echo $merchant['merchant_name']; ?> aria-label="ACME Inc."
                              aria-describedby="basic-icon-default-company2" />
                          </div>
                        </div>
                        <div class="mb-3">
                          <label for="mcc" class="form-label">-- Select Your Merchant Category: -- <i class="bi bi-asterisk"></i></label>
                          <select name="mcc" id="mcc" class="select2 form-select" >
                            <option value="" class="option" >
                              -- Merchant Category: --
                            </option>
                          </select>

                        </div>
                        <div class="mb-3">
                          <label for="mer_type" class="form-label">-- Merchant Type: --</label>
                          <select name="mer_type" id="mer_type" class="select2 form-select" >
                            <option value="INDIVIDUAL">
                              INDIVIDUAL
                            </option>
                            <option value="ENTERPRISE">
                              ENTERPRISE
                            </option>
                          </select>

                        </div>
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="mer_reg_no">Business REGISTERATION NUMBER</label>
                            <div class="input-group input-group-merge">
                              <span id="" class="input-group-text" data-bs-toggle="tooltip"
                              data-bs-offset="0,4"
                              data-bs-placement="right"
                              data-bs-html="true"
                              title="<i class='bi bi-building-check' ></i> <span>**Business Registration Number:** A unique number assigned to a business upon registration with the relevant government authority. You can obtain it from your country’s corporate affairs or business registration office.</span>">
                                <i class="bi bi-patch-question"></i>
                              </span>
                              <input type="text" id="mer_reg_no" name="mer_reg_no" class="form-control "
                                placeholder=<?php echo $merchant['registration_number'];?> />
                            </div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="vatNo">VAT No</label>
                            <div class="input-group input-group-merge">
                              <span id="" class="input-group-text" data-bs-toggle="tooltip"
                              data-bs-offset="0,4"
                              data-bs-placement="right"
                              data-bs-html="true"
                              title="<i class='bx bx-trending-up bx-xs' ></i> <span>VAT Number: A unique tax identification number assigned to businesses for Value Added Tax (VAT) purposes. You can obtain it from your country’s tax authority after registering for VAT.</span>">
                                <i class="bi bi-patch-question"></i>
                              </span>
                              <input type="text" id="vatNo" name="vatNo" class="form-control "
                                placeholder=<?php echo $merchant['vat_number']; ?> />
                            </div>
                            <hr class="my-3" />
                           
                          </div>
                        </div>
                        <div class="mb-3">
                          <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Address</h5>
                            <small class="text-muted float-end">Merchant's contact</small>
                          </div>
                          <!-- Merchant Address-->
                          <label class="form-label" for="mer_address">Merchant Address</label>
                          <div class="input-group input-group-merge">
                            <span id="" class="input-group-text" data-bs-toggle="tooltip">
                              <i class="bi bi-patch-question"></i>
                            </span>                          
                            <input type="text" id="mer_address" name="mer_address" class="form-control "
                              placeholder=<?php echo $merchant['address_line1']; ?>  />
                           </div>
                           <div class="row g-3">
                            <div class="mb-3 col-md-6">
                              <label class="form-label" for="mer_city">City</label>
                              <div class="input-group input-group-merge">
                                <span id="" class="input-group-text" data-bs-toggle="tooltip">
                                  <i class="bi bi-patch-question"></i>
                                </span>
                                <input type="text" id="mer_city" name="mer_city" class="form-control "
                                  placeholder="City" aria-label="City"  />
                              </div>
                            </div>
                            <div class="mb-3 col-md-6">
                              <label class="form-label" for="mer_zip">Zip Code</label>
                              <div class="input-group input-group-merge">
                                <span id="" class="input-group-text" data-bs-toggle="tooltip">
                                  <i class="bi bi-patch-question"></i>
                                </span>
                                <input type="text" id="mer_zip" name="mer_zip" class="form-control "
                                  placeholder=<?php echo $merchant['address_zip']; ?> />
                              </div>
                            </div>
                            <div class="mb-3">
                              <label class="form-label" for="mer_country">Country</label>
                              <div class="input-group input-group-merge">
                                <span id="" class="input-group-text" data-bs-toggle="tooltip">
                                  <i class="bi bi-patch-question"></i>
                                </span>
                                <select id="mer_country" name="mer_country" class="form-select ">
                                  <option  class="option">Select Country</option>
                                </select>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Single Submit/Cancel Buttons for Both Sections -->
              <div class="mt-2 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
              </div>
            </form>
            <!-- End merged form -->

            <!-- Delete Account Card (full width) -->
            <div class="card">
              <h5 class="card-header">Delete Account</h5>
              <div class="card-body">
                <div class="mb-3 col-12 mb-0">
                  <div class="alert alert-warning">
                    <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                    <p class="mb-0">
                      Once you delete your account, there is no going back. Please be certain.
                    </p>
                  </div>
                </div>
                <form id="formAccountDeactivation" onsubmit="return false">
                  <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" />
                    <label class="form-check-label" for="accountActivation">
                      I confirm my account deactivation
                    </label>
                  </div>
                  <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                </form>
              </div>
            </div>
          </div>
          <!-- / Content -->

          <!-- Footer -->
          <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
              <div class="mb-2 mb-md-0">
                ©
                <script>
                  document.write(new Date().getFullYear());
                </script>,
                made with ❤️ by
                <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">
                  ThemeSelection
                </a>
              </div>
              <div>
                <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>
                <a href="https://themeselection.com/demo/BOW BOW-bootstrap-html-admin-template-free/documentation/"
                  target="_blank" class="footer-link me-4">Documentation</a>
                <a href="https://github.com/themeselection/BOW BOW-html-admin-template-free/issues" target="_blank"
                  class="footer-link me-4">Support</a>
              </div>
            </div>
          </footer>
          <!-- / Footer -->

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->

      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <!-- / Layout wrapper -->


  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="mer-dash/assets/vendor/libs/jquery/jquery.js"></script>
  <script src="mer-dash/assets/vendor/libs/popper/popper.js"></script>
  <script src="mer-dash/assets/vendor/js/bootstrap.js"></script>
  <script src="mer-dash/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <script src="mer-dash/assets/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->

  <!-- Main JS -->
  <script src="mer-dash/assets/js/main.js"></script>

  <!-- Page JS -->
  <script src="mer-dash/assets/js/pages-account-settings-account.js"></script>

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>


  <script>
      // Load MCC codes dynamically
    fetch("../public/assets/json/mcc_codes.json")
      .then((response) => response.json())
      .then((data) => {
        let mccDropdown = document.getElementById("mcc");
        data.forEach((mcc) => {
          let option = document.createElement("option");
          option.value = mcc.code;
          option.textContent = `${mcc.description} (${mcc.code})`;
          mccDropdown.appendChild(option);
        });
      })
      .catch((error) => console.error("Error loading MCC codes:", error));


    // Load country codes dynamically
    fetch("../public/assets/json/country_codes.json")
      .then((response) => response.json())
      .then((data) => {
        let countryDropdown = document.getElementById("mer_country");
        data.forEach((country) => {
          let option = document.createElement("option");
          option.value = `${country.code}`;
          option.textContent = `${country.name} (${country.code})`;
          countryDropdown.appendChild(option);
        });
      })
      .catch((error) => console.error("Error loading country codes:", error));

    // Load phone codes dynamically
    fetch("../public/assets/json/phone_codes.json")
      .then((response) => response.json())
      .then((data) => {
        let phoneDropdown = document.getElementById("code");
        data.forEach((phone) => {
          let option = document.createElement("option");
          option.value = phone.phone_code;
          option.textContent = `${phone.code} (${phone.phone_code})`;
          phoneDropdown.appendChild(option);
        });
      })
      .catch((error) => console.error("Error loading phone codes:", error));

      // Remove Alert box after 5seconds
      setTimeout(() => {
          let alertBox = document.querySelector(".alert");
          if (alertBox) {
          alertBox.style.transition = "opacity 0.5s";
          alertBox.style.opacity = "0";
          setTimeout(() => alertBox.remove(), 500);
          }
      }, 3000); // Auto-close after 3 seconds


  </script>
</body>

</html>