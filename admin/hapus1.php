<?php				
			include 'includes/conn.php'; //menghubungkan ke file koneksi untuk ke database
			$id = $_GET['id']; //menampung id

			//query hapus
			$datas = mysqli_query($conn, "delete from data_fasilitas where id ='$id'") or die(mysqli_error($conn));

			//alert dan redirect ke index.php
			echo "<script>alert('data berhasil dihapus.');window.location='index1.php';</script>";
	?>
