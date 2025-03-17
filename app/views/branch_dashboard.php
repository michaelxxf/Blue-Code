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
if (isset($_SESSION['branch_id'])) {
  $branchModel = new Branch();
  $branch = $branchModel->getById($_SESSION['branch_id']);
  
  $userModel = new User();
  $user = $userModel->getById($branch['ext_id']);
  
}
?>

<?php
    include 'include/header.php';
    include 'include/nav.php';
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>

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
                <span class="fw-semibold d-block mb-1">Total Transaction</span>
                <h3 class="card-title mb-2">364</h3>
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
                <span class="fw-semibold d-block mb-1">Bounce Rate</span>
                <h3 class="card-title mb-2">Transaction cancels and Failures</h3>
                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> 1.53%</small>
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
                <span class="fw-semibold d-block mb-1">Total Revenue</span>
                <h3 class="card-title mb-2">&#x20A6;14,857,567</h3>
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
                <span class="fw-semibold d-block mb-1">Chat Messages</span>
                <h3 class="card-title mb-2 bx bx-chat">5</h3>
              </div>
            </div>
          </div>
    </div>
</div>

<!-- Create Transaction form -->
<form action="branch/payment" method="POST">
  <div class="text-center my-4">
    <label for="amount" class="form-label">Amount</label>
    <input name="amount" id="amount" type="number" class="form-control" required>
      <button
          type="button"
          class="btn btn-primary"
          data-bs-toggle="modal"
          data-bs-target="#addBranchModal"
      >
          Make payment
      </button>
  </div>
  <div class="modal fade" id="addBranchModal" tabindex="-1" aria-hidden="true" style="display: none">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              
              <div class="modal-body">
                  <div class="row">
                      <div class="mb-3">
                          <label class="form-label">Customer Email</label>
                          <input type="text" class="form-control" placeholder="Email to recieve reciept " name="customer_email">
                      </div>
                      <div class="mb-3 col-md-6">
                          <label for="token" class="form-label">Transaction Token</label>
                          <input class="form-control" type="text" id="token" name="token" value="Customer's Bar code"  required autofocus/>
                      </div>
                      <div class="mb-3 col-md-6">
                          <!-- Button to open camera and scan bar code-->
                          <label>Or Scan Bar code</label>
                          <button type="button" class="btn btn-primary" id="scan-bar-code">Scan Bar Code</button>
                          
                          <!-- Video container to show live camera feed and a close button -->
                          <div id="video-container">
                            <video id="video" autoplay muted><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></video>
                            <button type="button" id="close-camera">Close Camera</button>
                          </div>
                          <!-- Container to display the result -->
                          <div id="result"></div>
                      </div>
                      </div>
                      <div class="mb-3">
                          <label for="terminal" class="form-label">Terminal</label>
                          <input class="form-control" type="text" id="terminal" name="terminal" value="Payment Terminal" autofocus/>
                      </div>
                      <div class="mb-3">
                          <label for="Currency" class="form-label">Currency</label>
                          <select id="state" name="state" class="select2 form-select">
                              <option value=" ">NGN</option>
                              <option value=" ">USD</option>
                          </select>
                      </div>
                      <div class="modal-footer">
                          <button
                              class="btn btn-primary"
                              data-bs-target="#modalToggle2"
                              data-bs-toggle="modal"
                              data-bs-dismiss="modal"
                          >
                              Submit
                          </button>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!--Second Modal to display status of payment in real time-->
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
              <h5 class="modal-title" id="modalToggleLabel2">Payment Status</h5>
              <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
              ></button>
              </div>
              <div class="modal-body">
                  <div class="mb-3">
                      <label class="form-label" for="branch_address" value="" disabled>Payment Status: </label>
                      <div class="input-group input-group-merge">
                          <span id="" class="input-group-text" data-bs-toggle="tooltip">
                              <i class="bi bi-patch-question"></i>
                          </span>                          
                          <input type="text" id="branch_address" name="branch_address" class="form-control required"
                              placeholder="NO 1 nowhere street" aria-label="NO 1 nowhere street" required/>
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
                    Retry
                  </button>
                  <button type="submit" class="btn btn-success">Send Reciept</button>
              </div>
        </div>
      </div>
  </div>
</form>
          

<!-- Branch Table-->

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
</div>

<script>
  // Variable to store the camera stream globally so we can stop it later
  let currentStream = null;

