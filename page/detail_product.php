<?php

include('../db/connect.php');
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
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap.css">
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
    <h1 style="text-align: center; margin-bottom: 50px">Detail Product</h1>
    <?php
    $sql_chitiet = "SELECT * FROM tbl_sanpham, tbl_category WHERE tbl_sanpham.category_id = tbl_category.category_id AND tbl_sanpham.sanpham_id='$_GET[id]' LIMIT 1";
    $query_chitiet = mysqli_query($con, $sql_chitiet);
    while ($row_chitiet = mysqli_fetch_array($query_chitiet)) {
    ?>
        <div class="detail">
            <div class="product_image">
                <img width="80%" src="../image/<?php echo $row_chitiet['sanpham_image'] ?>" alt="">
            </div>
            <div class="product_detail">
                <h3><?php echo $row_chitiet['sanpham_name'] ?></h3>
                <p>Description : </p>
                <!-- <p><?php echo $row_chitiet['sanpham_mota'] ?></p> -->
                <p>Quantity : <input type="number" id="soluong" value="1" min="1" max="9"></p>
                <p>Price : <?php echo number_format($row_chitiet['sanpham_gia'], 0, ',', '.') . ' VNĐ' ?></p>
                <button onclick="window.location='addproduct.php?action=add&sanpham_id=<?php echo $_GET['id'] ?>&sl='+soluong.value" class="btn-add-to-cart">Add to cart</button>
            </div>
        </div>
    <?php
    }
    ?>
</body>