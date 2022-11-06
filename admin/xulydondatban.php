<?php
include('../db/connect.php');
session_start();
?>
<?php
if (isset($_POST['capnhatdonhang'])) {
	$xuly = $_POST['xuly'];
	$madonhang = $_POST['mahang_xuly'];
	$sql_update_donhang = mysqli_query($con, "UPDATE tbl_donhang SET tinhtrang='$xuly' WHERE madonhang='$madonhang'");
}

?>
<?php
if (isset($_GET['xoadondatban'])) {
	$madondatban = $_GET['xoadondatban'];
	$sql_delete = mysqli_query($con, "DELETE FROM tbl_dondatban WHERE madondatban='$madondatban'");
	header('Location:xulydondatban.php');
}
if (isset($_GET['xacnhanhuy']) && isset($_GET['madonhang'])) {
	$huydon = $_GET['xacnhanhuy'];
	$magiaodich = $_GET['madonhang'];
} else {
	$huydon = '';
	$magiaodich = '';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Đơn hàng</title>
	<link href="../assets/bootstrap/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
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
	<div class="container-fluid">
		<div class="row">
			<?php
			if (isset($_GET['quanly']) == 'xemdonhang') {
				$madonhang = $_GET['madonhang'];
				$sql_acckh = mysqli_query($con, "SELECT * FROM tbl_dondatban ");
			?>
				<div class="col-md-12">
					<h4 align="center" >DANH SÁCH ĐƠN ĐẶT BÀN</h4>
					<form action="" method="POST">
						<table class="table table-bordered ">
							<tr>
								<th>Thứ tự</th>
								<th>Tên khách hànghàng</th>
								<th>SĐT khách hàng</th>
								<th>Địa chỉ mail</th>	
								<th>Tên tài khoản</th>							
							</tr>
							<?php
							$i = 0;
							while ($row_kh = mysqli_fetch_array($sql_acckh)) {
								$i++;
							?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $row_donhang['kh_fullname']; ?></td>
									<td><?php echo $row_donhang['kh_sdt']; ?></td>
									<td><?php echo $row_donhang['kh_email']; ?></td>
									<td><?php echo $row_donhang['kh_user']; ?></td>										
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
				<h4 align="center">DANH SÁCH ĐƠN ĐẶT BÀN</h4>
				<?php
				$sql_dondatban = mysqli_query($con, "SELECT * FROM tbl_dondatban ");
				?>
				<table class="table table-bordered ">
							<tr>
								<th>Thứ tự</th>
								<th>Tên khách hàng hàng</th>
								<th>SĐT khách hàng</th>
								<th>NGÀY ĐẶT</th>
                                <th>GIỜ</th>	
								<th>QUẢN LÝ</th>					
							</tr>
							<?php
							$i = 0;
							while ($row_dondatban = mysqli_fetch_array($sql_dondatban)) {
								$i++;
							?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $row_dondatban['kh_name']; ?></td>
									<td><?php echo $row_dondatban['kh_phone']; ?></td>
                                    <td><?php echo $row_dondatban['ngaythang']; ?></td>
                                    <td><?php echo $row_dondatban['gio']; ?></td>
									<td><a href="?xoadondatban=<?php echo $row_dondatban['madondatban'] ?>">Xóa</a></td>
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