<?php
session_start();
include("../../db/connect.php");
$khachhang_id = $_SESSION['khachhang_id'];
$sql_user = "SELECT * FROM tbl_order, tbl_user_account, tbl_order_detail, tbl_product WHERE tbl_user_account.id = '$khachhang_id' AND tbl_order.user_id = tbl_user_account.id AND tbl_order_detail.order_code = tbl_order.order_code AND tbl_order_detail.product_id = tbl_product.id";
$query = mysqli_query($con, $sql_user);
$row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Kiểm tra đơn hàng</title>
    <!-- Bootstrap core CSS -->
    <link href="./assets/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="./assets/jumbotron-narrow.css" rel="stylesheet">
    <script src="./assets/jquery-1.11.3.min.js"></script>
</head>
<style>
    th {
        text-align: center;
    }
</style>
<?php
$arr = array($row);
$tongtien = 0;
foreach ($arr as $arr) {
    $thanhtien = $arr['price'] * $arr['quantity'];
    $tongtien += $thanhtien;
}
if ($row['order_status'] == '0') {
?>



    <body>
        <?php require_once("./config.php"); ?>
        <div class="container">
            <h3>Kiểm tra thông tin đơn hàng</h3>
            <div class="table-responsive">
                <form action="./vnpay_create_payment.php" id="create_form" method="post">

                    <div class="form-group">
                        <label for="order_id">Mã hóa đơn</label>
                        <input class="form-control" id="order_id" name="order_id" type="text" value="<?php echo $row['order_code'] ?>" readonly />
                    </div>
                    <div class="form-group">
                        <label for="amount">Số tiền</label>
                        <input class="form-control" id="amount" name="amount" type="number" value="<?php echo $tongtien ?>" readonly />
                    </div>
                    <div class="form-group">
                        <label for="order_desc">Nội dung thanh toán</label>
                        <textarea class="form-control" cols="20" id="order_desc" name="order_desc" rows="2">Thanh toán đơn hàng <?php echo $row['order_code'] ?></textarea>
                    </div>

                    <div class="form-group">
                        <h3>Thông tin giao hàng (Shipping)</h3>
                    </div>
                    <div class="form-group">
                        <label>Họ tên</label>
                        <input class="form-control" id="txt_billing_fullname" name="txt_billing_fullname" type="text" value="<?php echo $row['fullname'] ?>" readonly />
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input class="form-control" id="txt_billing_mobile" name="txt_billing_mobile" type="text" value="<?php echo $row['phone_number'] ?>" readonly />
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input class="form-control" id="txt_billing_addr1" name="txt_billing_addr1" type="text" value="<?php echo $row['address'] ?>" readonly />
                    </div>

                    <div class="form-group">
                        <label>Ghi chú</label>
                        <input class="form-control" id="txt_billing_addr1" name="txt_billing_addr1" type="text" value="<?php echo $row['note'] ?>" readonly />
                    </div>


                    <div class="form-group">
                        <h3>Thông tin Order </h3>
                    </div>

                    <table style="width: 100%; text-align:center; border-collapse:collapse;" border="1">
                        <tr>
                            <th>Mã món</th>
                            <th>Tên món</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Thành tiền</th>
                        </tr>
                        <tr>
                            <td><?php echo $row['product_id'] ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td> <?php echo $row['quantity'] ?> </td>
                            <td><?php echo number_format($row['price'], 0, ',', '.') . ' VNĐ' ?></td>
                            <td><?php echo number_format($thanhtien, 0, ',', '.') . ' VNĐ' ?></td>
                        </tr>
                        <td colspan="7">
                            <p>Tổng tiền : <?php echo number_format($tongtien, 0, ',', '.') . ' VNĐ' ?></p>
                            <div style="clear:both"></div>
                        </td>
                    </table>





                    <?php if ($row['order_status'] == '0') { ?>
                        <div class="form-group">
                            <h3>Trạng thái đơn hàng : <?php echo 'Đang chuẩn bị' ?> </h3>
                        </div>
                    <?php } else if ($row['order_status'] == '2') { ?>
                        <div class="form-group">
                            <h3>Trạng thái đơn hàng : <?php echo 'Đang giao hàng' ?> </h3>
                        </div>
                    <?php } ?>

                    <?php
                    if ($row['payment_status'] == '0') {
                    ?>

                        <div class="form-group">
                            <h3 style="color: red; ">Trạng thái thanh toán : <?php echo 'Chưa thanh toán' ?> </h3>
                        </div>
                        <button type="submit" class="btn btn-primary" id="btnPopup">Thanh toán Post</button>
                        <button type="submit" name="redirect" id="redirect" class="btn btn-default">Thanh toán</button>
                    <?php } else { ?>
                        <div class="form-group">
                            <h3>Trạng thái thanh toán : <?php echo 'Đã thanh toán' ?></h3>
                        </div>
                    <?php } ?>
                </form>

            </div>
            <p>
                &nbsp;
            </p>
        <?php } else { ?>
            <div class="form-group">
                <h3>Hiện tại bạn chưa có đơn đang trong quá trình xử lý ! </h3>
            </div>
        <?php } ?>

        <footer class="footer">
            <a href="../index.php"><button class="btn btn-primary">Trở về Trang chủ</button></a>
        </footer>
        </div>




    </body>

</html>