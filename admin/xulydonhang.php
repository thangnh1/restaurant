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
if (isset($_GET['xoadonhang'])) {
	$madonhang = $_GET['xoadonhang'];
	$sql_delete = mysqli_query($con, "DELETE FROM tbl_dondatmon WHERE madon='$madonhang'");
	header('Location:xulydonhang.php');
}
if (isset($_GET['xacnhanhuy']) && isset($_GET['madonhang'])) {
	$huydon = $_GET['xacnhanhuy'];
	$magiaodich = $_GET['madonhang'];
} else {
	$huydon = '';
	$magiaodich = '';
}
//$sql_update_donhang = mysqli_query($con, "UPDATE tbl_donhang SET huydon='$huydon' WHERE madonhang='$magiaodich'");
//$sql_update_giaodich = mysqli_query($con, "UPDATE tbl_giaodich SET huydon='$huydon' WHERE magiaodich='$magiaodich'");

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
				$sql_chitiet = mysqli_query($con, "SELECT * FROM tbl_chitietdondatmon WHERE madon='$madonhang'");
			?>
				<div class="col-md-12">
					<h4 align="center" >XEM CHI TIẾT ĐƠN HÀNG</h4>
					<form action="" method="POST">
						<table class="table table-bordered ">
							<tr>
								<th>Mã đơn hàng</th>
								<th>Món ăn</th>
								<th>Đơn giá</th>
								<th>Số lượng</th>
															
							</tr>
							<?php							
							while ($row_chitietdonhang = mysqli_fetch_array($sql_chitiet)) {
							$id_monan = $row_chitietdonhang['monan_id'];
							$row_monan	= mysqli_query($con, "SELECT * FROM tbl_monan WHERE monan_id ='$id_monan'");
							$row_chitietmonan = mysqli_fetch_array($row_monan);
							?>
								<tr>

									<td><?php echo $row_chitietdonhang['madon']; ?></td>
									<td><?php echo $row_chitietmonan['tenmon']; ?></td>
									<td><?php echo $row_chitietmonan['giamonan']; ?>$</td>
									<td><?php echo $row_chitietdonhang['soluong']; ?></td>
									
									<input type="hidden" name="mahang_xuly" value="<?php echo $row_donhang['madon'] ?>">
								</tr>
							<?php
							}
							?>
						</table>

						
						

						
						<input type="submit" value="Cập nhật đơn hàng" name="capnhatdonhang" class="btn btn-success">
					</form>
				</div>
			<?php
			} else {
			?>
				<div class="col-md-7">
					<h1>ĐƠN HÀNG CỦA BẠN</h1>
				</div>
			<?php
			}
			?>
			<div class="col-md-12">
				<h4 align="center">DANH SÁCH TẤT CẢ ĐƠN HÀNG CHƯA XỬ LÍ</h4>
				<?php
				$sql_select = mysqli_query($con, "SELECT kh_name,ngaythang,madon,tinhtrang FROM tbl_dondatmon WHERE tinhtrang = '0'");
				?>
				<table class="table table-bordered ">
					<tr>
						<th>Thứ tự</th>
						<th>Mã đơn hàng</th>
						<th>Tình trạng đơn hàng</th>
						<th>Tên khách hàng</th>
						<th>Ngày đặt</th>
						<th>TỔNG TIỀN</th>
						<th>Quản lý</th>
					</tr>
					<?php
					$i = 0;
					while ($row_donhang = mysqli_fetch_array($sql_select)) {
						$madon = $row_donhang['madon'];
						$sql_chitietdon = mysqli_query($con, "SELECT * FROM tbl_chitietdondatmon WHERE madon='$madon'");
						$tong = 0;						
						while ($row_chitiet =  mysqli_fetch_array($sql_chitietdon)){
							$monan_id = $row_chitiet['monan_id'];
							$sql_monan = mysqli_query($con, "SELECT * FROM tbl_monan WHERE monan_id ='$monan_id'");
							$row_monan =  mysqli_fetch_array($sql_monan);
							$giamon = $row_monan['giamonan'];
							$tong +=  $giamon*$row_chitiet['soluong'];
						}
						$i++;
					?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $row_donhang['madon']; ?></td>
							<td><?php
								if ($row_donhang['tinhtrang'] == 0) {
									echo 'Chưa xử lý';
								} else {
									echo 'Đã xử lý';
								}
								?></td>
							<td><?php echo $row_donhang['kh_name']; ?></td>
							<td><?php echo $row_donhang['ngaythang'] ?></td>
							
							<td><?php echo $tong ?>$</td>
							<td><a href="?xoadonhang=<?php echo $row_donhang['madon'] ?>">Xóa</a> || <a href="?quanly=xemdonhang&madonhang=<?php echo $row_donhang['madon'] ?>"> Xem chi tiết </a></td>
						</tr>
					<?php
					}
					?>
				</table>
			</div>	
			
			<div class="col-md-12">
				<h4 align="center">DANH SÁCH TẤT CẢ ĐƠN HÀNG ĐÃ XỬ LÍ</h4>
				<?php
				$sql_select = mysqli_query($con, "SELECT kh_name,ngaythang,madon,tinhtrang FROM tbl_dondatmon WHERE tinhtrang = '1'");
				?>
				<table class="table table-bordered ">
					<tr>
						<th>Thứ tự</th>
						<th>Mã đơn hàng</th>
						<th>Tình trạng đơn hàng</th>
						<th>Tên khách hàng</th>
						<th>Ngày đặt</th>
						<th>TỔNG TIỀN</th>
						<th>Quản lý</th>
					</tr>
					<?php
					$i = 0;
					while ($row_donhang = mysqli_fetch_array($sql_select)) {
						$madon = $row_donhang['madon'];
						$sql_chitietdon = mysqli_query($con, "SELECT * FROM tbl_chitietdondatmon WHERE madon='$madon'");
						$tong = 0;						
						while ($row_chitiet =  mysqli_fetch_array($sql_chitietdon)){
							$monan_id = $row_chitiet['monan_id'];
							$sql_monan = mysqli_query($con, "SELECT * FROM tbl_monan WHERE monan_id ='$monan_id'");
							$row_monan =  mysqli_fetch_array($sql_monan);
							$giamon = $row_monan['giamonan'];
							$tong +=  $giamon*$row_chitiet['soluong'];
						}
						$i++;
					?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $row_donhang['madon']; ?></td>
							<td><?php
								if ($row_donhang['tinhtrang'] == 0) {
									echo 'Chưa xử lý';
								} else {
									echo 'Đã xử lý';
								}
								?></td>
							<td><?php echo $row_donhang['kh_name']; ?></td>
							<td><?php echo $row_donhang['ngaythang'] ?></td>
							<td><?php echo $tong ?>$</td>
							<td><a href="?xoadonhang=<?php echo $row_donhang['madon'] ?>">Xóa</a> || <a href="?quanly=xemdonhang&madonhang=<?php echo $row_donhang['madon'] ?>"> Xem chi tiết </a></td>
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