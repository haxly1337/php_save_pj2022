<?php

session_start();
error_reporting(E_ALL ^ E_NOTICE);

require_once 'config/db.php';

$save_user_id = $_SESSION['user_id'];
$save_user_name = $_SESSION['user_Name'];
$save_user_valid_user = $_SESSION['valid_user'];
$save_user_role = $_SESSION['user_Position'];

if (!isset($_SESSION['user_id'])) {
    $show_something_1 = "0"; // ไม่ได้สมัคร
} else {
    $show_something_1 = "1"; // สมัครเเล้ว
}

//! Format Zone And Check //
{
    $save_user_name_show = "คุณ : " . $save_user_name;
}
//! Format Zone //

//! Edit Profile Zone //
{
    $code_members = $_SESSION['id'];

    $detail = mysqli_query($conn, "SELECT * FROM all_user WHERE id ='$code_members'") or die(mysqli_error($conn));
    list(
        $member_id, //1
        $code_member, //2
        $first_name, //3
        $last_name, //4
        $username, //5
        $passwrd, //6
        $email, //7
        $tel, //8
        $img, //9
        $address, //10
        $address_county, //11
        $address_district1, //12
        $address_district2, //13
        $address_zipcode, //14
        $roles, //15
        $salary //16
    ) = mysqli_fetch_row($detail);
}
//! Edit Profile Zone //

