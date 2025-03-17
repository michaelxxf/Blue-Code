<<<<<<< HEAD


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
require_once __DIR__ . '../../models/Branch.php';
require_once __DIR__ . '../../models/Transaction.php';

// Retrieve the merchant record from the database using the merchant_id stored in session
if (isset($_SESSION['merchant_id'])) {
  $merchantModel = new Merchant();
  $merchant = $merchantModel->getById($_SESSION['merchant_id']);
  
  $userModel = new User();
  $user = $userModel->getById($merchant['ext_id']);

  $merchantId = $_SESSION['merchant_id'];
  $branchModel = new Branch();
  // Get branches for the merchant (ensure your method returns an array)
  $branches = $branchModel->getBranchesByMerchant($merchantId);
  
  $totalBranches = is_array($branches) ? count($branches) : 0;

  
}
?>

<?php
    include 'include/header.php';
    include 'include/aside.php';
    include 'include/nav.php';
    ?>

<!-- 4 equal side of box column-->
<div class="container mt-4">
    <div class="row ">
        <div class="col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M21 7h-6a1 1 0 0 0-1 1v3h-2V4a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1zM8 6h2v2H8V6zM6 16H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V6h2v2zm4 8H8v-2h2v2zm0-4H8v-2h2v2zm9 4h-2v-2h2v2zm0-4h-2v-2h2v2z"></path></svg>
                  </div>
                  <div class="dropdown">
                    <button
                      class="btn p-0"
                      type="button"
                      id="cardOpt1"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="cardOpt1">
                      <a class="dropdown-item" href="javascript:void(0);">View More</a>
                      <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                    </div>
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Total Branch</span>
                <h3 class="card-title mb-2"><?php echo $totalBranches; ?></h3>
              </div>
            </div>
          </div>
          <div class="col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img src="mer-dash/assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                  </div>
                  <div class="dropdown">
                    <button
                      class="btn p-0"
                      type="button"
                      id="cardOpt1"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="cardOpt1">
                      <a class="dropdown-item" href="javascript:void(0);">View More</a>
                      <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                    </div>
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Transactions</span>
                <h3 class="card-title mb-2">&#x20A6;14,857</h3>
                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
              </div>
            </div>
          </div>
          <div class="col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img src="mer-dash/assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                  </div>
                  <div class="dropdown">
                    <button
                      class="btn p-0"
                      type="button"
                      id="cardOpt1"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="cardOpt1">
                      <a class="dropdown-item" href="javascript:void(0);">View More</a>
                      <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                    </div>
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Transactions</span>
                <h3 class="card-title mb-2">&#x20A6;14,857</h3>
                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
              </div>
            </div>
          </div>
          <div class="col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img src="mer-dash/assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                  </div>
                  <div class="dropdown">
                    <button
                      class="btn p-0"
                      type="button"
                      id="cardOpt1"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="cardOpt1">
                      <a class="dropdown-item" href="javascript:void(0);">View More</a>
                      <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                    </div>
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Transactions</span>
                <h3 class="card-title mb-2">&#x20A6;14,857</h3>
                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
              </div>
            </div>
          </div>
    </div>
</div>

<!-- Add Branch Button -->
<div class="text-center my-4">
    <button
        type="button"
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#addBranchModal"
    >
        Add Branch
    </button>
</div>

