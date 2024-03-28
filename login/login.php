<?php
require("../config/db2.php");
$con = connect_db(0);

//query MAX ID 
$sql =   "SELECT MAX(code_member ) AS last_id FROM all_user ";
$qry = mysqli_query($con, $sql) or die(mysqli_error($con));
$rs = mysqli_fetch_assoc($qry);
$maxId = substr($rs['last_id'], -5);  //ข้อมูลนี้จะติดรหัสตัวอักษรด้วย ตัดเอาเฉพาะตัวเลขท้ายนะครับ
//$maxId = 1;   //<--- บรรทัดนี้เป็นเลขทดสอบ ตอนใช้จริงให้ ลบ! ออกด้วยนะครับ
$maxId = (intval($maxId) + 1);

$maxId = substr("000000" . $maxId, -5);
$nextId = $maxId;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Faikham Hotel-Login/Register</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="../img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Header Start -->
        <div class="container-fluid bg-dark px-0">
            <div class="row gx-0">
                <div class="col-lg-3 bg-dark d-none d-lg-block">
                    <a href="../index.php" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                        <h1 class="m-0 text-primary text-uppercase">Fai Kham</h1>
                    </a>
                </div>
                <div class="col-lg-9">
                    <div class="row gx-0 bg-white d-none d-lg-flex">
                        <div class="col-lg-7 px-5 text-start">
                            <div class="h-100 d-inline-flex align-items-center py-2 me-4">
                                <i class="fa fa-envelope text-primary me-2"></i>
                                <p class="mb-0">Faikham</p>
                            </div>
                            <div class="h-100 d-inline-flex align-items-center py-2">
                                <i class="fa fa-phone-alt text-primary me-2"></i>
                                <p class="mb-0">+012 345 6789</p>
                            </div>
                        </div>
                        <div class="col-lg-5 px-5 text-end">
                            <div class="d-inline-flex align-items-center py-2">
                                <a class="me-3" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="me-3" href=""><i class="fab fa-twitter"></i></a>
                                <a class="me-3" href=""><i class="fab fa-linkedin-in"></i></a>
                                <a class="me-3" href=""><i class="fab fa-instagram"></i></a>
                                <a class="" href=""><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                    <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0">
                        <a href="../index.php" class="navbar-brand d-block d-lg-none">
                            <h1 class="m-0 text-primary text-uppercase">FAIKHAM</h1>
                        </a>
                        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                            <div class="navbar-nav mr-auto py-0">
                                <a href="../index.php" class="nav-item nav-link">หน้าเเรก</a>
                                <a href="../guest/about.php" class="nav-item nav-link">เกี่ยวกับเรา</a>
                                <a href="../guest/room.php" class="nav-item nav-link">ห้องของเรา</a>
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">ข่าวประชาสัมพันธ์</a>
                                    <div class="dropdown-menu rounded-0 m-0">
                                        <a href="../guest/news.php" class="dropdown-item">ข่าวประชาสัมพันธ์</a>
                                        <a href="../guest/promotion.php" class="dropdown-item">โปรโมชั่น</a>
                                    </div>
                                </div>

                                <a href="../guest/review.php" class="nav-item nav-link">รีวิว</a>

                                <a href="login/login.php" class="nav-item nav-link active">Login/Register</a>
                            </div>
                            <!-- <a href="https://htmlcodex.com/hotel-html-template-pro" class="btn btn-primary rounded-0 py-4 px-md-5 d-none d-lg-block">Premium Version<i class="fa fa-arrow-right ms-3"></i></a> -->
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Header End -->


        <!-- Carousel Start -->
        <div class="container-fluid p-0 mb-5">
            <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="w-100" src="../imge/faikham-1.png" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-top">
                            <div class="p-0" style="max-width: 700px;">
                                <h5 class="section-title text-white text-uppercase mb-3 animated slideInDown">LOGIN</h5>
                                <div class="p-0" style="max-width: 500px;">
                                    <h6 class=" text-white text-uppercase mb-3 animated slideInDown">FAIKHAM HOTEL</h6>
                                </div>
                                <div class="form-group">
                                </div>
                            </div>
                            <br><br><br><br>
                            <!-- Booking Start -->
                            <div class="p-3" style="max-width: 1200px;">
                                <div class="container-fluid booking pb-5 wow fadeIn data-bs-slide" data-wow-delay="0.1s">
                                    <div class="container">
                                        <div class="bg-white shadow" style="padding: 35px;">


                                            <div class=" col-lg-12 col-md-12 col-xl-12 ">

                                                <div class=" col-lg-12 col-md-12 col-xl-12 ">
                                                    <!-- จัดคอลัมน เพื่อให้อยู่กลาง -->

                                                    <div class="p-3">
                                                        <div class="text-center p-4">
                                                            <img src="../imge/logo.png" width="150" height="150">
                                                            <h4 class="text-gray-900 mb- pt-2 ">กรุณาลงชื่อเข้าสู่ระบบ</h4>
                                                        </div>
                                                        <form class=" user form-subscribe" id="contactForm" data-sb-form-api-token="API_TOKEN" action="check_login.php" method="POST" enctype="multipart/form-data">
                                                            <div class="form-group">
                                                                <input class="form-control form-control-lgi" name="username" placeholder="Username" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <p> </p>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="password" class="form-control form-control-lgi" name="passwd" placeholder="Password" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <p> </p>
                                                            </div>
                                                            <div><input class="btn btn-primary btn-user btn-block" type="submit" name="Login" value="Login">
                                                                <button type="button" class="btn btn-dark btn-user btn-block" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                    Register
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Carousel End -->
                <!-- register star -->
                <form action="insertuser.php" method="POST" enctype="multipart/form-data">

                    <div class="col-lg">
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">สมัครสมาชิก</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row">


                                            <div>

                                                <input type="hidden" class="form-control" id="Input_Text" name="codee" value="<?php echo $nextId; ?>" required>
                                            </div>



                                            <div class="col-sm">
                                                <div class="mt-2">
                                                    <div>
                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ชื่อผู้ใช้งาน</label>
                                                        <input type="text" class="form-control" id="Input_Text" name="cus_username" placeholder="ตัวอย่าง : thana" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm">
                                                <div class="mt-2">
                                                    <div>
                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">รหัสผ่าน</label>
                                                        <input type="password" class="form-control" id="Input_Text" name="cus_password" placeholder="ตัวอย่าง : 1234" maxlength="16" required>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-sm">
                                                <div class="mt-2">
                                                    <div>
                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ชื่อ</label>
                                                        <input type="text" class="form-control" id="Input_Text" name="cus_name" placeholder="ตัวอย่าง : นาย อร่อยมาก" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm">
                                                <div class="mt-2">
                                                    <div>
                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">นามสกุล</label>
                                                        <input type="text" class="form-control" id="Input_Text" name="cus_lastname" placeholder="ตัวอย่าง : ธนาบดี" required>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-sm">
                                                <div class="mt-2">
                                                    <div>
                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">อีเมล์</label>
                                                        <input type="text" class="form-control" id="Input_Text" name="cus_email" placeholder="ตัวอย่าง : user01@gmail.com">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm">
                                                <div class="mt-2">
                                                    <div>
                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">เบอร์มือถือ</label>
                                                        <input type="text" class="form-control" id="Input_Text" name="cus_tel" placeholder="ตัวอย่าง : 0910791234" required maxlength="10">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-sm">
                                                <div class="mt-2">
                                                    <div>
                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ที่อยู่</label>
                                                        <input type="text" class="form-control" id="Input_Text" name="cus_address" placeholder="ตัวอย่าง : 60/1 หมู่10" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm">
                                                <div class="mt-2">
                                                    <div>
                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ตำบล</label>
                                                        <input type="text" class="form-control" id="Input_Text" name="cus_address_county" placeholder="ตัวอย่าง : วังดิน" required>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-sm">
                                                <div class="mt-2">
                                                    <div>
                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">อำเภอ</label>
                                                        <input type="text" class="form-control" id="Input_Text" name="cus_address_district" placeholder="ตัวอย่าง : เมือง" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm">
                                                <div class="mt-2">
                                                    <div>
                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">จังหวัด</label>
                                                        <input type="text" class="form-control" id="Input_Text" name="cus_address_district_2" placeholder="ตัวอย่าง : อุตรดิตถ์" required>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-sm">
                                            <div class="mt-2">
                                                <div>
                                                    <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">รหัสไปรษณีย์</label>
                                                    <input type="text" class="form-control" id="Input_Text" name="cus_address_zipcode" placeholder="ตัวอย่าง : 53000" required maxlength="5">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="mt-2">
                                                <div>
                                                    <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;"></label>
                                                    <input type="hidden" class="form-control" id="Input_Text" name="cus_role" value="mem" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="mt-2">
                                                <div>
                                                    <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;"></label>
                                                    <input type="hidden" class="form-control" id="Input_Text" name="cus_sala" value="0" required>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                        <button type="sumbit" class="btn btn-primary" name="sumbit_register">สมัครสมาชิก</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Register end -->

                <!-- Newsletter Start -->
                <div class="container newsletter mt-5 wow fadeIn" data-wow-delay="0.1s">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 border rounded p-1">
                            <div class="border rounded text-center p-1">
                                <div class="bg-white rounded text-center p-5">
                                    <h4 class="mb-4">Designed By<span class="text-primary text-uppercase">FAIKHAM</span></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Newsletter Start -->


                <!-- Footer Start -->
                <div class="container-fluid bg-dark text-light footer wow fadeIn">
                    <div class="container">
                        <div class="copyright">

                        </div>
                    </div>
                </div>
                <!-- Footer End -->



                <!-- Back to Top -->
                <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
            </div>

            <!-- JavaScript Libraries -->
            <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="../lib/wow/wow.min.js"></script>
            <script src="../lib/easing/easing.min.js"></script>
            <script src="../lib/waypoints/waypoints.min.js"></script>
            <script src="../lib/counterup/counterup.min.js"></script>
            <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
            <script src="../lib/tempusdominus/js/moment.min.js"></script>
            <script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
            <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

            <!-- Template Javascript -->
            <script src="../js/main.js"></script>
</body>

</html>