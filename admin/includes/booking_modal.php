<!-- Modal -->
<?php
require_once('conn.php');
	
	// berikut script untuk proses edit barang ke database 
	if(isset($_POST['save'])){
		// menangkap data post 
		$nama_barang = $_POST['firstname'];
		$stok = $_POST['lastname'];
		$harga = $_POST['email'];
		$tanggal = $_POST['phone'];
    	$alamat = $_POST['address'];
		$id = $_POST['id'];
		
		$data[] = $nama_barang;
		$data[] = $stok;
		$data[] = $harga;
		$data[] = $tanggal;
    	$data[] = $alamat;
		$data[] = $id;
		
		// simpan data barang
		
		$sql = 'UPDATE bookings_record SET FIRSTNAME=?,LASTNAME=?,EMAIL=?,PHONE=?,ADDRESS=? WHERE ID=?';
		$row = $conn->prepare($sql);
		$row->execute($data);
		
		// redirect
		echo '<script>window.location="../index.php";</script>';
	}
?>

<div class="modal fade" id="edit">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">EDIT: <span class="del_customer_name"></span></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>
	  <form method="POST" action="includes/booking_modal.php">
	  <div class="modal-body">
		<div class="col-md-12">
    <input type="hidden" class="cust_id" name="id">
             <div class="form-group">
               <label class="control-label">NAMA DEPAN</label>
               <input type="text" class="form-control" id="edit_firstname" name="firstname">
             </div>
         </div>
		 <div class="col-md-12">
             <div class="form-group">
               <label class="control-label">NAMA BELAKANG</label>
               <input type="text" class="form-control" id="edit_lastname" name="lastname">
             </div>
         </div>
		 <div class="col-md-12">
             <div class="form-group">
               <label class="control-label">EMAIL</label>
               <input type="text" class="form-control" id="edit_email" name="email">
             </div>
         </div>
		 <div class="col-md-12">
             <div class="form-group">
               <label class="control-label">NOMOR HANDPHONE</label>
               <input type="text" class="form-control" id="edit_phone" name="phone">
             </div>
         </div>
		 <div class="col-md-12">
             <div class="form-group">
               <label class="control-label">ALAMAT</label>
               <input type="text" class="form-control" id="edit_address" name="address">
             </div>
         </div>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
		<button type="submit" class="btn btn-primary" name="save">Simpan</button>
	  </div>
	  </form>
	</div>
  </div>
</div>