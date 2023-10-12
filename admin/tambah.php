<!DOCTYPE html>
<html>

<head>
	<title>TAMBAH DATA</title>
</head>
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">

<body>
	<div class="container col-md-6 mt-4">
		<h1>Table FASILITAS</h1>
		<div class="card">
			<div class="card-header bg-success text-white">
				Tambah FASILITAS
			</div>
			<div class="card-body">
				<form action="" method="post" role="form">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="nama" required="" class="form-control">
					</div>
					<br>
					<div class="form-group">
						<label>Layanan</label>
						<input type="text" name="layanan" class="form-control">
					</div>
					<br>
					<div class="form-group">
						<label>Harga</label>
						<input type="number" class="form-control" name="harga">
					</div>
					<br>
					<button type="submit" class="btn btn-primary" name="submit" value="simpan">Simpan data</button>
				</form>

				<?php
				include('includes/conn.php');
				
				//melakukan pengecekan jika button submit diklik maka akan menjalankan perintah simpan dibawah ini
				if (isset($_POST['submit'])) {
					//menampung data dari inputan
					$nama = $_POST['nama'];
					$harga = $_POST['layanan'];
					$deskripsi = $_POST['harga'];

					//query untuk menambahkan barang ke database, pastikan urutan nya sama dengan di database
					$datas = mysqli_query($conn, "insert into data_fasilitas (nama,layanan,harga)values('$nama', '$harga', '$deskripsi')") or die(mysqli_error($koneksi));
					//id barang tidak dimasukkan, karena sudah menggunakan AUTO_INCREMENT, id akan otomatis

					//ini untuk menampilkan alert berhasil dan redirect ke halaman index
					echo "<script>alert('data berhasil disimpan.');window.location='index1.php';</script>";
				}
				?>
			</div>
		</div>
	</div>
</body>

</html>