// Handler for "Scan Bar Code" button click
document.getElementById('scan-bar-code').addEventListener('click', function() {
  // Show the video container when the button is clicked
  document.getElementById('video-container').style.display = 'block';

  // Check if the browser supports getUserMedia
  if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
      .then(function(stream) {
        currentStream = stream; // Store stream for later stop
        const video = document.getElementById('video');
        video.srcObject = stream;
        video.play();

        // Initialize Quagga for live barcode scanning
        Quagga.init({
          inputStream: {
            name: "Live",
            type: "LiveStream",
            target: video, // Use the video element as target
          },
          decoder: {
            // Specify barcode types to decode
            readers: [
              "code_128_reader",
              "ean_reader",
              "ean_8_reader",
              "code_39_reader",
              "code_39_vin_reader",
              "upc_reader",
              "upc_e_reader",
              "codabar_reader",
              "i2of5_reader"
            ]
          }
        }, function(err) {
          if (err) {
            console.error("Quagga init error:", err);
            return;
          }
          console.log("Quagga initialization finished. Ready to start");
          Quagga.start();
        });

        // Listen for detected barcodes
        Quagga.onDetected(function(result) {
          const code = result.codeResult.code;
          document.getElementById('result').innerText = "Barcode detected: " + code;
          // Stop Quagga and the camera stream after detection
          Quagga.stop();
          if (currentStream) {
            currentStream.getTracks().forEach(track => track.stop());
          }
          // Hide the video container again
          document.getElementById('video-container').style.display = 'none';
        });
      })
      .catch(function(err) {
        console.error("Error accessing camera: " + err);
        alert("Error accessing camera: " + err);
      });
  } else {
    alert("getUserMedia is not supported in this browser.");
  }
});

// Handler for "Close Camera" button click
document.getElementById('close-camera').addEventListener('click', function() {
  // Stop the camera stream
  if (currentStream) {
    currentStream.getTracks().forEach(track => track.stop());
  }
  // Stop Quagga scanning if active
  if (typeof Quagga !== "undefined") {
    Quagga.stop();
  }
  // Hide the video container
  document.getElementById('video-container').style.display = 'none';
  document.getElementById('result').innerText = "Camera closed.";
});
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
    ?>
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
if (isset($_SESSION['branch_id'])) {
  $branchModel = new Branch();
  $branch = $branchModel->getById($_SESSION['branch_id']);
  
  $userModel = new User();
  $user = $userModel->getById($branch['ext_id']);
  
}
?>

<?php
    include 'include/header.php';
    include 'include/nav.php';
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>

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
                <span class="fw-semibold d-block mb-1">Total Transaction</span>
                <h3 class="card-title mb-2">364</h3>
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
                <span class="fw-semibold d-block mb-1">Bounce Rate</span>
                <h3 class="card-title mb-2">Transaction cancels and Failures</h3>
                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> 1.53%</small>
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
                <span class="fw-semibold d-block mb-1">Total Revenue</span>
                <h3 class="card-title mb-2">&#x20A6;14,857,567</h3>
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
                <span class="fw-semibold d-block mb-1">Chat Messages</span>
                <h3 class="card-title mb-2 bx bx-chat">5</h3>
              </div>
            </div>
          </div>
    </div>
</div>

