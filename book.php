<?php

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET['date'])) {
    $date = $_GET['date'];
}

if (isset($_POST['submit'])) {

    $fname = $_POST['FIRSTNAME'];
    $lname = $_POST['LASTNAME'];
    $email = $_POST['EMAIL'];
    $phone = $_POST['PHONE'];
    $address = $_POST['ADDRESS'];
    $conn = new mysqli('localhost', 'root', '', 'bookingsysystem');

    $sql = "INSERT INTO bookings_record(FIRSTNAME,LASTNAME,EMAIL,PHONE,ADDRESS,DATE)VALUES('$fname','$lname','$email','$phone','$address','$date')";    

    if ($conn->query($sql)) {

        if(isset($_POST['FIRSTNAME']) && isset($_POST['LASTNAME']) && isset($_POST['EMAIL']) && isset($_POST['PHONE']) && isset($_POST['ADDRESS'])){
            $fname = $_POST['FIRSTNAME'];
            $lname = $_POST['LASTNAME'];
            $email = $_POST['EMAIL'];
            $phone = $_POST['PHONE'];
            $address = $_POST['ADDRESS'];
            $venue = $_POST['venue'];
            $layanan = $_POST['layanan'];
            $date = date('m/d/Y', strtotime($date));
            $no1 = random_int(10, 10000);
            $no2 = random_int(10, 10000);
            $no3 = random_int(10, 10000);
            $stmt = $conn->prepare("SELECT harga FROM data_fasilitas WHERE layanan = '$layanan'");
            $stmt->execute();
            $results = $stmt->get_result();
            while ($row = $results->fetch_array(MYSQLI_ASSOC))
            {
                $points = $row['harga'];
            }

            require_once __DIR__ . '/vendor/autoload.php';

            $html ='
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Cetak Bukti Pemesanan</title>
            </head>
            <body>
                <table>
                    <tr>
                        <td>        <img src="prop/grafika.png" width="60px"></td>
                        <td style="padding-left:23%;" align="center">        <h3 style="text-align: center; font-family:Times New Roman;">Bukti Pemesanan</h3>
                        <h4 style="text-align: center; font-family:Times New Roman;">Layanan SMK Negeri 4 Malang</h4>
                        <p style="text-align: center; font-size:10px; padding-top:0px;">Jl. Tanimbar No.22, Kasin, Kec. Klojen,<br> Kota Malang, Jawa Timur 65117</p></td>
                    </tr>
                </table>
                <hr style="color: black;">
                <p style="font-size: 12px;padding-top:-10px;"> Nomor Booking : '; $html .= $no1 . '-' . $no2 . '-' . $no3; $html .='</p><br>
                <p style="font-size: 12px; padding-top:-40px;"> Tanggal Booking : ';$html .= $date;
                $html .= '</p>
                <p style="padding-top:60px; font-size:13px;">Terimakasih atas kepercayaan anda memesan layanan di SMK Negeri 4 Malang.<br>
                Berikut kami informasikan data pendaftaran anda sebagai berikut :</p>
                <table style="font-size: 13px;">';
                $html .= '<tr>
                <td>Nama Depan</td>
                <td> : </td>
                <td>'. $fname .'</td>
                </tr>';
                $html .= '<tr>
                <td>Nama Belakang</td>
                <td> : </td>
                <td>'. $lname .'</td>
                </tr>';
                $html .= '<tr>
                <td>Email</td>
                <td> : </td>
                <td>'. $email .'</td>
                </tr>';
                $html .= '<tr>
                <td>No Telepon</td>
                <td> : </td>
                <td>'. $phone .'</td>
                </tr>';
                $html .= '<tr>
                <td>Alamat</td>
                <td> : </td>
                <td>'. $address .'</td>
                </tr>';
                $html .= '<tr>
                <td>Layanan</td>
                <td> : </td>
                <td>'. $venue . ' ' . $layanan . '</td>
                </tr>';
                $html .= '</table>
                <p style="font-size: 13px;">Untuk kenyamanan anda, mohon dapat melakukan melalui salah satu bank pilihan di bawah ini :</p>
                <table style="font-size: 13px;">
                    <tr>
                        <td>Nominal Pembayaran</td>
                        <td> : </td>
                        <td>'; $html .= 'Rp. ' . $points; $html.= '</td>
                    </tr>
                    <tr>
                        <td>BRI A/N Muhammad Zulfan</td>
                        <td> : </td>
                        <td>8900001620911806</td>
                    </tr>
                </table>
                <p style="font-size: 13px;">Informasi lebih lanjut silahkan menghubungi melalui email kami di mail@smkn4malang.sch.id.<br> Terimakasih.</p>
            </body>
            </html>';
            
            $mpdf  = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($html);

            $pdf = $mpdf->output("", "S");

            function sendEmail($pdf){
                $mail = new PHPMailer(true);

                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'smkn4malang.layanan@gmail.com';
                $mail->Password = 'vnrhicclcogaurqj';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                $mail->setFrom('smkn4malang.layanan@gmail.com');
                $mail->addAddress($_POST['EMAIL']);
                
                $mail->addStringAttachment($pdf, "bukti_cetak.pdf");

                $mail->isHTML(true);
                $mail->Subject = "Bukti Cetak Pemesanan Layanan Hall & Labana SMKN 4 Malang";
                $mail->Body = "Berikut adalah file bukti cetak yang telah anda buat untuk booking online layanan SMKN 4 Malang.";
                $mail->send();
            }
            sendEmail($pdf);
        }
    }

    echo "<script>
        alert('Terkirim!');
        document.location.href = 'form.php';
    </script>";
}


