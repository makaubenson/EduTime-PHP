<?php
include 'server.php';
?>

<!doctype html>
<html lang="en">

<head>
    <?php
   include './components/head.php';
   ?>
    <title>Maseno | Timetabling</title>
</head>

<body style="background-color:#d2d6de">
    <div class="container">

        <div class="row mt-5 ml-1 mr-1">
            <div class="col-md-3"></div>
            <div class="col-md-6 mt-5 text-center text-light" style="background-color:#00a7d0">
                <img src="./static/images/logo.png" class="img-fluid" height="120" width="120" />
                <h2 class="text-center">Staff Login</h2>
            </div>
            <div class="col-md-3"></div>
        </div>

        <!--Login form -->
        <div class="row ml-1 mr-1 mb-4">
            <div class="col-md-3"></div>
            <div class="col-md-6 p-3" style="background-color:#ffff">
                <form method="POST" action="server.php">
                    <div class="form-group">
                        <label for="exampleInputEmail1">PF Number</label>
                        <input type="text" name="pf_number" class="form-control" id="pf-number"
                            aria-describedby="emailHelp" placeholder="PF Number" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label><br>
                        <input type="password" name="staff_password" class="form-control" id="password"
                            placeholder="Password" required>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="checked" id="togglePasswordCheckBox">
                        <label class="form-check-label" for="showPass">
                            Show password
                        </label>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <a name="reset_password_btn" href="forgot-password.php"
                                class="text-success m-2 btn-block">Forgot
                                Password?</a>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-5">
                            <button type="submit" name="login_btn" class="btn btn-info btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-3"></div>

        </div>
    </div>

    <?php
include "./components/script.php";
?>

</body>

</html>