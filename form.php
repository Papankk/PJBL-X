<?php

function build_calendar($month, $year)
{

    $mysqli = new mysqli('localhost', 'root', '', 'bookingsysystem');

    $stmt = $mysqli->prepare("SELECT * FROM bookings_record WHERE MONTH(DATE) = ? AND YEAR(DATE) = ?");

    $stmt->bind_param('ss', $month, $year);

    $bookings = array();

    if ($stmt->execute()) {

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

                $bookings[] = $row['DATE'];
            }



            $stmt->close();
        }
    }





    $daysOfWeek = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');

    $firstDayOfMonth = mktime(0, 0, 0, (int)$month, 1, $year);

    $numberDays = date('t', $firstDayOfMonth);

    $dateComponents = getdate($firstDayOfMonth);

    $monthName = $dateComponents['month'];

    $dayOfWeek = $dateComponents['wday'];



    $datetoday = date('Y-m-d');



    $calendar = "<table class='table table-bordered'>";

    $calendar .= "<center><h2>$monthName $year</h2>";

    $calendar .= "<a class='btn btn-xs btn-success' href='?month=" . date('m', mktime(0, 0, 0, (int)$month - 1, 1, $year)) . "&year=" . date('Y', mktime(0, 0, 0, (int)$month - 1, 1, $year)) . "'><<</a> ";

    $calendar .= " <a class='btn btn-xs btn-danger' href='?month=" . date('m') . "&year=" . date('Y') . "'>Bulan Sekarang</a> ";

    $calendar .= "<a class='btn btn-xs btn-primary' href='?month=" . date('m', mktime(0, 0, 0, (int)$month + 1, 1, $year)) . "&year=" . date('Y', mktime(0, 0, 0, (int)$month + 1, 1, $year)) . "'>>></a></center><br>";





    $calendar .= "<tr>";

    foreach ($daysOfWeek as $day) {

        $calendar .= "<th  class='header'>$day</th>";
    }



    $currentDay = 1;

    $calendar .= "</tr><tr>";





    if ($dayOfWeek > 0) {

        for ($k = 0; $k < $dayOfWeek; $k++) {

            $calendar .= "<td  class='empty'></td>";
        }
    }



    $month = str_pad((int)  $month, 2, "0", STR_PAD_LEFT);



    while ($currentDay <= $numberDays) {



        if ($dayOfWeek == 7) {



            $dayOfWeek = 0;

            $calendar .= "</tr><tr>";
        }



        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);

        $date = "$year-$month-$currentDayRel";



        $dayname = strtolower(date('l', strtotime($date)));

        $eventNum = 0;

        $today = $date == date('Y-m-d') ? "today" : "";

        if ($date < date('Y-m-d')) {

            $calendar .= "<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs' disabled>N/A</button>";
        } elseif (in_array($date, $bookings)) {

            $calendar .= "<td class='$today'><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'> <span class='glyphicon glyphicon-lock

             '></span> Sudah Terbook</button>";
        } else {

            $calendar .= "<td class='$today'><h4>$currentDay</h4> <a href='book.php?date=" . $date . "' class='btn btn-success btn-xs'> <span class='glyphicon glyphicon-ok'></span> Tersedia</a>";
        }



        $calendar .= "</td>";

        $currentDay++;

        $dayOfWeek++;
    }



    if ($dayOfWeek != 7) {



        $remainingDays = 7 - $dayOfWeek;

        for ($l = 0; $l < $remainingDays; $l++) {

            $calendar .= "<td class='empty'></td>";
        }
    }



    $calendar .= "</tr>";

    $calendar .= "</table>";

    echo $calendar;
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>SMK Negeri 4 Malang - Persewaan</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="script.js"></script>
    <link rel="icon" href="prop/grafika.png" type="image/png">
    <style>
    @media only screen and (max-width: 760px),
    (min-device-width: 802px) and (max-device-width: 1020px) {

        /* Force table to not be like tables anymore */
        table,
        thead,
        tbody,
        th,
        td,
        tr {
            display: block;

        }



        .empty {
            display: none;
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        th {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        tr {
            border: 1px solid #ccc;
        }

        td {
            /* Behave  like a "row" */
            border: none;
            border-bottom: 1px solid #eee;
            position: relative;
            padding-left: 50%;
        }



        /*
		Label the data
		*/
        td:nth-of-type(1):before {
            content: "Minggu";
        }

        td:nth-of-type(2):before {
            content: "Senin";
        }

        td:nth-of-type(3):before {
            content: "Selasa";
        }

        td:nth-of-type(4):before {
            content: "Rabu";
        }

        td:nth-of-type(5):before {
            content: "Kamis";
        }

        td:nth-of-type(6):before {
            content: "Jumat";
        }

        td:nth-of-type(7):before {
            content: "Sabtu";
        }


    }

    /* Smartphones (portrait and landscape) ----------- */

    @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
        body {
            padding: 0;
            margin: 0;
        }
    }

    /* iPads (portrait and landscape) ----------- */

    @media only screen and (min-device-width: 802px) and (max-device-width: 1020px) {
        body {
            width: 495px;
        }
    }

    @media (min-width:641px) {
        table {
            table-layout: fixed;
        }

        td {
            width: 33%;
        }
    }

    .row {
        margin-top: 20px;
    }

    .today {
        background: #eee;
    }
    </style>
</head>

<body>
    <div class="bg">
        <!--Navbar-->

        <nav class="container-fluid wrapper navi-scrolled">
            <div class="brand">
                <div class="logo"><a href="index.html"><img src="prop/grafika.png" alt="logo" height="125px" width="100px"></a>
                </div>
                <div class="title title-scrolled"><a style="text-decoration: none; color: black;" href="index.html">SMK Negeri 4
                        Malang</a></div>
            </div>
            <ul class="navi-container">
                <li><a href="index.html">Tentang</a></li>
                <li><a href="howto.html">Cara Booking Online</a></li>
                <li><a href="#">Booking Sekarang</a></li>
            </ul>
        </nav>
        <!--Isi-->

        <div style="padding-top: 170px;" class="container alert alert-default" style="background:#fff">
        <div class="row">
            <div class="col-md-12">
                <?php
                $dateComponents = getdate();
                if (isset($_GET['month']) && isset($_GET['year'])) {
                    $month = $_GET['month'];
                    $year = $_GET['year'];
                } else {
                    $month = $dateComponents['month'];
                    $year = $dateComponents['year'];
                }
                echo build_calendar($month, $year);
                ?>

            </div>
        </div>
    </div>

    </div>


    <!-- Footer -->

    <footer class="text-center text-white" style="background-color: rgba(0, 0, 0, 0.5)">
        <div class="container-fluid">
            <section class="mt-5">
                <div class="row text-center d-flex justify-content-center pt-5">

                    <div class="col-md-2">
                        <h6 class="text-uppercase font-weight-bold">
                            <a href="index.html" style="text-decoration: none;" class="text-white">Tentang</a>
                        </h6>
                    </div>

                    <div class="col-md-2">
                        <h6 class="text-uppercase font-weight-bold">
                            <a href="howto.html" style="text-decoration: none;" class="text-white">Cara Booking
                                Online</a>
                        </h6>
                    </div>

                    <div class="col-md-2">
                        <h6 class="text-uppercase font-weight-bold">
                            <a href="#!" style="text-decoration: none;" class="text-white">Booking Sekarang</a>
                        </h6>
                    </div>
                </div>
            </section>

            <hr class="my-5" />

            <section class="mb-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <p>
                            Website / Projek ini kami buat atas kewajiban untuk menorehkan nilai yang baik dan untuk
                            pengerjaan Project Based Learning untuk jurusan RPL di SMKN 4 Malang
                        </p>
                    </div>
                </div>
            </section>
            <section class="text-center mb-5">
                <a href="" class="text-white me-4">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fab fa-google"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fab fa-instagram"></i>
                </a>
            </section>
        </div>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            ©
            <a class="text-white" href="https://www.instagram.com/papankkk">PROJEK ELON MUSK</a>
        </div>
    </footer>
</body>

</html>