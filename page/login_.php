<?php
session_start();
include('../db/connect.php')
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIEN RESTAURANT</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/webstyle.css">
    <link rel="stylesheet" href="../assets/css/login.css">
    <!-- <link rel="stylesheet" href="../frontend/res.css"> -->
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-5.15.4-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrer-policy="no-referrer" />
    <script>
        src = "https://kit.fontawesome.com/54f0cb7e4a.js";
        crossorigin = "anonymous"
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<body style="background-color: #1e3d59;">

    <div class="container">
        <a href="index.php"><span class="close" style="color: black;" title="Close Modal">&times;</span></a>
        <form class="login100-form validate-form flex-sb flex-w" action="./index.php" method="post">
            <span class="login100-form-title p-b-53">
                Sign In With
            </span>
            <div class="orther-btn">
                <a href="#" class="btn-face m-b-20">
                    <i class="fab fa-facebook"></i>
                    Facebook
                </a>
                <a href="#" class="btn-google m-b-20">
                    <img src="../image/icon-google.png" alt="Google">
                    Google
                </a>
            </div>
            <div class="p-t-31 p-b-9">
                <span class="txt1">
                    Username
                </span>
            </div>
            <div class="wrap-input100 validate-input" data-validate="Username is required">
                <input class="input100" type="text" name="kh_user" required>
                <span class="focus-input100"></span>
            </div>

            <div class="p-t-13 p-b-9">
                <span class="txt1">
                    Password
                </span>
                <a href="forgotpass.php" class="txt2 bo1 m-l-5">
                    Forgot?
                </a>
            </div>
            <div class="wrap-input100 validate-input" data-validate="Password is required">
                <input class="input100" type="password" name="kh_password" required>
                <span class="focus-input100"></span>
            </div>

            <div class="container-login100-form-btn ">
                <button type="submit" class="login100-form-btn" name="dangnhap_home">Log In</button>
            </div>

            <div class="w-full text-center p-t-55">
                <span class="txt2">
                    Not a member?
                </span>
                <a href="register.php" class="txt2 bo1">
                    Sign up now
                </a>
            </div>
        </form>
    </div>
</body>