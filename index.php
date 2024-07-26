<?php
include_once 'config.php';
if(!empty($_SESSION['uid'])){
 header('location:'.SITEURL.'teacher/');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="login-container">
        <div class="logo">tailwebs</div>
        <div class="login-form">
            <form id="loginForm">
                <h2 style="text-align:center;">Login</h2>
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-container">
                        <span class="icon"><i class="fa-regular fa-user"></i></span>
                        <input type="text" id="username" name="username" value="" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-container">
                        <span class="icon"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" id="password" name="password" value="" required>
                        <button type="button" class="toggle-password">
                            <img<i class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group">
                     <a href="#" class="forgot-password">Forgot Password?</a>
                </div>

                    <button type="submit" class="login-button">Login</button>
            </form>
        </div>
    </div>
  <script src="assets/js/login.js"></script>
</body>

</html>