<!-- Add Branch Modal Form -->
<!-- First Modal-->
<form action="merchant/process-branch" method="POST">
    <div class="modal fade" id="addBranchModal" tabindex="-1" aria-hidden="true" style="display: none">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Branch Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label">Branch Name</label>
                            <input type="text" name="branch_name" class="form-control" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="contact_phone" pattern="(\d{3}-\d{3}-\d{4}|\d{10})" class="form-label">Branch Phone</label>
                            <input class="form-control" type="text" id="contact_phone" name="contact_phone" placeholder="+00 000 000 000" autofocus required/>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="contact_email" class="form-label">Branch E-mail</label>
                            <input class="form-control" type="text" id="contact_email" name="contact_email" placeholder="john.doe@example.com" autofocus/>
                        </div>
                        <div class="mb-3">
                            <label for="booking_reference_prefix" class="form-label">Booking_reference_prefix</label>
                            <input class="form-control" type="text" id="booking_reference_prefix" name="booking_reference_prefix" placeholder="Thanks for shopping with us" autofocus/>
                        </div>
                        <div class="mb-3">
                            <label for="state" class="form-label">State</label>
                            <select id="state" name="state" class="select2 form-select">
                                <option value="ACTIVE">ACTIVE</option>
                                <option value="DISABLED">DISABLED</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button
                                class="btn btn-primary"
                                data-bs-target="#modalToggle2"
                                data-bs-toggle="modal"
                                data-bs-dismiss="modal"
                            >
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Second Modal-->
    <div
        class="modal fade"
        id="modalToggle2"
        aria-hidden="true"
        aria-labelledby="modalToggleLabel2"
        tabindex="-1"
    >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalToggleLabel2">Branch Address</h5>
                <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                ></button>
                </div>
                <div class="modal-body row">
                    <div class="mb-3">
                        <label class="form-label" for="branch_address">Address Line 1</label>
                        <div class="input-group input-group-merge">
                            <span id="" class="input-group-text" data-bs-toggle="tooltip">
                                <i class="bi bi-patch-question"></i>
                            </span>                          
                            <input type="text" id="branch_address" name="branch_address" class="form-control required"
                                placeholder="NO 1 nowhere street" aria-label="NO 1 nowhere street" required/>
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="branch_zip">Zip</label>                        
                        <input type="text" id="branch_zip" name="branch_zip" class="form-control required"
                            placeholder="12345" aria-label="12345" required/>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="branch_city">City</label>                        
                        <input type="text" id="branch_city" name="branch_city" class="form-control required"
                            placeholder="New York" aria-label="New York" required/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="branch_country" >Country</label>
                        <div class="input-group input-group-merge">
                          <span id="" class="input-group-text" data-bs-toggle="tooltip">
                            <i class="bi bi-patch-question"></i>
                          </span>
                          <select id="branch_country" name="branch_country" class="form-select required" required>
                            <option value="" class="option">Select Country</option>
                          </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                      class="btn btn-primary"
                      data-bs-target="#addBranchModal"
                      data-bs-toggle="modal"
                      data-bs-dismiss="#modalToggle2"
                    >
                      Back to first
                    </button>
                    <button type="submit" class="btn btn-success">Save Branch</button>
                </div>
          </div>
        </div>
    </div>
</form>
          

<!-- Branch Table-->


<!-- <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>Branch/ext ID</th>
          <th>Name</th>
          <th>Address</th>
          <th>Contact Email</th>
          <th>Contact Phone</th>
          <th>Status</th>
          <th>Total transactions</th>
          <th>Creation time</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>MerchantName.unique</td>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>BranchName</strong></td>
          <td>Branch Address = branch_Address_Line 1 + branch_city + branch_zip + branch_country</td>
          <td><a href="mailto:BranchEmail">BranchEmail</a></td>
          <td><a href="tel:00000000000">BranchPhone</a></td>
          <td><span class="badge bg-label-success me-1">Active</span></td>
          <td>Total transaction of branch</td>
          <td>Branch creation time</td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0);"
                  ><i class="bx bx-edit-alt me-1"></i> Edit</a
                >
                <a class="dropdown-item" href="javascript:void(0);"
                  ><i class="bx bx-book-open me-1"></i> View more</a
                >
                <a class="dropdown-item" href="javascript:void(0);"
                  ><i class="bx bx-trash me-1"></i> Delete</a
                >
              </div>
            </div>
          </td>
          
        </tr>

        <tr>
            <td>MerchantName.unique</td>
            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>BranchName</strong></td>
            <td>Branch Address = branch_Address_Line 1 + branch_city + branch_zip + branch_country</td>
            <td><a href="mailto:BranchEmail">BranchEmail</a></td>
            <td><a href="tel:00000000000">BranchPhone</a></td>
            <td><span class="badge bg-label-secondary me-1">Suspended</span></td>
            <td>Total transaction of branch</td>
            <td>Branch creation time</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);"
                    ><i class="bx bx-edit-alt me-1"></i> Edit</a
                  >
                  <a class="dropdown-item" href="javascript:void(0);"
                  ><i class="bx bx-book-open me-1"></i> View more</a
                >
                  <a class="dropdown-item" href="javascript:void(0);"
                    ><i class="bx bx-trash me-1"></i> Delete</a
                  >
                </div>
              </div>
            </td>
            
          </tr>

          <tr>
            <td>MerchantName.unique</td>
            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>BranchName</strong></td>
            <td>Branch Address = branch_Address_Line 1 + branch_city + branch_zip + branch_country</td>
            <td><a href="mailto:BranchEmail">BranchEmail</a></td>
            <td><a href="tel:00000000000">BranchPhone</a></td>
            <td><span class="badge bg-label-danger me-1">Disabled</span></td>
            <td>Total transaction of branch</td>
            <td>Branch creation time</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);"
                    ><i class="bx bx-edit-alt me-1"></i> Edit</a
                  >
                  <a class="dropdown-item" href="javascript:void(0);"
                  ><i class="bx bx-book-open me-1"></i> View more</a
                >
                  <a class="dropdown-item" href="javascript:void(0);"
                    ><i class="bx bx-trash me-1"></i> Delete</a
                  >
                </div>
              </div>
            </td>
            
          </tr>
        
      </tbody>
      <tfoot class="table-border-bottom-0">
        <tr>
            <th>Branch/ext ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Contact Email</th>
            <th>Contact Phone</th>
            <th>Status</th>
            <th>Total transactions</th>
            <th>Creation time</th>
            <th>Action</th>
        </tr>
      </tfoot>
    </table>
