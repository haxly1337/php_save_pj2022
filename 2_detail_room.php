<?php

require_once 'config/db.php';
    session_start();
    $save_id = $_SESSION['id'];
    $save_raw_value_1 = $_POST['test_1_select_room'];
    $save_raw_value_2 = $_POST['test_2_select_room'];
    $save_raw_value_3 = $_POST['test_3_select_room'];
    $save_raw_value_4 = $_POST['test_4_select_room'];
    $save_raw_value_5 = $_POST['test_5_select_room'];
    $save_raw_value_6 = $_POST['test_6_select_room'];
    $save_raw_value_7 = $_POST['test_7_select_room'];
    $save_raw_value_8 = $_POST['test_8_select_room'];
    $save_raw_value_9 = $_POST['test_9_select_room'];
    $save_raw_value_10 = $_POST['test_10_select_room'];

    //! IF ZONE //
    {
        $selected_1 = "";
        $selected_2 = "";
        if (($save_raw_value_7) == 1) {
            $selected_1 = "selected";
            $select_where = "Faikham Hotel";
        } else {
            $selected_2 = "selected";
            $select_where = "Faikham Boutique";
        }

        $selected_3 = "";
        $selected_4 = "";
        if (($save_raw_value_8) == 1) {
            $selected_3 = "selected";
            $select_room = "ห้องพักขนาดปกติ";
            $room_price = 790;
        } else {
            $selected_4 = "selected";
            $select_room = "ห้องพักขนาดพิเศษ";
            $room_price = 990;
        }

        $selected_5 = "";
        $selected_6 = "";
        $selected_7 = "";
        $selected_8 = "";
        $selected_9 = "";

        if (($save_raw_value_9) == 1) {
            $selected_5 = "selected";
        } else if (($save_raw_value_9) == 2) {
            $selected_6 = "selected";
        } else if (($save_raw_value_9) == 3) {
            $selected_7 = "selected";
        } else if (($save_raw_value_9) == 4) {
            $selected_8 = "selected";
        } else if (($save_raw_value_9) == 5) {
            $selected_9 = "selected";
        }
    }
    //! END IF ZONE //

    //! FORMAT DAY //
    {
        $a = new \DateTime($save_raw_value_1);
        $b = new \DateTime($save_raw_value_2);

        $save_amount_day = $a->diff($b)->days;

        $date_format1 = date("d-m-Y", strtotime($save_raw_value_1));
        $date_format2 = date("d-m-Y", strtotime($save_raw_value_2));

        $total_insert = $room_price * $save_amount_day;
        $total_1_show = ($total_insert * $save_raw_value_9);
        $total_1_show_format = number_format("$total_1_show", 2);

        $todaypay_final = date('m/d/y h:i:sa');
        $todaypay_format = date("m/d/Y H:i:s", strtotime($todaypay_final));
    }
    //! END FORMAT DAY //

