<?php
use PHPMailer\PHPMailer\PHPMailer;
if (isset($_POST['booking'])) {
    $email = $_SESSION['khachhang_email'];
    $booking_code = rand();
    $name = "Kien-restaurant";  // Name of your website or yours
        $to = $email;  // mail of reciever
        $subject = "THANK YOU! YOUR CONFIRM CODE IS";
        $body = $booking_code;
        $from = "saeyoshino2901@gmail.com";  // you mail
        $password = "yxvtfxnntokwxzst";  // your mail password

        // Ignore from here

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";
        $mail = new PHPMailer();

        // To Here

        //SMTP Settings
        $mail->isSMTP();
        // $mail->SMTPDebug = 3;  Keep It commented this is used for debugging                          
        $mail->Host = "smtp.gmail.com"; // smtp address of your email
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = $password;
        $mail->Port = 587;  // port
        $mail->SMTPSecure = "tls";  // tls or ssl
        $mail->smtpConnect([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            ]
        ]);

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($from, $name);
        $mail->addAddress($to); // enter email address whom you want to send
        $mail->Subject = ("$subject");
        $mail->Body = $body;
        if ($mail->send()) {
            //echo "Email is sent!";
        } else {
            echo "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }
    $occasion = $_POST['occasion'];
    $aop = $_POST['aop'];
    $date = $_POST['date'];
    $time = $_POST['time'];

$sql_insert_donhang = mysqli_query($con,"INSERT INTO tbl_table_booking(booking_code,date,aop,occasion,time)
values('$booking_code','$date','$aop','$occasion','$time')");
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
    <link rel="stylesheet" href="../assets/css/webstyle.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-5.15.4-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrer-policy="no-referrer" />
    <script>
        src = "https://kit.fontawesome.com/54f0cb7e4a.js";
        crossorigin = "anonymous"
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<body>
<section id='booking' class="booking section-padding">
        <div class="container">
            <div class="row">
                <div class="title">
                    <h2>booking</h2>
                </div>
            </div>
            <div class="booking-form">
                <form class="" action="./home.php" method="post">
                    <h1>BOOKING FORM</h1>
                    <p>PLEASE FILL OUT ALL FIELDS. THANKS!</p>
                    <div class="row justify-content">
                        <div class="booking-form-item">
                            <label for="occasion" name="occasion"></label>
                            <p>Occasion</p>
                            <select id="occasion" name="occasion" required>
                                <option value="Occasion"> Occasion</option>
                                <option value="Birthday"> Birthday</option>
                                <option value="Wedding"> Wedding</option>
                                <option value="Wedding"> Team-party</option>
                                <option value="Orther"> Orthers</option>
                            </select>
                        </div>
                        <div class="booking-form-item">
                            <p>Note</p>
                            <input type="text" placeholder="Note" id="food_name" name="food_name" required>
                        </div>
                        <div class="booking-form-item">
                            <p>Room you want to use</p>
                            <select id="" name="" required>
                                <option value="Occasion"> Room</option>
                                <option value="Birthday"> Couple</option>
                                <option value="Wedding"> Family</option>
                                <option value="Wedding"> Team-party</option>
                                <option value="Wedding"> Orthers</option>
                            </select>
                        </div>
                        
                        <div class="booking-form-item">
                            <p>Number of guests
                            <p>
                                <input type="number" placeholder="Quantity" id="aop" name="aop" required>
                        </div>
                        <div class="booking-form-item">
                            <p>Day you will come</p>
                            <input type="date" id="date" name="date" required>
                        </div>
                        <div class="booking-form-item">
                            <p>Time you wil come</p>
                            <input type="time" id="time" name="time" required>
                        </div>
                    </div>
                    <button type="submit" name="booking">SUBMIT</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>