</div> -->
<?php
// if ($branches && count($branches) > 0) {
//         foreach ($branches as $branch) {
//             echo "<tr>";
//             echo "<td>" . htmlspecialchars($branch['ext_id']) . "</td>";
//             echo "<td><i class='fab fa-angular fa-lg text-danger me-3'></i> <strong>" . htmlspecialchars($branch['name']) . "</strong></td>";
//             // Combine address fields
//             $fullAddress = trim($branch['address_line1'] . ", " . $branch['address_city'] . ", " . $branch['address_zip'] . ", " . $branch['address_country']);
//             echo "<td>" . htmlspecialchars($fullAddress) . "</td>";
//             echo "<td><a href='mailto:" . htmlspecialchars($branch['contact_email']) . "'>" . htmlspecialchars($branch['contact_email']) . "</a></td>";
//             echo "<td><a href='tel:" . htmlspecialchars($branch['contact_phone']) . "'>" . htmlspecialchars($branch['contact_phone']) . "</a></td>";
            
//             // Status badge based on branch state
//             $state = strtoupper($branch['state']);
//             if ($state === "ACTIVE") {
//                 echo "<td><span class='badge bg-label-success me-1'>Active</span></td>";
//             } elseif ($state === "DISABLED") {
//                 echo "<td><span class='badge bg-label-danger me-1'>Disabled</span></td>";
//             } elseif ($state === "SUSPENDED") {
//                 echo "<td><span class='badge bg-label-secondary me-1'>Suspended</span></td>";
//             } else {
//                 echo "<td><span class='badge bg-label-info me-1'>" . htmlspecialchars($branch['state']) . "</span></td>";
//             }
            
//             // Total transactions (assuming this is stored or calculated; use a placeholder if not)
//             echo "<td>" . htmlspecialchars($branch['total_transactions'] ?? "0") . "</td>";
            
//             // Creation time (assumed to be inserted_at column)
//             echo "<td>" . htmlspecialchars($branch['inserted_at']) . "</td>";
            
//             // Action dropdown
//             echo "<td>
//                     <div class='dropdown'>
//                         <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
//                             <i class='bx bx-dots-vertical-rounded'></i>
//                         </button>
//                         <div class='dropdown-menu'>
//                             <a class='dropdown-item' href='edit_branch.php?ext_id=" . urlencode($branch['ext_id']) . "'>
//                                 <i class='bx bx-edit-alt me-1'></i> Edit
//                             </a>
//                             <a class='dropdown-item' href='view_branch.php?ext_id=" . urlencode($branch['ext_id']) . "'>
//                                 <i class='bx bx-book-open me-1'></i> View More
//                             </a>
//                             <a class='dropdown-item' href='delete_branch.php?ext_id=" . urlencode($branch['ext_id']) . "'>
//                                 <i class='bx bx-trash me-1'></i> Delete
//                             </a>
//                         </div>
//                     </div>
//                 </td>";
//             echo "</tr>";
//         }
//     } else {
//         echo "<tr><td colspan='9'>No branches found.</td></tr>";
//     }