?>
<?php
$a = mt_rand(100000, 999999);

for ($i = 0; $i < 6; $i++) {
    $a .= mt_rand(0, 9);
} ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking - Persewaan Layanan Grafika</title>
    <link rel="icon" href="prop/grafika.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/main.css">
</head>

<body>
    <div class="container">
        <h1 class="text-center alert alert-danger" style="background:#2ecc71;border:none;color:#fff"> Tanggal Booking:
            <?php echo date('m/d/Y', strtotime($date)); ?></h1>
        <div class="row">
            <div class="col-md-12">
                <?php echo isset($message) ? $message : ''; ?>
                <form action="" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label for=""> NAMA DEPAN</label>
                        <input type="text" class="form-control" name="FIRSTNAME" required>
                        <input type="hidden" class="form-control" name="AUTONUM" value="<?php echo 'TRAC' . $a; ?>"
                            required>
                    </div>
                    <div class="form-group">
                        <label for=""> NAMA BELAKANG</label>
                        <input type="text" class="form-control" name="LASTNAME" required>
                    </div>
                    <div class="form-group">
                        <label for=""> EMAIL</label>
                        <input type="email" class="form-control" name="EMAIL" required>
                    </div>
                    <div class="form-group">
                        <label for=""> NO TELEPON</label>
                        <input type="text" class="form-control" name="PHONE" required>
                    </div>
                    <div class="form-group">
                        <label for=""> ALAMAT</label>
                        <input type="text" class="form-control" name="ADDRESS" required>
                    </div>
                    <script>
                        function my_fun(str){
                            if(window.XMLHttpRequest){
                                xmlhttp = new XMLHttpRequest();
                            }else{
                                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                            }
                            xmlhttp.onreadystatechange= function(){
                                if(this.readyState==4 && this.status==200){
                                    document.getElementById('poll').innerHTML = this.responseText;
                                }
                            }
                            xmlhttp.open("GET","dropdown.php?value="+str, true);
                            xmlhttp.send();
                        }
                    </script>
                    <div class="form-group">
                        <label for=""> FASILITAS</label><br>
                        <select class="form-select form-select-lg mb-3" name="venue" id="SelectA" onchange="my_fun(this.value);">
                            <option>--Pilih Venue--</option>
                            <?php
                                include "admin/includes/conn.php";

                                $query = $conn->query("SELECT DISTINCT nama FROM data_fasilitas");
                                while($row = $query->fetch_assoc()){?>
                                    <option value="<?= $row['nama'] ?>"><?= $row['nama'] ?></option>
                                   <?php
                                }
                            ?>
                        </select>
                        <select class="form-select form-select-lg mb-3" name="layanan" id="poll">
                            <option>--Pilih Layanan--</option>
                        </select>
                    </div>


                    <button type="submit" name="submit" class="btn btn-primary"> Submit </button>
                    <a href="form.php" class="btn btn-success">Back</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>