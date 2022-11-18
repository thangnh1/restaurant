<?php
session_start();
include('../db/connect.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');
$khachhang_id = $_SESSION['khachhang_id'];
$code_order = rand(0, 9999);
$today = date("d/m/Y H:i:s");
$today_ = date("d/m/Y");



$rdo = $_POST['payment-method'];

if ($rdo == "tt") {
    $insert_order = "INSERT INTO tbl_order(user_id, order_code, date, date_, order_status, payment_status) VALUE('" . $khachhang_id . "','" . $code_order . "', '" . $today . "', '" . $today_ . "', 0, 0)";
    $cart_query = mysqli_query($con, $insert_order);
    echo $_SESSION['donhang'];
    if ($insert_order) {
        foreach ($_SESSION['donhang'] as $key => $value) {
            $id_sanpham = $value['id'];
            $soluong = $value['soluong'];
            $insert_order_detail = "INSERT INTO tbl_order_detail(product_id, order_code, quantity) VALUE('" . $id_sanpham . "','" . $code_order . "','" . $soluong . "')";
            mysqli_query($con, $insert_order_detail);
        }
    }
    unset($_SESSION['donhang']);
} elseif ($rdo == "vnpay") {
    $insert_order = "INSERT INTO tbl_order(user_id, order_code, date, date_, order_status, payment_status) VALUE('" . $khachhang_id . "','" . $code_order . "', '" . $today . "', '" . $today_ . "', 0, 0)";
    $cart_query = mysqli_query($con, $insert_order);
    if ($insert_order) {
        foreach ($_SESSION['donhang'] as $key => $value) {
            $id_sanpham = $value['id'];
            $soluong = $value['soluong'];
            $insert_order_detail = "INSERT INTO tbl_order_detail(product_id, order_code, quantity) VALUE('" . $id_sanpham . "','" . $code_order . "','" . $soluong . "')";
            mysqli_query($con, $insert_order_detail);
        }
    }

    unset($_SESSION['donhang']);
    header('Location:VNPay/index.php');
} else {
    // $insert_order = "INSERT INTO tbl_order(user_id, order_code, date, date_, order_status, payment_status) VALUE('" . $khachhang_id . "','" . $code_order . "', '" . $today . "', '" . $today_ . "', 1, 2)";
    // $cart_query = mysqli_query($con, $insert_order);
    // if ($insert_order) {
    //     foreach ($_SESSION['donhang'] as $key => $value) {
    //         $id_sanpham = $value['id'];
    //         $soluong = $value['soluong'];
    //         $insert_order_detail = "INSERT INTO tbl_order_detail(product_id, order_code, quantity) VALUE('" . $id_sanpham . "','" . $code_order . "','" . $soluong . "')";
    //         mysqli_query($con, $insert_order_detail);
    //     }
    // }
    // unset($_SESSION['donhang']);
}

?>

<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <button><a>Thanh toán tại nhà hàng</a></button>
    <button>Thanh toán bằng VNPay</button>
</body>

</html> -->