// ?>

<div class="table-responsive text-nowrap">
  <table class="table">
    <thead>
      <tr>
        <th>Branch/ext ID</th>
        <th>Name</th>
        <th>Address</th>
        <th>Contact Email</th>
        <th>Contact Phone</th>
        <th>Status</th>
        <th>Total transactions</th>
        <th>Creation time</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      if ($branches && count($branches) > 0) {
          foreach ($branches as $branch) {
              echo "<tr>";
              echo "<td>" . htmlspecialchars($branch['ext_id']) . "</td>";
              echo "<td><i class='fab fa-angular fa-lg text-danger me-3'></i> <strong>" . htmlspecialchars($branch['name']) . "</strong></td>";
              
              // Combine address fields
              $fullAddress = trim(
                $branch['address_line1'] . ", " . 
                $branch['address_city'] . ", " . 
                $branch['address_zip'] . ", " . 
                $branch['address_country']
              );
              echo "<td>" . htmlspecialchars($fullAddress) . "</td>";
              
              echo "<td><a href='mailto:" . htmlspecialchars($branch['contact_email']) . "'>" . htmlspecialchars($branch['contact_email']) . "</a></td>";
              echo "<td><a href='tel:" . htmlspecialchars($branch['contact_phone']) . "'>" . htmlspecialchars($branch['contact_phone']) . "</a></td>";
              
              // Status badge based on branch state
              $state = strtoupper($branch['state']);
              if ($state === "ACTIVE") {
                  echo "<td><span class='badge bg-label-success me-1'>Active</span></td>";
              } elseif ($state === "DISABLED") {
                  echo "<td><span class='badge bg-label-danger me-1'>Disabled</span></td>";
              } elseif ($state === "SUSPENDED") {
                  echo "<td><span class='badge bg-label-secondary me-1'>Suspended</span></td>";
              } else {
                  echo "<td><span class='badge bg-label-info me-1'>" . htmlspecialchars($branch['state']) . "</span></td>";
              }
              
              // Total transactions (assuming stored or calculated; use a placeholder if not)
              echo "<td>" . htmlspecialchars($branch['total_transactions'] ?? "0") . "</td>";
              
              // Creation time (assumed to be in the inserted_at field)
              echo "<td>" . htmlspecialchars($branch['inserted_at']) . "</td>";
              
              // Action dropdown
              echo "<td>
                      <div class='dropdown'>
                          <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                              <i class='bx bx-dots-vertical-rounded'></i>
                          </button>
                          <div class='dropdown-menu'>
                              <a class='dropdown-item' href='edit_branch.php?ext_id=" . urlencode($branch['ext_id']) . "'>
                                  <i class='bx bx-edit-alt me-1'></i> Edit
                              </a>
                              <a class='dropdown-item' href='view_branch.php?ext_id=" . urlencode($branch['ext_id']) . "'>
                                  <i class='bx bx-book-open me-1'></i> View More
                              </a>
                              <a class='dropdown-item' href='delete_branch.php?ext_id=" . urlencode($branch['ext_id']) . "'>
                                  <i class='bx bx-trash me-1'></i> Delete
                              </a>
                          </div>
                      </div>
                    </td>";
              echo "</tr>";
          }
      } else {
          echo "<tr><td colspan='9'>No branches found.</td></tr>";
      }
      ?>
    </tbody>
    <tfoot class="table-border-bottom-0">
      <tr>
        <th>Branch/ext ID</th>
        <th>Name</th>
        <th>Address</th>
        <th>Contact Email</th>
        <th>Contact Phone</th>
        <th>Status</th>
        <th>Total transactions</th>
        <th>Creation time</th>
        <th>Action</th>
      </tr>
    </tfoot>
  </table>
</div>


<script>
  // Load country codes dynamically
  fetch("../public/assets/json/country_codes.json")
    .then((response) => response.json())
    .then((data) => {
      let countryDropdown = document.getElementById("branch_country");
      data.forEach((country) => {
        let option = document.createElement("option");
        option.value = `${country.code}`;
        option.textContent = `${country.name} (${country.code})`;
        countryDropdown.appendChild(option);
      });
    })
    .catch((error) => console.error("Error loading country codes:", error));


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

<?php
    include 'include/footer.php';
