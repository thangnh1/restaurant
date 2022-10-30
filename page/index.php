<?php
session_start();
include('../db/connect.php')
?>
<?php
/*if(isset($_SESSION['passupdate'])){
    echo '<script language="javascript">';
    echo 'alert("Password updated")';
    echo '</script>';
}*/
if (isset($_SESSION['dangnhap_home'])) {
    echo '<script language="javascript">';
    echo 'alert("Sai mật khẩu hoặc tài khoản!")';
    echo '</script>';
    session_destroy();
}
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

<body>
    <section class="top">
        <div class="container">
            <div class="row justify-content">
                <div class="logo"><img src="../image/logo.png" alt=""></div>
                <div class="signup">
                    <div class="signup-button">
                        <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">SIGN UP</button>
                    </div>
                    <div id="id01" class="modal">
                        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                        <form class="modal-content" action="index.php" method="post">
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

                            <label>
                                <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px">
                                Remember me
                            </label>

                            <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms &
                                    Privacy</a>.</p>

                            <div class="clearfix">
                                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                                <button type="submit" class="signupbtn" name="dangky_home">Sign Up</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="login">
                    <div class="login-button">
                        <button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">LOG IN</button>
                    </div>

                    <div id="id02" class="modal">
                        <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
                        <form class="login100-form validate-form flex-sb flex-w" action="./login.php" method="post">
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
                                <a href="#" class="txt2 bo1">
                                    Sign up now
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="menu-bar">
                    <span></span>
                </div>
                <div class="menu-items">
                    <ul>
                        <a href="">Home</a><br>
                        <a href="#aboutus">About us</a> <br>
                        <a href="#menu">Menu</a><br>
                        <a href="#gallery">Gallery</a><br>
                        <a href="#room">Party Room</a><br>
                        <a href="#contact">Contact</a>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section id="" class="background">
        <div class="background-content" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1500">
            <h2>European Restaurant </h2>
            <p>Come and experience it yourself!</p>
            <a href="#booking">
                <button class="background-content btn" name="dangnhap_home">BOOK NOW</button>
                <p>(Only members)</p>
            </a>
        </div>
    </section>

    <!---------------------------------------------ABOUT-US------------------------------------->
    <section id="aboutus" class="about section-pading ">
        <div class="container">
            <div class="row">
                <div class="title">
                    <h2>About Us</h2>
                </div>
            </div>
            <div class="row">
                <div class="about-item" data-aos="fade-up-right" data-aos-easing="linear" data-aos-duration="1500">
                    <h2>WELCOME TO KIEN RESTAURANT</h2>
                    <p>
                        Our restaurant was established and grown in 2008 after those arduous days. The finest dishes of
                        Europe can be found right on the menu of our restaurant.
                        If the cooking method creates the soul of a dish, the ingredients make up its body. Kien
                        Restaurant has chosen a rather thorny path in choosing ingredients for its dishes, and has
                        written its own story.
                        With a menu of European dishes, the restaurant has worked hard to find the source of fresh
                        European ingredients right after the harvest.
                        The restaurant has a rich menu to satisfy the dining needs of customers.
                    </p>
                </div>
                <div class="about-item" data-aos="fade-up-left" data-aos-easing="linear" data-aos-duration="1500">
                    <div class="about-item-img">
                        <span>+10 years of experience</span>
                        <img src="../image/content1.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--------------------------------------SIGNUP--------------------------------------->


    <!--------------------------------------------------------MENU---------------------------------------------------->

    <section id="menu" class="menu section-pading">

        <div class="container">
            <div class="row">
                <div class="title">
                    <h2>MENU LIST</h2>
                </div>
            </div>
            <div class="row">
                <div class="menu-title">
                    <?php
                    $sql_category = mysqli_query($con, "SELECT * FROM tbl_category ORDER BY category_id  ASC");
                    ?>

                    <?php
                    while ($row_category = mysqli_fetch_array($sql_category)) {
                    ?>
                        <button class="menu-button" data-title="<?php echo $row_category['category_id'] ?>"><?php echo $row_category['category_name'] ?></button>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <?php
            $sql_category = mysqli_query($con, "SELECT * FROM tbl_category");
            ?>
            <?php
            while ($row_category = mysqli_fetch_array($sql_category)) {
            ?>
                <div class="menu-content " id="<?php echo $row_category['category_id'] ?>">
                    <?php
                    $id = $row_category['category_id'];
                    $sql_product = mysqli_query($con, "SELECT * FROM tbl_sanpham WHERE category_id = $id ");
                    ?>
                    <?php
                    while ($row_product = mysqli_fetch_array($sql_product)) {
                    ?>
                        <div class="list-items">
                            <div class="list-item">
                                <img src="../image/<?php echo $row_product['sanpham_image'] ?>" alt="">
                                <p><?php echo $row_product['sanpham_name'] ?></p>
                            </div>
                            <div class="list-price">
                                <p><?php echo $row_product['sanpham_gia'] ?>$</p>
                            </div>
                            <a href="addproduct.php?sanpham_id=<?php echo $row_product['sanpham_id'] ?>"><i class="fas fa-plus"></i></a>
                        </div>
                    <?php
                    }
                    ?>

                </div>

            <?php
            }
            ?>
        </div>
    </section>


    <!---------------------------------------------Some foods------------------------------------------->
    <section id="gallery" class="some-foods">
        <div class="title">
            <h2>our gallery</h2>
        </div>
        <div class="some-foods container row">
            <div class="some-foods-item">
                <h2>Pan-fried Salmon</h2>
                <img src="../image/br1.jpg" alt="">
            </div>
            <div class="some-foods-item">
                <h2>Vegetarian Salad </h2>
                <img src="../image/br2.jpg" alt="">
            </div>
            <div class="some-foods-item">
                <h2>Chicken Breast Salad</h2>
                <img src="../image/br3.jpg" alt="">
            </div>
            <div class="some-foods-item">
                <h2>Goose Breast</h2>
                <img src="../image/br4.jpg" alt="">
            </div>
            <div class="some-foods-item">
                <h2>Dessert</h2>
                <img src="../image/br5.jpg" alt="">
            </div>
            <div class="some-foods-item">
                <h2>Vegetarian Sandwich</h2>
                <img src="../image/sandwich.jpg" alt="">
            </div>
        </div>
    </section>
    <!----------------------------------ROOM------------------------------------>
    <section id="room" class="room">
        <div class="container">
            <div class="row">
                <div class="title">
                    <h2>Party Room</h2>
                </div>
            </div>
            <div class="row">
                <div class="room-items">
                    <img src="../image/room1.jpg" alt="">
                    <div class="room-items-text">
                        <h2>COUPLE</h2>
                        <p>Capacity 2-3 peoples,suitable for Couple</p>
                    </div>
                </div>
                <div class="room-items">
                    <img src="../image/family.jpg" alt="">
                    <div class="room-items-text">
                        <h2>FAMILY</h2>
                        <p>Capacity 8-10 peoples,suitable for Family</p>
                    </div>
                </div>
                <div class="room-items">
                    <img src="../image/vip2.jpg" alt="">
                    <div class="room-items-text">
                        <h2>VIP</h2>
                        <p>Capacity 10-15 peoples.Completely private room. Separate entrance. Private party menu options
                            available</p>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-----------------------------------------FOOTER---------------------------------------->

    <section id="contact" class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-item">
                    <h2>Address</h2>
                    <p>57 Nguyen Cuu Van, P17 <br> Q.Binh Thanh, TP HCM</p>
                </div>
                <div class="footer-item">
                    <h2>Opening Hours</h2>
                    <p>Monday - Saturday <br> 10:00 AM - 21:00 PM </p>
                    <p>Sunday <br> 10:00 AM - 22:00 PM </p>
                </div>
                <div class="footer-item">
                    <h2>Contact Us</h2>
                    <p><i class="fas fa-phone"></i> 0388314851 <br> <i class="far fa-envelope"></i>
                        nguyenkiencke@gmail.com</p>
                    <div class="footer-social">
                        <a href="https://www.facebook.com/trungkiennnnn/">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="https://www.instagram.com/kiennecacban/">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>

            </div>
            <div class="footer-copyright">
                Copyright © 2021. All rights reserved.
            </div>
        </div>
    </section>

    <script src="../assets/js/webscript.js"></script>
    <script>
        AOS.init();
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
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

</html>