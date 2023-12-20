<!DOCTYPE html>
<?php require_once("config.php"); ?>
<html>
  <head>
    <title>Sign Up page</title>
    <link rel="stylesheet" href="style.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
  </head>
  <body>
   
    <section id="pageLogin" class="body-login h-100 d-flex flex-column m-0">
      
    <div class="card card-login mx-auto my-auto">
    <?php
$validationPassed = true; // Assume validation is successful
$error = []; // Initialize the $error array

if (isset($_POST['signup'])) {
    extract($_POST);

    // Check first name length
    if (strlen($firstName) < 3) {
        $validationPassed = false;
        $error[] = 'Please enter at least 3 characters for the first name';
    }

    // Check last name length
    if (strlen($lastName) < 3 || strlen($lastName) > 20) {
        $validationPassed = false;
        $error[] = 'Please enter between 3 and 20 characters for the last name';
    }

    // Check roll number length
    if (strlen($roll) !== 7) {
        $validationPassed = false;
        $error[] = 'Roll number must be 7 characters long';
    }

    // Check username length
    if (strlen($userName) < 3 || strlen($userName) > 20) {
        $validationPassed = false;
        $error[] = 'Please enter between 3 and 20 characters for the username';
    }

    // Add more validation checks if needed

    if ($validationPassed && empty($error)) {
        $sql = "SELECT * FROM users WHERE (username = '$userName' OR email = '$userEmail');";
        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);

            if ($userName == $row['username']) {
                $error[] = "User already exists";
            }
            if ($userEmail == $row['email']) {
                $error[] = "Email already exists";
            }
        }

        if (empty($error)) {
            $result = mysqli_query($conn, "INSERT INTO users VALUES(NULL, '$firstName', '$lastName', '$userName', '$userEmail', '$userPassword', $roll);");

            if ($result) {
              $error[] = 'Registered succesfully, go to login page';
                $done = 2;
            } else {
                $error[] = 'Something went wrong';
            }
        }
    }
}

        
      

    ?>
        <div class="card-header">Sign Up</div>
        <div class="login-logo mt-2">
          <img
            style="
              content: url(https://fcs.fcrit.ac.in/dist/img/fcritlogo.webp);
            "
            width="65"
            height="60"
          />
          <span style="font-weight: 700">Campus</span> Events Service
        </div>

        <div class="card-body p-4">
          <h3 class="card-title mb-4">Welcome</h3>
          <form method="POST" action="">

            <div class="form-group">
              <input
                id="firstName"
                name="firstName"
                class="form-control"
                placeholder="First Name"
                value=""
                required=""
                type="text"
              />
            </div>
            <div class="form-group">
              <input
                id="lastName"
                name="lastName"
                class="form-control"
                placeholder="Last Name"
                value=""
                required=""
                type="text"
              />
            </div>
            <div class="form-group">
              <input
                id="roll"
                name="roll"
                class="form-control"
                placeholder="Roll Number"
                value=""
                required=""
                type="text"
              />
            </div>
            <div class="form-group">
              <input
                id="userName"
                name="userName"
                class="form-control"
                placeholder="Username"
                value=""
                required=""
                type="text"
              />
            </div>
            <div class="form-group">
              <input
                id="userEmail"
                name="userEmail"
                class="form-control"
                placeholder="Email"
                value=""
                required=""
                type="email"
              />
            </div>
            <div class="form-group">
              <input
                id="userPassword"
                name="userPassword"
                class="form-control"
                placeholder="Password"
                required=""
                type="password"
              />
            </div>
            <div class="form-group mt-4 mb-2">
              <button type="submit" name = "signup" class="btn btn-primary btn-group-lg form button">
                Sign Up
              </button>
            </div>
            <div class="form-group mt-0">
              <a class="btn btn-link" href="login.php">
                <i class="zmdi zmdi-plus-square mr-2"></i>Already have an
                account?
              </a>
              <a class="btn btn-link" href="/password/reset">
                <i class="zmdi zmdi-help mr-2"></i>Forgot Password?
              </a>
            </div>
            <?php
            // 
            if(isset($error))
            {
              foreach($error as $err)
              {
                echo '<p class = "errmsg">&#x26A0;'.$err.'</p>';
              }
            }
            ?>
          </form>
        </div>
      </div>
    </section>
  </body>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"
  ></script>
</html>