=======


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
require_once __DIR__ . '../../models/Branch.php';
require_once __DIR__ . '../../models/Transaction.php';

// Retrieve the merchant record from the database using the merchant_id stored in session
if (isset($_SESSION['merchant_id'])) {
  $merchantModel = new Merchant();
  $merchant = $merchantModel->getById($_SESSION['merchant_id']);
  
  $userModel = new User();
  $user = $userModel->getById($merchant['ext_id']);

  $merchantId = $_SESSION['merchant_id'];
  $branchModel = new Branch();
  // Get branches for the merchant (ensure your method returns an array)
  $branches = $branchModel->getBranchesByMerchant($merchantId);
  
  $totalBranches = is_array($branches) ? count($branches) : 0;

  
}
?>

<?php
    include 'include/header.php';
    include 'include/aside.php';
    include 'include/nav.php';
    ?>

<!-- 4 equal side of box column-->
<div class="container mt-4">
    <div class="row ">
        <div class="col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M21 7h-6a1 1 0 0 0-1 1v3h-2V4a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1zM8 6h2v2H8V6zM6 16H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V6h2v2zm4 8H8v-2h2v2zm0-4H8v-2h2v2zm9 4h-2v-2h2v2zm0-4h-2v-2h2v2z"></path></svg>
                  </div>
                  <div class="dropdown">
                    <button
                      class="btn p-0"
                      type="button"
                      id="cardOpt1"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="cardOpt1">
                      <a class="dropdown-item" href="javascript:void(0);">View More</a>
                      <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                    </div>
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Total Branch</span>
                <h3 class="card-title mb-2"><?php echo $totalBranches; ?></h3>
              </div>
            </div>
          </div>
          <div class="col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img src="mer-dash/assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                  </div>
                  <div class="dropdown">
                    <button
                      class="btn p-0"
                      type="button"
                      id="cardOpt1"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="cardOpt1">
                      <a class="dropdown-item" href="javascript:void(0);">View More</a>
                      <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                    </div>
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Transactions</span>
                <h3 class="card-title mb-2">&#x20A6;14,857</h3>
                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
              </div>
            </div>
          </div>
          <div class="col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img src="mer-dash/assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                  </div>
                  <div class="dropdown">
                    <button
                      class="btn p-0"
                      type="button"
                      id="cardOpt1"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="cardOpt1">
                      <a class="dropdown-item" href="javascript:void(0);">View More</a>
                      <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                    </div>
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Transactions</span>
                <h3 class="card-title mb-2">&#x20A6;14,857</h3>
                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
              </div>
            </div>
          </div>
          <div class="col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img src="mer-dash/assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                  </div>
                  <div class="dropdown">
                    <button
                      class="btn p-0"
                      type="button"
                      id="cardOpt1"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="cardOpt1">
                      <a class="dropdown-item" href="javascript:void(0);">View More</a>
                      <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                    </div>
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Transactions</span>
                <h3 class="card-title mb-2">&#x20A6;14,857</h3>
                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
              </div>
            </div>
          </div>
    </div>
</div>

<!-- Add Branch Button -->
<div class="text-center my-4">
    <button
        type="button"
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#addBranchModal"
    >
        Add Branch
    </button>
</div>

