<?php
session_start();
include('../db/connect.php')
?>
<?php
if (isset($_POST['dangky_home'])) {
    $kh_user = $_POST['kh_user'];
    $kh_password = md5($_POST['kh_password']);
    $kh_fullname = $_POST['kh_fullname'];
    $kh_sdt = $_POST['kh_sdt'];
    $kh_email = $_POST['kh_email'];

    $check = mysqli_query($con, "SELECT*FROM tbl_acckh WHERE kh_email='$kh_email' or kh_user='$kh_user'");
    $count = mysqli_num_rows($check);
    $check = mysqli_query($con, "SELECT*FROM tbl_acckh WHERE kh_email='$kh_email'");
    $count1 = mysqli_num_rows($check);
    $check = mysqli_query($con, "SELECT*FROM tbl_acckh WHERE kh_user='$kh_user'");
    $count2 = mysqli_num_rows($check);
    if ($count > 0) {
        if ($count1 > 0 && $count2 > 0) {
            echo '<script language="javascript">';
            echo 'alert("Email and ID has already been used!")';
            echo '</script>';
        }

        if ($count1 > 0 && $count2  <= 0) {
            echo '<script language="javascript">';
            echo 'alert("Email has already been used!")';
            echo '</script>';
        }
        if ($count2 > 0 && $count1  <= 0) {
            echo '<script language="javascript">';
            echo 'alert("ID has already been used!")';
            echo '</script>';
        }
    } else {
        $sql_insert_dangky = mysqli_query($con, "INSERT INTO tbl_acckh(kh_user,kh_password,kh_fullname,kh_sdt,kh_email)
        values('$kh_user','$kh_password','$kh_fullname','$kh_sdt','$kh_email')");
        //$check = mysqli_query($con, $sql_insert_dangky);
        //$check = $sql_insert_dangky;
        echo '<script language="javascript">';
        echo 'alert("Bạn đã đăng ký thành công!")';
        echo '</script>';
        echo '<meta http-equiv="refresh" content="0;url=index.php">';
    }
}

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
        <form class="modal-content" method="post">
            <h1>Welcome To Kien Restaurant</h1>
            <p>Please fill in this form to create an account.</p>
            <hr>
            <div class="signup-input">
                <input type="text" placeholder="Full name" name="kh_fullname" required>
                <input type="text" placeholder="Enter your phone" name="kh_sdt" required>
                <input type="text" placeholder="Enter your mail" name="kh_email" required>
                <input type="text" placeholder="Enter user name" name="kh_user" required>
                <input type="password" placeholder="Enter password" name="kh_password" required>
                <input type="password" placeholder="Repeat password" name="kh_repeatps" required>
            </div>

            <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms &
                    Privacy</a>.</p>

            <div class="clearfix">
                <a href="index.php"><button type="button" class="cancelbtn">Cancel</button></a>
                <button type="submit" class="signupbtn" name="dangky_home">Sign Up</button>
            </div>
        </form>
    </div>

    <script src="../assets/js/webscript.js"></script>
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>

    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId: 'Login_KR',
                cookie: true,
                xfbml: true,
                version: '{api-version}'
            });

            FB.AppEvents.logPageView();

        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
        });
    </script>
</body>