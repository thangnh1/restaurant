<?php
include('../db/connect.php');
session_start();
?>
<?php
if (isset($_POST['themsanpham'])) {
    $tensanpham = $_POST['tensanpham'];
    $hinhanh = $_FILES['hinhanh']['name'];
    $gia = $_POST['giasanpham'];
    $danhmuc = $_POST['danhmuc'];
    $path = 'image_uploads/';
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];

    $hinhanh = time() . "_" . $hinhanh;

    $sql_monan    = mysqli_query($con, "SELECT name FROM tbl_product WHERE name ='$tensanpham'");
    $sql_monan1    = mysqli_query($con, "SELECT image FROM tbl_product WHERE image ='$hinhanh'");
    $row_monan = mysqli_fetch_array($sql_monan);
    $row_monan1 = mysqli_fetch_array($sql_monan1);

    if ($gia <= '0' || $gia == '') {
        echo '<script language="javascript">';
        echo 'alert("Giá bán không hợp lệ")';
        echo '</script>';
    } else if ($hinhanh == '') {
        echo '<script language="javascript">';
        echo 'alert("Không tìm thấy ảnh")';
        echo '</script>';
    } else if ($tensanpham == '') {
        echo '<script language="javascript">';
        echo 'alert("Tên không hợp lệ")';
        echo '</script>';
    } else if ($danhmuc == '0') {
        echo '<script language="javascript">';
        echo 'alert("Danh mục chưa được chọn")';
        echo '</script>';
    } else if (isset($row_monan1)) {
        echo '<script language="javascript">';
        echo 'alert("Ảnh đã được sử dụng")';
        echo '</script>';
    } else if (isset($row_monan)) {
        echo '<script language="javascript">';
        echo 'alert("Tên món đã tồn tại")';
        echo '</script>';
    } else {
        $sql_insert_product = mysqli_query($con, "INSERT INTO tbl_product(name,price,image,category_id) values ('$tensanpham','$gia','$hinhanh','$danhmuc')");
        move_uploaded_file($hinhanh_tmp, $path . $hinhanh);
    }
} else if (isset($_POST['capnhatsanpham'])) {
    $id_update = $_POST['id_update'];
    $tensanpham = $_POST['tensanpham'];
    $hinhanh = $_FILES['hinhanh']['name'];
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    $gia = $_POST['giasanpham'];
    $danhmuc = $_POST['danhmuc'];
    $path = '../image/';
    if ($hinhanh == '') {
        $sql_update_image = "UPDATE tbl_product SET name='$tensanpham',price='$gia',category_id='$danhmuc' WHERE id='$id_update'";
    } else {
        move_uploaded_file($hinhanh_tmp, $path . $hinhanh);
        $sql_update_image = "UPDATE tbl_product SET name='$tensanpham',price='$gia',image='$hinhanh',category_id='$danhmuc' WHERE id='$id_update'";
    }
    mysqli_query($con, $sql_update_image);
}
?>
<?php
if (isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    $sql_xoa = mysqli_query($con, "DELETE FROM tbl_product WHERE id='$id'");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap.css">
    <title>Sản Phẩm</title>
</head>

<body>
    <p>Xin chào : <?php echo $_SESSION['login'] ?> <a href="?loginn=logout">Log out</a></p>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="xulydonhang.php">Đơn hàng <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="xulydanhmuc.php">Danh mục</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="xulysanpham.php">Sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="xulykhachhang.php">Khách hàng</a>
                </li>

            </ul>
        </div>
    </nav><br><br>
    <div class="container">
        <div class="row">
            <?php
            if (isset($_GET['quanly']) == 'capnhat') {
                $id_capnhat = $_GET['capnhat_id'];
                $sql_capnhat = mysqli_query($con, "SELECT * FROM tbl_product WHERE id='$id_capnhat'");
                $row_capnhat = mysqli_fetch_array($sql_capnhat);
                $id_category_1 = $row_capnhat['category_id'];
            ?>
                <div class="col-md-4">
                    <h4>Lưu chỉnh sửa</h4>

                    <form action="" method="POST" enctype="multipart/form-data">
                        <label>Tên sản phẩm</label>
                        <input type="text" class="form-control" name="tensanpham" value="<?php echo $row_capnhat['name'] ?>"><br>
                        <input type="hidden" class="form-control" name="id_update" value="<?php echo $row_capnhat['id'] ?>">
                        <label>Hình ảnh</label>
                        <input type="file" class="form-control" name="hinhanh"><br>
                        <img src="image_uploads/<?php echo $row_capnhat['image'] ?>" height="80" width="80"><br>
                        <label>Giá</label>
                        <input type="text" class="form-control" name="giasanpham" value="<?php echo $row_capnhat['price'] ?>"><br>
                        <label>Danh mục</label>
                        <?php
                        $sql_danhmuc = mysqli_query($con, "SELECT * FROM tbl_category ORDER BY id DESC");
                        ?>
                        <select name="danhmuc" class="form-control">
                            <option value="0">-----Chọn danh mục-----</option>
                            <?php
                            while ($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
                                if ($id_category_1 == $row_danhmuc['id']) {
                            ?>
                                    <option selected value="<?php echo $row_danhmuc['id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
                                <?php
                                } else {
                                ?>
                                    <option value="<?php echo $row_danhmuc['id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select><br>
                        <input type="submit" name="capnhatsanpham" value="Cập nhật sản phẩm" class="btn btn-default">
                    </form>
                </div>
            <?php
            } else {
            ?>
                <div class="col-md-4">
                    <h4>Thêm sản phẩm</h4>

                    <form action="" method="POST" enctype="multipart/form-data">
                        <label>Tên sản phẩm</label>
                        <input type="text" class="form-control" name="tensanpham" placeholder="Tên sản phẩm"><br>
                        <label>Hình ảnh</label>
                        <input type="file" class="form-control" name="hinhanh"><br>
                        <label>Giá</label>
                        <input type="text" class="form-control" name="giasanpham" placeholder="Giá sản phẩm"><br>
                        <label>Danh mục</label>
                        <?php
                        $sql_danhmuc = mysqli_query($con, "SELECT * FROM tbl_category ORDER BY id DESC");
                        ?>
                        <select name="danhmuc" class="form-control">
                            <option value="0">-----Chọn danh mục-----</option>
                            <?php
                            while ($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
                            ?>
                                <option value="<?php echo $row_danhmuc['id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
                            <?php
                            }
                            ?>
                        </select><br>
                        <input type="submit" name="themsanpham" value="Thêm sản phẩm" class="btn btn-default">
                    </form>
                </div>
            <?php
            }

            ?>
            <div class="col-md-8">
                <h4>Liệt kê sản phẩm</h4>
                <?php
                $sql_select_sp = mysqli_query($con, "SELECT tbl_product.id, name, image, price, category_id, category_name FROM tbl_product, tbl_category WHERE tbl_product.category_id=tbl_category.id ORDER BY tbl_product.id DESC");
                ?>
                <table class="table table-bordered ">
                    <tr>
                        <th>Thứ tự</th>
                        <th>Tên sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Danh mục sản phẩm</th>
                        <th>Giá</th>
                        <th>Quản lý</th>
                    </tr>
                    <?php
                    $i = 0;
                    while ($row_sp = mysqli_fetch_array($sql_select_sp)) {
                        $i++;
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php print_r($row_sp)  ?></td>
                            <td><img src="image_uploads/<?php echo $row_sp['image'] ?>" height="100" width="80"></td>
                            <td><?php echo $row_sp['category_name'] ?></td>
                            <td><?php echo number_format($row_sp['price'], 0, ',', '.') . ' VNĐ' ?></td>

                            <td><a href="?xoa=<?php echo $row_sp['id'] ?>">Xóa</a> || <a href="xulysanpham.php?quanly=capnhat&capnhat_id=<?php echo $row_sp['id'] ?>">Sửa</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

</body>

</html>