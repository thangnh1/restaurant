<h1>Detail</h1>
<?php

include('../db/connect.php');
?>
<?php
$sql_chitiet = "SELECT * FROM tbl_sanpham, tbl_category WHERE tbl_sanpham.category_id = tbl_category.category_id AND tbl_sanpham.sanpham_id='$_GET[id]' LIMIT 1";
$query_chitiet = mysqli_query($con, $sql_chitiet);
while ($row_chitiet = mysqli_fetch_array($query_chitiet)) {
?>
    <div class="product_image">
        <img width="50%" src="../image/<?php echo $row_chitiet['sanpham_image'] ?>" alt="">
    </div>
    <div class="product_detail">
        <h3><?php echo $row_chitiet['sanpham_name'] ?></h3>
        <p>Mo ta</p>
        <!-- <p><?php echo $row_chitiet['sanpham_mota'] ?></p> -->
        <p><?php echo number_format($row_chitiet['sanpham_gia'], 0, ',', '.') . ' VNĐ' ?></p>
    </div>
<?php
}
?>