<!-- Add Branch Modal Form -->
<!-- First Modal-->
<form action="merchant/process-branch" method="POST">
    <div class="modal fade" id="addBranchModal" tabindex="-1" aria-hidden="true" style="display: none">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Branch Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label">Branch Name</label>
                            <input type="text" name="branch_name" class="form-control" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="contact_phone" pattern="(\d{3}-\d{3}-\d{4}|\d{10})" class="form-label">Branch Phone</label>
                            <input class="form-control" type="text" id="contact_phone" name="contact_phone" placeholder="+00 000 000 000" autofocus required/>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="contact_email" class="form-label">Branch E-mail</label>
                            <input class="form-control" type="text" id="contact_email" name="contact_email" placeholder="john.doe@example.com" autofocus/>
                        </div>
                        <div class="mb-3">
                            <label for="booking_reference_prefix" class="form-label">Booking_reference_prefix</label>
                            <input class="form-control" type="text" id="booking_reference_prefix" name="booking_reference_prefix" placeholder="Thanks for shopping with us" autofocus/>
                        </div>
                        <div class="mb-3">
                            <label for="state" class="form-label">State</label>
                            <select id="state" name="state" class="select2 form-select">
                                <option value="ACTIVE">ACTIVE</option>
                                <option value="DISABLED">DISABLED</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button
                                class="btn btn-primary"
                                data-bs-target="#modalToggle2"
                                data-bs-toggle="modal"
                                data-bs-dismiss="modal"
                            >
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Second Modal-->
    <div
        class="modal fade"
        id="modalToggle2"
        aria-hidden="true"
        aria-labelledby="modalToggleLabel2"
        tabindex="-1"
    >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalToggleLabel2">Branch Address</h5>
                <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                ></button>
                </div>
                <div class="modal-body row">
                    <div class="mb-3">
                        <label class="form-label" for="branch_address">Address Line 1</label>
                        <div class="input-group input-group-merge">
                            <span id="" class="input-group-text" data-bs-toggle="tooltip">
                                <i class="bi bi-patch-question"></i>
                            </span>                          
                            <input type="text" id="branch_address" name="branch_address" class="form-control required"
                                placeholder="NO 1 nowhere street" aria-label="NO 1 nowhere street" required/>
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="branch_zip">Zip</label>                        
                        <input type="text" id="branch_zip" name="branch_zip" class="form-control required"
                            placeholder="12345" aria-label="12345" required/>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="branch_city">City</label>                        
                        <input type="text" id="branch_city" name="branch_city" class="form-control required"
                            placeholder="New York" aria-label="New York" required/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="branch_country" >Country</label>
                        <div class="input-group input-group-merge">
                          <span id="" class="input-group-text" data-bs-toggle="tooltip">
                            <i class="bi bi-patch-question"></i>
                          </span>
                          <select id="branch_country" name="branch_country" class="form-select required" required>
                            <option value="" class="option">Select Country</option>
                          </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                      class="btn btn-primary"
                      data-bs-target="#addBranchModal"
                      data-bs-toggle="modal"
                      data-bs-dismiss="#modalToggle2"
                    >
                      Back to first
                    </button>
                    <button type="submit" class="btn btn-success">Save Branch</button>
                </div>
          </div>
        </div>
    </div>
</form>
          

<!-- Branch Table-->


<!-- <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>Branch/ext ID</th>
          <th>Name</th>
          <th>Address</th>
          <th>Contact Email</th>
          <th>Contact Phone</th>
          <th>Status</th>
          <th>Total transactions</th>
          <th>Creation time</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>MerchantName.unique</td>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>BranchName</strong></td>
          <td>Branch Address = branch_Address_Line 1 + branch_city + branch_zip + branch_country</td>
          <td><a href="mailto:BranchEmail">BranchEmail</a></td>
          <td><a href="tel:00000000000">BranchPhone</a></td>
          <td><span class="badge bg-label-success me-1">Active</span></td>
          <td>Total transaction of branch</td>
          <td>Branch creation time</td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0);"
                  ><i class="bx bx-edit-alt me-1"></i> Edit</a
                >
                <a class="dropdown-item" href="javascript:void(0);"
                  ><i class="bx bx-book-open me-1"></i> View more</a
                >
                <a class="dropdown-item" href="javascript:void(0);"
                  ><i class="bx bx-trash me-1"></i> Delete</a
                >
              </div>
            </div>
          </td>
          
        </tr>

        <tr>
            <td>MerchantName.unique</td>
            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>BranchName</strong></td>
            <td>Branch Address = branch_Address_Line 1 + branch_city + branch_zip + branch_country</td>
            <td><a href="mailto:BranchEmail">BranchEmail</a></td>
            <td><a href="tel:00000000000">BranchPhone</a></td>
            <td><span class="badge bg-label-secondary me-1">Suspended</span></td>
            <td>Total transaction of branch</td>
            <td>Branch creation time</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);"
                    ><i class="bx bx-edit-alt me-1"></i> Edit</a
                  >
                  <a class="dropdown-item" href="javascript:void(0);"
                  ><i class="bx bx-book-open me-1"></i> View more</a
                >
                  <a class="dropdown-item" href="javascript:void(0);"
                    ><i class="bx bx-trash me-1"></i> Delete</a
                  >
                </div>
              </div>
            </td>
            
          </tr>

          <tr>
            <td>MerchantName.unique</td>
            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>BranchName</strong></td>
            <td>Branch Address = branch_Address_Line 1 + branch_city + branch_zip + branch_country</td>
            <td><a href="mailto:BranchEmail">BranchEmail</a></td>
            <td><a href="tel:00000000000">BranchPhone</a></td>
            <td><span class="badge bg-label-danger me-1">Disabled</span></td>
            <td>Total transaction of branch</td>
            <td>Branch creation time</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);"
                    ><i class="bx bx-edit-alt me-1"></i> Edit</a
                  >
                  <a class="dropdown-item" href="javascript:void(0);"
                  ><i class="bx bx-book-open me-1"></i> View more</a
                >
                  <a class="dropdown-item" href="javascript:void(0);"
                    ><i class="bx bx-trash me-1"></i> Delete</a
                  >
                </div>
              </div>
            </td>
            
          </tr>
        
      </tbody>
      <tfoot class="table-border-bottom-0">
        <tr>
            <th>Branch/ext ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Contact Email</th>
            <th>Contact Phone</th>
            <th>Status</th>
            <th>Total transactions</th>
            <th>Creation time</th>
            <th>Action</th>
        </tr>
      </tfoot>
    </table>