//! Update Proflie //
{

    if (isset($_POST['sumbit_to_edit'])) 
    {
        mysqli_query($conn, "UPDATE all_user SET
        code_member='$_POST[codee]',
        first_name='$_POST[cus_name]' ,
        last_name='$_POST[cus_lastname]',
        username='$_POST[cus_username]',
        password='$_POST[cus_password]',
        email='$_POST[cus_email]',
        tel='$_POST[cus_tel]',
        img='$_POST[member_img]',
        address='$_POST[cus_address]',
        address_county='$_POST[cus_address_county]',
        address_district='$_POST[cus_address_district]',
        address_district2='$_POST[cus_address_district_2]',
        address_zipcode='$_POST[cus_address_zipcode]',
        role='$_POST[cus_role]',
        salary='$_POST[cus_sala]'
        WHERE id='$_POST[member_id]'") or die(mysqli_error($conn));

        $message_wronguserorpassword = "เเก้ไขข้อมูลส่วนตัวสำเร็จ";
        echo "<script type='text/javascript'>alert('$message_wronguserorpassword ');</script>";
        header("Refresh:0");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Faikham</title>
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
                    <a href="index.php" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
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
                        <a href="index.php" class="navbar-brand d-block d-lg-none">
                            <h1 class="m-0 text-primary text-uppercase">FAIKHAM</h1>
                        </a>
                        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                            <div class="navbar-nav mr-auto py-0">
                                <a href="index.php" class="nav-item nav-link">หน้าเเรก</a>
                                <a href="#about" class="nav-item nav-link">เกี่ยวกับเรา</a>
                                <a href="guest/room.php" class="nav-item nav-link">ห้องของเรา</a>
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">ข่าวประชาสัมพันธ์</a>
                                    <div class="dropdown-menu rounded-0 m-0">
                                        <a href="guest/news.php" class="dropdown-item">ข่าวประชาสัมพันธ์</a>
                                        <a href="guest/promotion.php" class="dropdown-item">โปรโมชั่น</a>
                                    </div>
                                </div>

                                <a href="guest/review.php" class="nav-item nav-link">รีวิว</a>

                                <?php
                                if (($show_something_1) == 0) {
                                    echo '<a href="login/login.php" class="nav-item nav-link">Login/Register</a>';
                                } else {
                                    echo
                                    '

                                    <a href="guest/table_booking.php" class="nav-item nav-link">ตารางการจอง</a>

                                    <div class="nav-item dropdown">
                                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> ' . $save_user_name_show . '</a>
                                        <div class="dropdown-menu rounded-0 m-0">
                                            <a href="" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal_Edit">ข้อมูลส่วนตัว</a>
                                            <a href="logout_index.php" class="dropdown-item">ออกจากระบบ</a>
                                        </div>
                                    </div>
                                        ';
                                }
                                ?>

                                <!-- <a href="info_me.php" class="dropdown-item">ข้อมูลส่วนตัว</a> -->

                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                                    <div class="modal fade" id="exampleModal_Edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">เเก้ไขข้อมูลส่วนตัว</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="row">

                                                        <div>
                                                            <input type="hidden" class="form-control" id="Input_Text" name="member_id" value="<?php echo $member_id; ?>" readonly>
                                                        </div>

                                                        <div>
                                                            <input type="hidden" class="form-control" id="Input_Text" name="member_img" value="<?php echo $img; ?>" readonly>
                                                        </div>

                                                        <div>
                                                            <input type="hidden" class="form-control" id="Input_Text" name="codee" value="<?php echo $code_member; ?>" readonly>
                                                        </div>

                                                        <div class="col-sm">
                                                            <div class="mt-2">
                                                                <div>
                                                                    <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ชื่อผู้ใช้งาน</label>
                                                                    <input type="text" class="form-control" id="Input_Text" name="cus_username" value="<?php echo $username; ?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm">
                                                            <div class="mt-2">
                                                                <div>
                                                                    <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">รหัสผ่าน</label>
                                                                    <input type="text" class="form-control" id="Input_Text" name="cus_password" value="<?php echo $passwrd; ?>" maxlength="16" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-sm">
                                                            <div class="mt-2">
                                                                <div>
                                                                    <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ชื่อ</label>
                                                                    <input type="text" class="form-control" id="Input_Text" name="cus_name" value="<?php echo $first_name; ?>" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm">
                                                            <div class="mt-2">
                                                                <div>
                                                                    <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">นามสกุล</label>
                                                                    <input type="text" class="form-control" id="Input_Text" name="cus_lastname" value="<?php echo $last_name; ?>" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-sm">
                                                            <div class="mt-2">
                                                                <div>
                                                                    <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">อีเมล์</label>
                                                                    <input type="text" class="form-control" id="Input_Text" name="cus_email" value="<?php echo $email; ?>">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm">
                                                            <div class="mt-2">
                                                                <div>
                                                                    <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">เบอร์มือถือ</label>
                                                                    <input type="text" class="form-control" id="Input_Text" name="cus_tel" value="<?php echo $tel; ?>" required maxlength="10">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-sm">
                                                            <div class="mt-2">
                                                                <div>
                                                                    <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ที่อยู่</label>
                                                                    <input type="text" class="form-control" id="Input_Text" name="cus_address" value="<?php echo $address; ?>" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm">
                                                            <div class="mt-2">
                                                                <div>
                                                                    <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ตำบล</label>
                                                                    <input type="text" class="form-control" id="Input_Text" name="cus_address_county" value="<?php echo $address_county; ?>" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-sm">
                                                            <div class="mt-2">
                                                                <div>
                                                                    <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">อำเภอ</label>
                                                                    <input type="text" class="form-control" id="Input_Text" name="cus_address_district" value="<?php echo $address_district1; ?>" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm">
                                                            <div class="mt-2">
                                                                <div>
                                                                    <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">จังหวัด</label>
                                                                    <input type="text" class="form-control" id="Input_Text" name="cus_address_district_2" value="<?php echo $address_district2; ?>" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="col-sm">
                                                        <div class="mt-2">
                                                            <div>
                                                                <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">รหัสไปรษณีย์</label>
                                                                <input type="text" class="form-control" id="Input_Text" name="cus_address_zipcode" value="<?php echo $address_zipcode; ?>" required maxlength="5">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm">
                                                        <div class="mt-2">
                                                            <div>
                                                                <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;"></label>
                                                                <input type="hidden" class="form-control" id="Input_Text" name="cus_role" value="<?php echo $roles ?>" required>
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
                                                    <button type="sumbit" class="btn btn-primary" name="sumbit_to_edit">แก้ไขข้อมูล</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <!-- <a href="https://htmlcodex.com/hotel-html-template-pro" class="btn btn-primary rounded-0 py-4 px-md-5 d-none d-lg-block">Premium Version<i class="fa fa-arrow-right ms-3"></i></a> -->
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Header End -->