<!-- Create Transaction form -->
<form action="branch/payment" method="POST">
  <div class="text-center my-4">
    <label for="amount" class="form-label">Amount</label>
    <input name="amount" id="amount" type="number" class="form-control" required>
      <button
          type="button"
          class="btn btn-primary"
          data-bs-toggle="modal"
          data-bs-target="#addBranchModal"
      >
          Make payment
      </button>
  </div>
  <div class="modal fade" id="addBranchModal" tabindex="-1" aria-hidden="true" style="display: none">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              
              <div class="modal-body">
                  <div class="row">
                      <div class="mb-3">
                          <label class="form-label">Customer Email</label>
                          <input type="text" class="form-control" placeholder="Email to recieve reciept " name="customer_email">
                      </div>
                      <div class="mb-3 col-md-6">
                          <label for="token" class="form-label">Transaction Token</label>
                          <input class="form-control" type="text" id="token" name="token" value="Customer's Bar code"  required autofocus/>
                      </div>
                      <div class="mb-3 col-md-6">
                          <!-- Button to open camera and scan bar code-->
                          <label>Or Scan Bar code</label>
                          <button type="button" class="btn btn-primary" id="scan-bar-code">Scan Bar Code</button>
                          
                          <!-- Video container to show live camera feed and a close button -->
                          <div id="video-container">
                            <video id="video" autoplay muted><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></video>
                            <button type="button" id="close-camera">Close Camera</button>
                          </div>
                          <!-- Container to display the result -->
                          <div id="result"></div>
                      </div>
                      </div>
                      <div class="mb-3">
                          <label for="terminal" class="form-label">Terminal</label>
                          <input class="form-control" type="text" id="terminal" name="terminal" value="Payment Terminal" autofocus/>
                      </div>
                      <div class="mb-3">
                          <label for="Currency" class="form-label">Currency</label>
                          <select id="state" name="state" class="select2 form-select">
                              <option value=" ">NGN</option>
                              <option value=" ">USD</option>
                          </select>
                      </div>
                      <div class="modal-footer">
                          <button
                              class="btn btn-primary"
                              data-bs-target="#modalToggle2"
                              data-bs-toggle="modal"
                              data-bs-dismiss="modal"
                          >
                              Submit
                          </button>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!--Second Modal to display status of payment in real time-->
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
              <h5 class="modal-title" id="modalToggleLabel2">Payment Status</h5>
              <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
              ></button>
              </div>
              <div class="modal-body">
                  <div class="mb-3">
                      <label class="form-label" for="branch_address" value="" disabled>Payment Status: </label>
                      <div class="input-group input-group-merge">
                          <span id="" class="input-group-text" data-bs-toggle="tooltip">
                              <i class="bi bi-patch-question"></i>
                          </span>                          
                          <input type="text" id="branch_address" name="branch_address" class="form-control required"
                              placeholder="NO 1 nowhere street" aria-label="NO 1 nowhere street" required/>
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
                    Retry
                  </button>
                  <button type="submit" class="btn btn-success">Send Reciept</button>
              </div>
        </div>
      </div>
  </div>
</form>
          

<!-- Branch Table-->

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
</div>

<script>
  // Variable to store the camera stream globally so we can stop it later
  let currentStream = null;

// Handler for "Scan Bar Code" button click
document.getElementById('scan-bar-code').addEventListener('click', function() {
  // Show the video container when the button is clicked
  document.getElementById('video-container').style.display = 'block';

  // Check if the browser supports getUserMedia
  if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
      .then(function(stream) {
        currentStream = stream; // Store stream for later stop
        const video = document.getElementById('video');
        video.srcObject = stream;
        video.play();

        // Initialize Quagga for live barcode scanning
        Quagga.init({
          inputStream: {
            name: "Live",
            type: "LiveStream",
            target: video, // Use the video element as target
          },
          decoder: {
            // Specify barcode types to decode
            readers: [
              "code_128_reader",
              "ean_reader",
              "ean_8_reader",
              "code_39_reader",
              "code_39_vin_reader",
              "upc_reader",
              "upc_e_reader",
              "codabar_reader",
              "i2of5_reader"
            ]
          }
        }, function(err) {
          if (err) {
            console.error("Quagga init error:", err);
            return;
          }
          console.log("Quagga initialization finished. Ready to start");
          Quagga.start();
        });

        // Listen for detected barcodes
        Quagga.onDetected(function(result) {
          const code = result.codeResult.code;
          document.getElementById('result').innerText = "Barcode detected: " + code;
          // Stop Quagga and the camera stream after detection
          Quagga.stop();
          if (currentStream) {
            currentStream.getTracks().forEach(track => track.stop());
          }
          // Hide the video container again
          document.getElementById('video-container').style.display = 'none';
        });
      })
      .catch(function(err) {
        console.error("Error accessing camera: " + err);
        alert("Error accessing camera: " + err);
      });
  } else {
    alert("getUserMedia is not supported in this browser.");
  }
});

// Handler for "Close Camera" button click
document.getElementById('close-camera').addEventListener('click', function() {
  // Stop the camera stream
  if (currentStream) {
    currentStream.getTracks().forEach(track => track.stop());
  }
  // Stop Quagga scanning if active
  if (typeof Quagga !== "undefined") {
    Quagga.stop();
  }
  // Hide the video container
  document.getElementById('video-container').style.display = 'none';
  document.getElementById('result').innerText = "Camera closed.";
});
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
    ?>
>>>>>>> cb2db00 (Initial commit)