</div> -->
<?php
// if ($branches && count($branches) > 0) {
//         foreach ($branches as $branch) {
//             echo "<tr>";
//             echo "<td>" . htmlspecialchars($branch['ext_id']) . "</td>";
//             echo "<td><i class='fab fa-angular fa-lg text-danger me-3'></i> <strong>" . htmlspecialchars($branch['name']) . "</strong></td>";
//             // Combine address fields
//             $fullAddress = trim($branch['address_line1'] . ", " . $branch['address_city'] . ", " . $branch['address_zip'] . ", " . $branch['address_country']);
//             echo "<td>" . htmlspecialchars($fullAddress) . "</td>";
//             echo "<td><a href='mailto:" . htmlspecialchars($branch['contact_email']) . "'>" . htmlspecialchars($branch['contact_email']) . "</a></td>";
//             echo "<td><a href='tel:" . htmlspecialchars($branch['contact_phone']) . "'>" . htmlspecialchars($branch['contact_phone']) . "</a></td>";
            
//             // Status badge based on branch state
//             $state = strtoupper($branch['state']);
//             if ($state === "ACTIVE") {
//                 echo "<td><span class='badge bg-label-success me-1'>Active</span></td>";
//             } elseif ($state === "DISABLED") {
//                 echo "<td><span class='badge bg-label-danger me-1'>Disabled</span></td>";
//             } elseif ($state === "SUSPENDED") {
//                 echo "<td><span class='badge bg-label-secondary me-1'>Suspended</span></td>";
//             } else {
//                 echo "<td><span class='badge bg-label-info me-1'>" . htmlspecialchars($branch['state']) . "</span></td>";
//             }
            
//             // Total transactions (assuming this is stored or calculated; use a placeholder if not)
//             echo "<td>" . htmlspecialchars($branch['total_transactions'] ?? "0") . "</td>";
            
//             // Creation time (assumed to be inserted_at column)
//             echo "<td>" . htmlspecialchars($branch['inserted_at']) . "</td>";
            
//             // Action dropdown
//             echo "<td>
//                     <div class='dropdown'>
//                         <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
//                             <i class='bx bx-dots-vertical-rounded'></i>
//                         </button>
//                         <div class='dropdown-menu'>
//                             <a class='dropdown-item' href='edit_branch.php?ext_id=" . urlencode($branch['ext_id']) . "'>
//                                 <i class='bx bx-edit-alt me-1'></i> Edit
//                             </a>
//                             <a class='dropdown-item' href='view_branch.php?ext_id=" . urlencode($branch['ext_id']) . "'>
//                                 <i class='bx bx-book-open me-1'></i> View More
//                             </a>
//                             <a class='dropdown-item' href='delete_branch.php?ext_id=" . urlencode($branch['ext_id']) . "'>
//                                 <i class='bx bx-trash me-1'></i> Delete
//                             </a>
//                         </div>
//                     </div>
//                 </td>";
//             echo "</tr>";
//         }
//     } else {
//         echo "<tr><td colspan='9'>No branches found.</td></tr>";
//     }

