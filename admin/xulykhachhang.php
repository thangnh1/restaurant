<?php
include('../db/connect.php');
?>
<?php
if (isset($_POST['capnhatdonhang'])) {
	$xuly = $_POST['xuly'];
	$madonhang = $_POST['mahang_xuly'];
	$sql_update_donhang = mysqli_query($con, "UPDATE tbl_donhang SET tinhtrang='$xuly' WHERE madonhang='$madonhang'");
}

?>
<?php
if (isset($_GET['xoadonhang'])) {
	$madonhang = $_GET['xoadonhang'];
	$sql_delete = mysqli_query($con, "DELETE FROM tbl_donhang WHERE madonhang='$madonhang'");
	header('Location:xulydonhang.php');
}
if (isset($_GET['xacnhanhuy']) && isset($_GET['madonhang'])) {
	$huydon = $_GET['xacnhanhuy'];
	$magiaodich = $_GET['madonhang'];
} else {
	$huydon = '';
	$magiaodich = '';
}
$sql_update_donhang = mysqli_query($con, "UPDATE tbl_donhang SET huydon='$huydon' WHERE madonhang='$magiaodich'");
$sql_update_giaodich = mysqli_query($con, "UPDATE tbl_giaodich SET huydon='$huydon' WHERE magiaodich='$magiaodich'");

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Đơn hàng</title>
	<link href="../bootstrap/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
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
	<div class="container-fluid">
		<div class="row">
			<?php
			if (isset($_GET['quanly']) == 'xemdonhang') {
				$madonhang = $_GET['madonhang'];
				$sql_chitiet = mysqli_query($con, "SELECT * FROM tbl_donhang WHERE madonhang='$madonhang'");
			?>
				<div class="col-md-12">
					<h4 align="center" >XEM CHI TIẾT ĐƠN HÀNG</h4>
					<form action="" method="POST">
						<table class="table table-bordered ">
							<tr>
								<th>Thứ tự</th>
								<th>Mã đơn hàng</th>
								<th>Tên khách đặt</th>
								<th>SĐT khách đặt</th>
								<th>Tên món ăn</th>
								<th>Loại bàn</th>
								<th>Số lượng khách</th>
								<th>Ngày đặt</th>
								<th>Dịp đặt</th>
							</tr>
							<?php
							$i = 0;
							while ($row_donhang = mysqli_fetch_array($sql_chitiet)) {
								$i++;
							?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $row_donhang['madonhang']; ?></td>
									<td><?php echo $row_donhang['kh_name']; ?></td>
									<td><?php echo $row_donhang['kh_phone']; ?></td>
									<td><?php echo $row_donhang['food_name']; ?></td>
									<td><?php echo $row_donhang['loaiban']; ?></td>
									<td><?php echo $row_donhang['songuoi']; ?></td>
									<td><?php echo $row_donhang['ngaythang']; ?></td>
									<td><?php echo $row_donhang['occasion']; ?></td>
									<input type="hidden" name="mahang_xuly" value="<?php echo $row_donhang['madonhang'] ?>">
								</tr>
							<?php
							}
							?>
						</table>
					</form>
				</div>
			<?php
			}
			?>
			<div class="col-md-12">
				<h4 align="center">DANH SÁCH TẤT CẢ KHÁCH HÀNG</h4>
				<?php
				$sql_select = mysqli_query($con, "SELECT kh_name,kh_phone,ngaythang,madonhang FROM tbl_donhang ");
				?>
				<table class="table table-bordered ">
					<tr>
						<th>Thứ tự</th>
						<th>Mã đơn hàng</th>
						<th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
						<th>Ngày đặt</th>
						<th>Quản lý</th>
					</tr>
					<?php
					$i = 0;
					while ($row_donhang = mysqli_fetch_array($sql_select)) {
						$i++;
					?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $row_donhang['madonhang']; ?></td>
							<td><?php echo $row_donhang['kh_name']; ?></td>
                            <td><?php echo $row_donhang['kh_phone']; ?></td>
							<td><?php echo $row_donhang['ngaythang'] ?></td>
							<td><a href="?xoadonhang=<?php echo $row_donhang['madonhang'] ?>">Xóa</a> || <a href="?quanly=xemdonhang&madonhang=<?php echo $row_donhang['madonhang'] ?>"> Xem chi tiết </a></td>
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