//! INSERT ZONE //
{
    if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['sumbit_to_server'])) {
        $ip_checkIn = $_POST['test_1_select_room'];
        $ip_checkOut = $_POST['test_2_select_room'];
        $ip_FirstName = $_POST['test_3_select_room'];
        $ip_LastName = $_POST['test_4_select_room'];
        $ip_Email = $_POST['test_5_select_room'];
        $ip_Tel = $_POST['test_6_select_room'];
        $ip_Hotel = $_POST['test_7_select_room'];
        $ip_rType = $_POST['test_8_select_room'];
        $ip_rAmount = $_POST['test_9_select_room'];
        $ip_Extra = $_POST['test_10_select_room'];
        $ip_bType = $_POST['bank_type'];
        $ip_bTime = $_POST['check_time_transferee'];
        $ip_bName = $_POST['transferee_name'];
        $ip_pc = $_POST['promo_code'];

        if($ip_Hotel == '1')
            $ip_Hotel = 'faikham_hotel';
        else 
            $ip_Hotel = 'faikham_boutique';

        if($ip_rType == '1')
            $ip_rType = 'normal';
        else 
            $ip_rType = 'deluxe_room';

        $total_all_price = $total_1_show - $ip_pc;

        $check_id = "SELECT id FROM list_order_booking ORDER BY id DESC LIMIT 1";
        $check_result = mysqli_query($conn, $check_id);
        if (mysqli_num_rows($check_result) > 0) {
            if ($row = mysqli_fetch_assoc($check_result)) {

                $save_transferee_name = $_POST['transferee_name'];
                $slip_img = $_FILES['image']['name'];
                $temp_slip_img = $_FILES['image']['tmp_name'];
                $targetinto = "img/Slip/" . $slip_img;

                //! GENERATOR ZONE //
                $get_step_1 = "MEM-"; // GT = Guest
                $get_step_2 = date('Ymd'); {
                    if (($ip_rType) == "normal") {
                        $save_step_3 = "-N"; // ห้องปกติ
                        $gen_num = "";
                    } else if (($ip_rType) == "deluxe_room") {
                        $save_step_3 = "-DX"; // ห้องพิเศษ
                    } else {
                        $save_step_3 = "-ERORR";
                    }
                }

                $get_step_final = "$get_step_1" . "$get_step_2" . "$save_step_3";

                $book_id = $row['id'];
                $get_number = str_replace("", "", $book_id);
                $id_inc = $get_number + 1;
                $get_string = str_pad($id_inc, 5, 0, STR_PAD_LEFT);
                $book_id_real =  $get_step_final . $get_string; //book_id

                $bill_id_gen = "B";
                $bill_id_final_gen = $bill_id_gen . "-" . $get_step_2 . "-" . $get_string;
                //! END GENERATOR ZONE //
            }
        }

        $qty_EmptyRoom = "SELECT count(room_id) as count FROM `room_data` WHERE status = 0 AND hotel_where='$ip_Hotel' AND room_type='$ip_rType'";
        $res_EmptyRoom = mysqli_query($conn, $qty_EmptyRoom);
        $countRoom = mysqli_fetch_assoc($res_EmptyRoom);

        if($ip_rAmount > $countRoom['count']) {
            echo "<script>alert('ห้องเต็ม');</script>";
        } else {
            $randRoom = array();
            $qty_rand = "SELECT room_id FROM `room_data` WHERE status = 0 AND hotel_where='$ip_Hotel' AND room_type='$ip_rType' ORDER BY rand() LIMIT $ip_rAmount";
            $res_rand = mysqli_query($conn, $qty_rand);
            if (mysqli_num_rows($res_rand) > 0) {
                foreach ($res_rand as $row) {
                    $randRoom[] = $row['room_id'];
                }

                //stats = 0     ว่าง
                //stats = 1     ยืนยันแล้ว เข้่าพักได้
                //stats = 2     จอง
                foreach ($randRoom as $value) {
                    $qty_Update = "UPDATE `room_data` SET `status`='2' WHERE room_id = '$value' AND hotel_where='$ip_Hotel' AND room_type='$ip_rType'";
                    $res_Update = mysqli_query($conn, $qty_Update);

                    //room_day = room_id
                    $qty_InsertList = "INSERT INTO `list_order_booking`
                    (`book_id`, `hotel_where`, `room_type`, `checkintime`, `checkouttime`, `user_id`, `cus_name`, `room_day`, `total_price`, `status_booking`, `slip_img`, `receipt_who`, `receipt_time`, `receipt_no`, `status_receipt`, `bank_type`, `room_day_total`, `room_status`) 
                    VALUES ('$book_id_real','$ip_Hotel','$ip_rType','$ip_checkIn','$ip_checkOut','$save_id','$ip_FirstName $ip_LastName','$value','$total_all_price','0','$slip_img','$ip_bName','$ip_bTime','$bill_id_final_gen','0','$ip_bType','$save_amount_day','2')";
                    $res_InsertList = mysqli_query($conn, $qty_InsertList);
                    move_uploaded_file($temp_slip_img, $targetinto);
                }
            }

            echo "<script> window.location.href='3_finish_room.php'; </script>";
        }
    }
}
//! END INSERT ZONE //

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

                <div class="col-lg-6">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <div class="card">
                            <div class="card-body">

                                <ul class="list-group list-group-flush">

                                    <li class="list-group-item">

                                        <div class="row">
                                            <div class="col-md-5">
                                                <p>รายการจองทั้งหมด </p>
                                            </div>
                                            <div class="col-md-7">
                                                <p style="text-align: right;"> ชื่อผู้จอง <?php echo $save_raw_value_3 ?> <?php echo $save_raw_value_4 ?> </p>
                                            </div>
                                        </div>

                                    </li>

                                    <li class="list-group-item">

                                        <div class="col-lg-12">

                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p>พักโรงเเรมที่พัก </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p style="text-align: right;"><?php echo $select_where ?></p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p>จองวันที่ <?php echo $date_format1 ?> ถึง <?php echo $date_format2 ?> </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p style="text-align: right;">จำนวน <?php echo $save_amount_day ?> วัน </p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p>จำนวนห้องพัก (<?php echo $select_room ?>)</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p style="text-align: right;">จำนวน <?php echo $save_raw_value_9 ?> ห้อง </p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p>ราคาห้องพัก <span id="price_old" class='text-primary'> </span> </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p style="text-align: right;" id="price_room"> <?=$room_price ?> บาท </p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p>เพิ่มเติม (<?php echo $save_raw_value_10 ?>) </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p style="text-align: right;"> 0 บาท </p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p>ส่วนลด </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p style="text-align: right;" id="price_dc"> 0 บาท </p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p>ยอดรวมทั้งหมด </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p style="text-align: right;" id="price_total"> <?php echo $total_1_show_format ?> บาท </p>
                                                </div>
                                            </div>

                                        </div>

                                    </li>

                                    <li class="list-group-item">

                                        <div class="row">
                                            <div class="col-md-3">
                                                <p class="mt-2">ส่วนลด </p>
                                            </div>
                    
                                            <div class="col-md-3">
                                                <div class="form">
                                                    <div class="col-12">
                                                        <span id="messageUsedCode"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form">
                                                    <div class="col-12">
                                                        <button class="btn btn-primary w-100" onClick="validate(dc_code)"> ใช้ส่วนลด </button> 
                                                    </div>
                                                </div>
                                            </div>

                                            

                                            <div class="col-md-3">
                                                <div class="form">
                                                    <input type="text" class="form-control text-center" id="dc_code" placeholder="DFA28" name="dc_code" value="" maxlength="5">
                                                </div>
                                            </div>

                                        </div>

                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">

                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <div class="form-floating date" id="date3" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" id="checkin" placeholder="Check In" name="test_1_select_room" data-target="#date3" data-toggle="datetimepicker" value="<?php echo $save_raw_value_1 ?>" READONLY />
                                        <label for="checkin">Check In</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating date" id="date4" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" id="checkout" placeholder="Check Out" name="test_2_select_room" data-target="#date4" data-toggle="datetimepicker" value="<?php echo $save_raw_value_2 ?>" READONLY />
                                        <label for="checkout">Check Out</label>
                                    </div>
                                </div>

                                <hr>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" placeholder="ชื่อจริง" name="test_3_select_room" value="<?php echo $save_raw_value_3 ?>" READONLY>
                                        <label for="name">ชื่อจริง</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="email" placeholder="นามสกุล" name="test_4_select_room" value="<?php echo $save_raw_value_4 ?>" READONLY>
                                        <label for="last_name">นามสกุล</label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" placeholder="อีเมล์" name="test_5_select_room" value="<?php echo $save_raw_value_3 ?>" READONLY>
                                        <label for="email">อีเมล์</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="email" placeholder="เบอร์มือถือ" name="test_6_select_room" value="<?php echo $save_raw_value_6 ?>" READONLY>
                                        <label for="last_name">เบอร์มือถือ</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                    <input type="hidden" class="form-control" name="test_7_select_room" value="<?=($save_raw_value_7=='1') ? '1':'2' ?>">
                                        <select class="form-select" id="select2" name="test_7_select_room_disabled" disabled>
                                            <option value="faikham_hotel" <?=($save_raw_value_7=='1') ? 'selected':'' ?>>Faikham Hotel</option>
                                            <option value="faikham_boutique" <?=($save_raw_value_7=='2') ? 'selected':'' ?>>Faikham Boutique</option>
                                        </select>
                                        <label for="select2">เลือกโรงแรม</label>
                                    </div>
                                </div>

                                <hr>
                                <div class="col-md-4 mt-2 mb-2">
                                    <div class="form-floating">
                                        <input type="hidden" class="form-control" name="test_8_select_room" value="<?=($save_raw_value_8=='1') ? '1':'2' ?>">
                                        <select class="form-select" name="test_8_select_room_disabled" disabled>
                                            <option selected>ห้องพัก</option>
                                            <option value="normal" <?=($save_raw_value_8=='1') ? 'selected':'' ?>>ห้องพักขนาดปกติ</option>
                                            <option value="deluxe_room" <?=($save_raw_value_8=='2') ? 'selected':'' ?>>ห้องพักขนาดพิเศษ</option>
                                        </select>
                                        <label for="select2">เลือกห้องพัก</label>
                                    </div>
                                </div>

                                <div class="col-md-3 mt-2 mb-2">
                                    <div class="form-floating">
                                        <input type="hidden" class="form-control" name="test_9_select_room" value="<?=$save_raw_value_9 ?>">
                                        <select class="form-select" name="test_9_select_room_disabled" disabled>
                                            <option value="1" <?php echo $selected_5 ?>>1 ห้อง</option>
                                            <option value="2" <?php echo $selected_6 ?>>2 ห้อง</option>
                                            <option value="3" <?php echo $selected_7 ?>>3 ห้อง</option>
                                            <option value="4" <?php echo $selected_8 ?>>4 ห้อง</option>
                                            <option value="5" <?php echo $selected_9 ?>>5 ห้อง</option>
                                        </select>
                                        <label for="select2">จำนวนหัองพัก</label>
                                    </div>
                                </div>

                                
                                <!--div class="col-md-5 mt-2 mb-2">
                                    <button type="button" class="btn btn-primary w-100 py-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        รายละเอียดทั้งหมดของห้องพัก
                                    </button>
                                </div-->

                                <div class="col-md-5 mt-2 mb-2">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="promo_code" placeholder="ส่วนลด" name="promo_code" value="0" READONLY>
                                        <label for="promo_code">ส่วนลด (บาท)</label>
                                    </div>
                                </div>

                                <hr>

                                <div class="col-md-12 mt-2 mb-2">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" placeholder="เพิ่มเติม **ไม่สามารถเพิ่มเตียงนอนได้เนื่องจากขนาดของห้อง**" name="test_10_select_room" value="<?php echo $save_raw_value_10 ?>" READONLY>
                                        <label for="name">เพิ่มเติม **ไม่สามารถเพิ่มเตียงนอนได้เนื่องจากขนาดของห้อง**</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="button" class="btn btn-primary w-100 py-3" data-bs-toggle="modal" data-bs-target="#exampleModal_2">
                                        ชำระเงิน
                                    </button>
                                </div>
                            </div>

                            <div class="modal fade" id="exampleModal_2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">รายละเอียดทั้งหมดของห้องพัก</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="card">
                                                        <div class="card-body text-center">

                                                            <label for="form_name">เลือกธนาคาร</label>
                                                            <select class="form-select" id="dropDownId" name='bank_type' onchange="display()">
                                                                <option value="1" selected="selected">ธนาคารกสิกรไทย</option>
                                                                <option value="2">ธนาคารกรุงเทพ</option>
                                                            </select>

                                                            <div id="first">

                                                                <label for="Input_Hotel" class="form-label mt-2">ชื่อบัญชี</label>
                                                                <select id="Input_Hotel" class="form-select" name="kbank_select_name" value="" READONLY>
                                                                    <option value="kbank_name" selected>นางสาว สุพรรณิกา ซอเสียง</option>
                                                                </select>

                                                                <label for="Input_Hotel" class="form-label mt-2">เลขที่บัญชี</label>
                                                                <select id="Input_Hotel" class="form-select" name="kbank_select_number" value="" READONLY>
                                                                    <option value="kbank_number" selected>415-250-789</option>
                                                                </select>

                                                                <img src="img/qrcodes_show.php.png" class="card-img-top m-auto mt-4" alt="..." style="width: 125px; height:125px">

                                                            </div>

                                                            <div id="second" style="display: none;">

                                                                <label for="Input_Hotel" class="form-label mt-2">ชื่อบัญชี</label>
                                                                <select id="Input_Hotel" class="form-select" name="bkk_select_name" value="" READONLY>
                                                                    <option value="bkk_name" selected>นางสาว สุพรรณิกา ซอเสียง</option>
                                                                </select>

                                                                <label for="Input_Hotel" class="form-label mt-2">เลขที่บัญชี</label>
                                                                <select id="Input_Hotel" class="form-select" name="bkk_select_number" value="" READONLY>
                                                                    <option value="bkk_number" selected>987-546-213</option>
                                                                </select>

                                                                <img src="img/qrcodes_show.php.png" class="card-img-top m-auto mt-4" alt="..." style="width: 125px; height:125px">

                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="col m-auto">
                                                                <div class="text-center">
                                                                    <div class="mb-3">

                                                                        <label for="formFile" class="form-label">รูปภาพใบเสร็จ</label>
                                                                        <input class="form-control" type="file" name="image" id="blah" required>

                                                                        <div class="mt-2">
                                                                            <label for="birthday" class="form-label">เวลาที่โอนเงิน</label>
                                                                            <input type="datetime-local" class="form-control" id="birthday" name="check_time_transferee" step="any" value="<?php echo $todaypay_final ?>">
                                                                        </div>

                                                                        <div class="mt-2">
                                                                            <label for="Input_Text" class="form-label">ชื่อผู้โอน</label>
                                                                            <input type="" class="form-control" id="Input_Text" name="transferee_name" aria-describedby="" placeholder="ตัวอย่าง : นาย ธนาบดี อร่อยดี" required>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <div class="col-12">
                                                <button class="btn btn-primary w-100 py-3" type="submit" name="sumbit_to_server">ชำระเงิน</button>
                                            </div>
                                        </div>

                                    </div>
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


        <script>
            function display() {
                var e = document.getElementById("dropDownId");
                var index = e.selectedIndex;
                if (index == 0) {
                    document.getElementById("first").style.display = 'block'
                    document.getElementById("second").style.display = 'none'
                    document.getElementById("change_bank").value = '1'
                } else if (index == 1) {
                    document.getElementById("first").style.display = 'none'
                    document.getElementById("second").style.display = 'block'
                    document.getElementById("change_bank").value = '2'
                }
            }
        </script>

        <script>
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#blah')
                            .attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

        <script>
            function code_promo() {
                document.getElementById("show_total_monery_1").value = "Faikham Hotel";
                document.getElementById("Input_Text4_Sub").value = "faikham_hotel";
            }
        </script>

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

