<?php
session_start();
include('../db/connect.php');
$khachhang_id = $_SESSION['khachhang_id'];
$code_order = rand(0, 9999);
$insert_order = "INSERT INTO tbl_order(id_kh, code_order, order_status) VALUE('" . $khachhang_id . "','" . $code_order . "',1)";
$cart_query = mysqli_query($con, $insert_order);
if ($insert_order) {
    foreach ($_SESSION['donhang'] as $key => $value) {
        $id_sanpham = $value['id'];
        $soluong = $value['soluong'];
        $insert_order_detail = "INSERT INTO tbl_order_detail(id_sanpham, code_order, soluong) VALUE('" . $id_sanpham . "','" . $code_order . "','" . $soluong . "')";
        mysqli_query($con, $insert_order_detail);
    }
}
?>

<!DOCTYPE html>
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

</html>