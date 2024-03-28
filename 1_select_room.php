<?php

require_once 'config/db.php';

$save_raw_value_1 = ""; // ชื่อ
$save_raw_value_2 = ""; // นามลกุล
$save_raw_value_3 = ""; // อีเมล
$save_raw_value_4 = $_GET['test_1']; // เช็ค In
$save_raw_value_5 = $_GET['test_2']; // เช็ค Out
$save_raw_value_6 = $_GET['test_3']; // โรงเเรม
$save_raw_value_7 = "";

//! IF ZONE //
{
    $selected_1 = "";
    $selected_2 = "";
    if (($save_raw_value_6) == 1) {

        $selected_1 = "selected";
    } else {

        $selected_2 = "selected";
    }

    $selected_3 = "";
    $selected_4 = "";
    if (($save_raw_value_7) == 1) {

        $selected_3 = "selected";
    } else {

        $selected_4 = "selected";
    }
}
//! END IF ZONE //

//! FORMAT DAY //
{
    $a = new \DateTime($save_raw_value_4);
    $b = new \DateTime($save_raw_value_5);

    $save_amount_day = $a->diff($b)->days;
}
//! END FORMAT DAY //


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>รายละเอียดการจอง</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Header Start -->
    <div class="container-fluid bg-dark px-0">
        <div class="row gx-0">
            <div class="col-lg bg-dark d-none d-lg-block">
                <a href="index.php" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                    <h1 class="m-0 text-primary text-uppercase">Faikham</h1>
                </a>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title text-center text-primary text-uppercase">Room Booking</h6>
                <h1 class="mb-5">รายละเอียด <span class="text-primary text-uppercase">การจอง</span></h1>
            </div>
            <div class="row g-5">

                <div class="col-lg-12 w-50 m-auto">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">

                        <form action="2_detail_room.php" method="post" enctype="multipart/form-data">

                            <div class="row g-3 mt-2">

                                <h4 class="mb-2 m-auto text-center">จำนวนวันที่ท่านจอง <?php echo $save_amount_day ?> วัน</span></h1>

                                    <div class="col-md-6">
                                        <div class="form-floating date" id="date3" data-target-input="nearest">
                                            <input type="date" class="form-control datetimepicker-input" id="checkin" placeholder="Check In" name="test_1_select_room" value="<?php echo $save_raw_value_4 ?>" />
                                            <label for="checkin">Check In</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating date" id="date4" data-target-input="nearest">
                                            <input type="date" class="form-control datetimepicker-input" id="checkout" placeholder="Check Out" name="test_2_select_room" value="<?php echo $save_raw_value_5 ?>" />
                                            <label for="checkout">Check Out</label>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="name" placeholder="ชื่อจริง" name="test_3_select_room" value="">
                                            <label for="name">ชื่อจริง</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="email" placeholder="นามสกุล" name="test_4_select_room" value="">
                                            <label for="last_name">นามสกุล</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="email" placeholder="อีเมล์" name="test_5_select_room" value="">
                                            <label for="email">อีเมล์</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="email" placeholder="เบอร์มือถือ" name="test_6_select_room" value="" maxlength="10" required>
                                            <label for="last_name">เบอร์มือถือ</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select class="form-select" id="select2" name="test_7_select_room">
                                                <option value="1"<?=($_GET['test_3']=='1') ? 'selected':'' ?> >Faikham Hotel</option>
                                                <option value="2"<?=($_GET['test_3']=='2') ? 'selected':'' ?> >Faikham Boutique</option>
                                            </select>
                                            <label for="select2">เลือกโรงแรม</label>
                                        </div>
                                    </div>

                                    <hr>

                                    <!-- <div class="col-md-5 mt-2 mb-2">
                                        <button type="button" class="btn btn-primary w-100 py-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            รายละเอียดทั้งหมดของห้องพัก
                                        </button>
                                    </div> -->

                                    <div class="col-md-6 mt-2 mb-2">
                                        <div class="form-floating">
                                            <select class="form-select" name="test_8_select_room">
                                                <option value="1">ห้องพักขนาดปกติ</option>
                                                <option value="2">ห้องพักขนาดพิเศษ</option>
                                            </select>
                                            <label for="select2">เลือกห้องพัก</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-2 mb-2">
                                        <div class="form-floating">
                                            <select class="form-select" name="test_9_select_room">
                                                <option value="1" selected>1 ห้อง</option>
                                                <option value="2">2 ห้อง</option>
                                                <option value="3">3 ห้อง</option>
                                                <option value="4">4 ห้อง</option>
                                                <option value="5">5 ห้อง</option>
                                            </select>
                                            <label for="select2">จำนวนหัองพัก</label>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="col-md-12 mt-2 mb-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="name" placeholder="เพิ่มเติม **ไม่สามารถเพิ่มเตียงนอนได้เนื่องจากขนาดของห้อง**" name="test_10_select_room" value="">
                                            <label for="name">เพิ่มเติม **ไม่สามารถเพิ่มเตียงนอนได้เนื่องจากขนาดของห้อง**</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 py-3" type="submit" name="Page_1_select_room">ต่อไป</button>
                                    </div>
                            </div>
                        </form>

                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">รายละเอียดทั้งหมดของห้องพัก</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="card mb-2">
                                            <div class="card-body">
                                                <h5 class="card-title">Card title</h5>
                                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                            </div>
                                            <img src="img/bg_w.jpg" class="card-img-bottom" alt="..." width="200" height="200">
                                        </div>

                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Card title</h5>
                                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                            </div>
                                            <div class="col-md-12">
                                                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-inner">
                                                        <div class="carousel-item active">
                                                            <img src="img/2.jpg" class="d-block w-100" alt="..." height="50%">
                                                        </div>
                                                        <div class="carousel-item">
                                                            <img src="img/1.jpg" class="d-block w-100" alt="..." height="50%">
                                                        </div>
                                                        <div class="carousel-item">
                                                            <img src="img/0.1.png" class="d-block w-100" alt="..." height="50%">
                                                        </div>
                                                    </div>
                                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Previous</span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Next</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>





    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>