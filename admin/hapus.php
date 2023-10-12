<?php
require_once('includes/conn.php');

$sql = "DELETE FROM bookings_record WHERE ID= ?";
$row = $conn->prepare($sql);
$row->execute(array($_GET['id']));
                                                        
echo '<script>alert("Berhasil Hapus Data");window.location="index.php"</script>';
?>