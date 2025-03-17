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
  if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
  // Redirect back if temp_email is not set
  if (!isset($_SESSION['temp_email'])) {
    header("Location: signup");
    exit;
  }
  $tempEmail = $_SESSION['temp_email'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Bow-bow merchant-signup</title>
    <!-- Mobile Specific Metas -->
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, maximum-scale=1"
    />
    <!-- Font-->
    <link
      rel="stylesheet"
      type="text/css"
      href="../assets/css/montserrat-font.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="../public/assets/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css"
    />
    <!-- Main Style Css -->
    <link rel="stylesheet" href="../public/assets/css/style.css" />
    <link rel="stylesheet" href="../public/assets/css/bootstrap.min.css">
  </head>
  <body class="form-v10">
<?php if (isset($_SESSION['message'])): ?>
    <?= $_SESSION['message']; ?>
    <?php unset($_SESSION['message']); ?> <!-- Clear message after displaying -->
<?php endif; ?>
    <div class="page-content">
      <div class="form-v10-content">
        <form class="form-detail" action="merchant/process-signup" method="POST" id="merchant-signup">
          <div class="form-left">
            <h2>General Infomation</h2>
            <div class="form-row">
              <!-- <label for="mcc">Select Your Business Category:</label> -->
              <select name="mcc" id="mcc" required>
                <option class="option" value="" required>
                  -- Select Your Business Category: --
                </option>
              </select>
              <span class="select-btn">
                <i class="zmdi zmdi-chevron-down"></i>
              </span>
            </div>
            <div class="form-row">
              <input
                type="text"
                name="Merchant_name"
                class="Merchant_name"
                id="Merchant_name"
                placeholder="Merchant Name"
                required
              />
            </div>
            <div class="form-group">
              <div class="form-row form-row-3">
                <select name="state">
                  <option value="active">Active</option>
                  <option value="disabled">Disabled</option>
                  <option value="suspended">Suspended</option>
                </select>
                <span class="select-btn">
                  <i class="zmdi zmdi-chevron-down"></i>
                </span>
              </div>
            </div>
            <div class="form-text">
              <h2>
                <a href="#" class="add-info-link"
                  ><i class="zmdi zmdi-chevron-right"></i>Contact Details</a
                >
              </h2>
              <div class="add_info" style="display: none">
                <div class="form-group">
                  <div class="form-row form-row-1">
                    <input
                      type="text"
                      name="first_name"
                      id="first_name"
                      class="input-text"
                      placeholder="First Name"
                      required
                    />
                  </div>
                  <div class="form-row form-row-2">
                    <input
                      type="text"
                      name="last_name"
                      id="last_name"
                      class="input-text"
                      placeholder="Last Name"
                      required
                    />
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-radio form-row form-row-1">
                    <!-- <label for="gender">Gender</label> -->
                    <div class="form-flex">
                      <input
                        type="radio"
                        name="gender"
                        value="male"
                        id="male"
                        checked="checked"
                      />
                      <label for="male">Male</label>

                      <input
                        type="radio"
                        name="gender"
                        value="female"
                        id="female"
                      />
                      <label for="female">Female</label>
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <select name="position">
                    <option value="position">Position</option>
                    <option value="director">Director</option>
                    <option value="manager">Manager</option>
                    <option value="employee">Employee</option>
                    <option value="CEO">CEO</option>
                    <option value="Founder">Founder</option>
                    <option value="CO-founder">CO-founder</option>
                  </select>
                  <span class="select-btn">
                    <i class="zmdi zmdi-chevron-down"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="form-right">
            <h2>Address Details</h2>
            <div class="form-row">
              <input
                type="text"
                name="street"
                class="street"
                id="street"
                placeholder="Merchant Address"
                required
              />
            </div>
            <div class="form-row">
              <input
                type="text"
                name="additional"
                class="additional"
                id="additional"
                placeholder="Additional Information"
                required
              />
            </div>
            <div class="form-group">
              <div class="form-row form-row-1">
                <input
                  type="text"
                  name="zip"
                  class="zip"
                  id="zip"
                  placeholder="Zip Code"
                  required
                />
              </div>
              <div class="form-row form-row-2">
                <select name="place">
                  <option value="place">Place</option>
                  <option value="Street">Street</option>
                  <option value="District">District</option>
                  <option value="City">City</option>
                </select>
                <span class="select-btn">
                  <i class="zmdi zmdi-chevron-down"></i>
                </span>
              </div>
            </div>
            <div class="form-row">
              <select name="country" id="country">
                <option value="country">Country</option>
              </select>
              <span class="select-btn">
                <i class="zmdi zmdi-chevron-down"></i>
              </span>
            </div>
            <div class="form-group">
              <div class="form-row form-row-1">
                <select name="code" id="code" class="code" required>
                  <option value="code +">code +</option>
                </select>
              </div>
              <div class="form-row form-row-2">
                <input
                  type="number"
                  name="phone"
                  class="phone"
                  id="phone"
                  placeholder="Merchant Number"
                  pattern="(\d{3}-\d{3}-\d{4}|\d{10})"
                  required
                />
              </div>
            </div>
            <!-- Email is pre-filled and disabled -->
            <div class="form-row">
              <input
                type="text"
                name="merchant_email"
                id="merchant_email"
                class="input-text"
                required
                pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}"
                placeholder="Merchant Email"
                value="<?= htmlspecialchars($tempEmail); ?>"
                disabled
              />
            </div>
            <div class="form-checkbox">
              <label class="container"
                ><p>
                  I do accept the
                  <a href="#" class="text">Terms and Conditions</a> of your
                  site.
                </p>
                <input type="checkbox" name="checkbox" required/>
                <span class="checkmark" required></span>
              </label>
            </div>
            <div class="form-row-last">
              <input
                type="submit"
                name="register"
                class="register"
                value="Register Badge"
              />
            </div>
          </div>
        </form>
      </div>
    </div>

    <script>
      document
        .querySelector(".add-info-link")
        .addEventListener("click", function (event) {
          event.preventDefault(); // Prevent page from jumping

          let addInfoDiv = document.querySelector(".add_info");
          if (
            addInfoDiv.style.display === "none" ||
            addInfoDiv.style.display === ""
          ) {
            addInfoDiv.style.display = "block";
          } else {
            addInfoDiv.style.display = "none"; // Hide again if clicked
          }
        });

      // Load MCC codes dynamically
      fetch("../public/assets/json/mcc_codes.json")
        .then((response) => response.json())
        .then((data) => {
          let mccDropdown = document.getElementById("mcc");
          data.forEach((mcc) => {
            let option = document.createElement("option");
            option.value = `${mcc.code}`;
            option.textContent = `${mcc.description} (${mcc.code})`;
            mccDropdown.appendChild(option);
          });
        })
        .catch((error) => console.error("Error loading MCC codes:", error));

      // Load country codes dynamically
      fetch("../public/assets/json/country_codes.json")
        .then((response) => response.json())
        .then((data) => {
          let countryDropdown = document.getElementById("country");
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
