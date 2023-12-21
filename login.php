<!DOCTYPE html>
<?php require_once("config.php"); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <style>
        section.body-login {
            background-image: url("https://fcs.fcrit.ac.in/dist/img/background-image.webp");
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            height: 100vh;
        }

        .card-login {
            max-width: 20rem;
            min-width: 15rem;
            width: 100%;
        }

        .errmsg {
            margin: 2px auto;
            border-radius: 5px;
            border: 1px solid red;
            background: pink;
            text-align: left;
            color: brown;
            padding: 1px;
        }
    </style>
</head>
<body>
    <section id="pageLogin" class="body-login d-flex flex-column m-0">
        <div class="card card-login mx-auto my-auto">
            <?php
                if(isset($_GET['loginerror'])){
                    $loginerror = $_GET['loginerror'];
                }
            ?>
            <div class="card-header">Login</div>
            <div class="login-logo mt-2">
                <img style="content: url(https://fcs.fcrit.ac.in/dist/img/fcritlogo.webp);" width="65" height="60" />
                <span style="font-weight: 700">Campus</span> Events Service
            </div>
            <div class="card-body p-4">
                <h3 class="card-title mb-4">Welcome Back!</h3>
                <?php
                    if(!empty($loginerror)){
                        echo '<p class="errmsg"> Invalid Credentials </p>';
                    }
                ?>
                <form method="POST" action="login_process.php">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="zmdi zmdi-email"></i>
                            </div>
                            <input id="email" name="login_var" class="form-control" placeholder="Email or Username" value="<?php if(!empty($loginerror)){echo $loginerror;} ?>" required="" autofocus="" type="text" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="zmdi zmdi-lock"></i>
                            </div>
                            <input id="password" name="password" class="form-control" placeholder="Password" required="" type="password" />
                        </div>
                    </div>
                    <div class="form-group mt-4 mb-2">
                        <button type="submit" name="sub-login" class="btn btn-primary btn-login">
                            Login
                        </button>
                    </div>
                    <div class="form-group mt-0">
                        <a class="btn btn-link" href="signup.php">
                            <i class="zmdi zmdi-plus-square mr-2"></i>Register
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
