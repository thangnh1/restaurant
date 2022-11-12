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
	$sql_delete = mysqli_query($con, "DELETE FROM tbl_table_booking WHERE id='$madondatban'");
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
			if (isset($_GET['xemdondatban'])) {
				$madonhang = $_GET['xemdondatban'];
				$sql_acckh = mysqli_query($con, "SELECT * FROM tbl_table_booking,tbl_user_account Where tbl_table_booking.user_id=tbl_user_account.id and tbl_table_booking.id = '$madonhang'");
			?>
				<div class="col-md-12">
					<h4 align="center" >DANH SÁCH ĐƠN ĐẶT BÀN</h4>
					<form action="" method="POST">
						<table class="table table-bordered ">
							<tr>
								<th>Thứ tự</th>
								<th>Tên khách hàng</th>
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
									<td><?php echo $row_donhang['fullname']; ?></td>
									<td><?php echo $row_donhang['phone_number']; ?></td>
									<td><?php echo $row_donhang['email']; ?></td>
									<td><?php echo $row_donhang['username']; ?></td>										
									<input type="hidden" name="khachhang_xuly" value="<?php echo $row_kh['id'] ?>">
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
				$sql_acckh = mysqli_query($con, "SELECT * FROM tbl_table_booking,tbl_user_account Where tbl_table_booking.user_id=tbl_user_account.id");
				?>
				<table class="table table-bordered ">
							<tr>
								<th>Thứ tự</th>
								<th>Tên khách hàng</th>	
								<th>Mã đơn đặt bàn</th>	
								<th>Ngày đặt</th>	
								<th>Quản lí</th>					
							</tr>
							<?php
							$i = 0;
							while ($row_kh = mysqli_fetch_array($sql_acckh)) {
								$i++;
							?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $row_donhang['fullname']; ?></td>
									<td><?php echo $row_donhang['tbl_table_booking.id']; ?></td>	
									td><?php echo $row_donhang['date']; ?></td>	
									<td><a href="?xemdondatban=<?php echo $row_sp['tbl_table_booking.id'] ?>">Xóa</a> || <a href="xulysanpham.php?quanly=capnhat&capnhat_id=<?php echo $row_sp['tbl_table_booking.id'] ?>">Sửa</a></td>									
									<input type="hidden" name="dondatban_xuly" value="<?php echo $row_kh['tbl_table_booking.id'] ?>">
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