// ?>

<div class="table-responsive text-nowrap">
  <table class="table">
    <thead>
      <tr>
        <th>Branch/ext ID</th>
        <th>Name</th>
        <th>Address</th>
        <th>Contact Email</th>
        <th>Contact Phone</th>
        <th>Status</th>
        <th>Total transactions</th>
        <th>Creation time</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      if ($branches && count($branches) > 0) {
          foreach ($branches as $branch) {
              echo "<tr>";
              echo "<td>" . htmlspecialchars($branch['ext_id']) . "</td>";
              echo "<td><i class='fab fa-angular fa-lg text-danger me-3'></i> <strong>" . htmlspecialchars($branch['name']) . "</strong></td>";
              
              // Combine address fields
              $fullAddress = trim(
                $branch['address_line1'] . ", " . 
                $branch['address_city'] . ", " . 
                $branch['address_zip'] . ", " . 
                $branch['address_country']
              );
              echo "<td>" . htmlspecialchars($fullAddress) . "</td>";
              
              echo "<td><a href='mailto:" . htmlspecialchars($branch['contact_email']) . "'>" . htmlspecialchars($branch['contact_email']) . "</a></td>";
              echo "<td><a href='tel:" . htmlspecialchars($branch['contact_phone']) . "'>" . htmlspecialchars($branch['contact_phone']) . "</a></td>";
              
              // Status badge based on branch state
              $state = strtoupper($branch['state']);
              if ($state === "ACTIVE") {
                  echo "<td><span class='badge bg-label-success me-1'>Active</span></td>";
              } elseif ($state === "DISABLED") {
                  echo "<td><span class='badge bg-label-danger me-1'>Disabled</span></td>";
              } elseif ($state === "SUSPENDED") {
                  echo "<td><span class='badge bg-label-secondary me-1'>Suspended</span></td>";
              } else {
                  echo "<td><span class='badge bg-label-info me-1'>" . htmlspecialchars($branch['state']) . "</span></td>";
              }
              
              // Total transactions (assuming stored or calculated; use a placeholder if not)
              echo "<td>" . htmlspecialchars($branch['total_transactions'] ?? "0") . "</td>";
              
              // Creation time (assumed to be in the inserted_at field)
              echo "<td>" . htmlspecialchars($branch['inserted_at']) . "</td>";
              
              // Action dropdown
              echo "<td>
                      <div class='dropdown'>
                          <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                              <i class='bx bx-dots-vertical-rounded'></i>
                          </button>
                          <div class='dropdown-menu'>
                              <a class='dropdown-item' href='edit_branch.php?ext_id=" . urlencode($branch['ext_id']) . "'>
                                  <i class='bx bx-edit-alt me-1'></i> Edit
                              </a>
                              <a class='dropdown-item' href='view_branch.php?ext_id=" . urlencode($branch['ext_id']) . "'>
                                  <i class='bx bx-book-open me-1'></i> View More
                              </a>
                              <a class='dropdown-item' href='delete_branch.php?ext_id=" . urlencode($branch['ext_id']) . "'>
                                  <i class='bx bx-trash me-1'></i> Delete
                              </a>
                          </div>
                      </div>
                    </td>";
              echo "</tr>";
          }
      } else {
          echo "<tr><td colspan='9'>No branches found.</td></tr>";
      }
      ?>
    </tbody>
    <tfoot class="table-border-bottom-0">
      <tr>
        <th>Branch/ext ID</th>
        <th>Name</th>
        <th>Address</th>
        <th>Contact Email</th>
        <th>Contact Phone</th>
        <th>Status</th>
        <th>Total transactions</th>
        <th>Creation time</th>
        <th>Action</th>
      </tr>
    </tfoot>
  </table>
</div>


<script>
  // Load country codes dynamically
  fetch("../public/assets/json/country_codes.json")
    .then((response) => response.json())
    .then((data) => {
      let countryDropdown = document.getElementById("branch_country");
      data.forEach((country) => {
        let option = document.createElement("option");
        option.value = `${country.code}`;
        option.textContent = `${country.name} (${country.code})`;
        countryDropdown.appendChild(option);
      });
    })
    .catch((error) => console.error("Error loading country codes:", error));


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

<?php
    include 'include/footer.php';
>>>>>>> cb2db00 (Initial commit)
    ?>