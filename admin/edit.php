<!DOCTYPE html>
<html>

<head>
	<title>Edit Data</title>
</head>
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">

<body>
	<div class="container col-md-6 mt-4">
		<h1>Table FASILITAS</h1>
		<div class="card">
			<div class="card-header bg-success text-white ">
				Edit FASILITAS
			</div>
			<div class="card-body">
				<?php
				include('includes/conn.php');

				$id = $_GET['id']; //mengambil id barang yang ingin diubah

				//menampilkan barang berdasarkan id
				$data = mysqli_query($conn, "select * from data_fasilitas where id = '$id'");
				$row = mysqli_fetch_assoc($data);

				?>
				<form action="" method="post" role="form">
					<div class="form-group">
						<label>Nama</label>
						<!--  menampilkan nama barang -->
						<input type="text" name="nama" required="" class="form-control" value="<?= $row['nama']; ?>">

						<!-- ini digunakan untuk menampung id yang ingin diubah -->
						<input type="hidden" name="id" required="" value="<?= $row['id']; ?>">
					</div>
					<br>
					<div class="form-group">
						<label>Layanan</label>
						<input type="text" name="layanan" class="form-control" value="<?= $row['layanan']; ?>">
					</div>
					<br>
					<div class="form-group">
						<label>Harga</label>
						<input type="number" class="form-control" name="harga" value="<?= $row['harga']; ?>">
					</div>
					<br>
					<button type="submit" class="btn btn-primary" name="submit" value="simpan">EDIT</button>
				</form>

				<?php

				//jika klik tombol submit maka akan melakukan perubahan
				if (isset($_POST['submit'])) {
					$id = $_POST['id'];
					$nama = $_POST['nama'];
					$harga = $_POST['layanan'];
					$deskripsi = $_POST['harga'];

					//query mengubah barang
					mysqli_query($conn, "update data_fasilitas set nama='$nama', layanan='$harga', harga='$deskripsi' where id ='$id'") or die(mysqli_error($conn));

					//redirect ke halaman index.php
					echo "<script>alert('data berhasil diupdate.');window.location='index1.php';</script>";
				}



				?>
			</div>
		</div>
	</div>


	<script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>

</html>