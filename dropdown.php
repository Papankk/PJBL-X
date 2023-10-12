<?php
    $conn = mysqli_connect("localhost","root","","bookingsysystem");

    if(!$conn){
        exit("Gagal Terkoneksi");
    }

    $val= $_GET['value'];

    $val_M= mysqli_real_escape_string($conn, $val);

    $sql = "SELECT nama, layanan, harga FROM data_fasilitas WHERE nama = '$val_M'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        echo "<select>";
        while($rows = mysqli_fetch_assoc($result)){
            echo "<option value=".$rows['layanan']. ">" . $rows['layanan'] . "&nbsp&nbsp&nbsp&nbsp&nbspRp." . $rows['harga'] . "</option>";
        }

        echo "</select>";
    }
?>