<?php 
    $promo;
    $qty_EmptyRoom = "SELECT promotion_code, promotion_value FROM `promotion_data`";
    $res_EmptyRoom = mysqli_query($conn, $qty_EmptyRoom);
    if (mysqli_num_rows($res_EmptyRoom) > 0) {
        while($row = mysqli_fetch_assoc($res_EmptyRoom)){
            $promo[$row['promotion_code']] = $row['promotion_value'];
        }
    }
?>

<script>
function validate(coupon) {
    var nf = new Intl.NumberFormat('en-US', {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
    });
    var PromoCode = document.getElementById('dc_code').value.trim().toUpperCase();
    var currPrice = '<?=$room_price?>';
    var day =  '<?=$save_amount_day?>';
    var room = '<?=$save_raw_value_9?>';
    var PromoArray = <?=json_encode($promo);?>;
    if(PromoArray[PromoCode] !== undefined) {
        var dc_Price = parseFloat(PromoArray[PromoCode]);
        document.getElementById('price_old').innerHTML = "(ราคาเดิม " + currPrice + " บาท)";
        document.getElementById('price_room').innerHTML = nf.format((currPrice-dc_Price).toFixed(2)) + " บาท";
        document.getElementById('promo_code').value = nf.format((dc_Price*day*room).toFixed(2));
        document.getElementById('price_dc').innerHTML = nf.format((dc_Price*day*room).toFixed(2)) + " บาท";
        document.getElementById('price_total').innerHTML = nf.format(((currPrice-dc_Price)*day*room).toFixed(2)) + " บาท";
        document.getElementById('messageUsedCode').innerHTML="<p class='mt-2 text-primary'> โค้ดถูกต้อง </p>";
    } else {
        document.getElementById('messageUsedCode').innerHTML="<p class='mt-2 text-danger'> โค้ดผิด </p>";
    }
}
</script>