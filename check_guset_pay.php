<?php
require_once 'config/db.php';

session_start();

//* TIME_SET //
date_default_timezone_set('Asia/Bangkok');
$todaypay = date('Y-m-d H:i:s');
$todaypay_format = date("Y-m-d H:i:s", strtotime($todaypay));
//* END TIME_SET  //

//! FAKE_INFO //

//! END FAKE_INFO //

$checkintime_guest = $_SESSION['checkintime_guest'];
$checkouttime_guset = $_SESSION['checkouttime_guset'];
$frist_name_guest = $_SESSION['frist_name_guest'];
$last_name_guset = $_SESSION['last_name_guset'];
$tel_cus_guest = $_SESSION['tel_cus_guest'];
$email_cus_guest = $_SESSION['email_cus_guest'];
$hotel_where = $_SESSION['hotel_where'];
$room_where =  $_SESSION['room_where'];
$amount_room = $_SESSION['amount_room'];
$cus_detail = $_SESSION['cus_detail'];

$format_to_fullname = $frist_name_guest . " " . $last_name_guset;

$date_format1 = date("d-m-Y", strtotime($checkintime_guest));
$date_format2 = date("d-m-Y", strtotime($checkouttime_guset));

$savedate_pay_1 = $date_format1;
$savedate_pay_2 = $date_format2;

$a = new \DateTime($checkintime_guest);
$b = new \DateTime($checkouttime_guset);

$save_amount_day = $a->diff($b)->days;

if (($hotel_where) == "faikham_boutique") {

    $hotel_format_name = "Faikham Boutique";
} else {

    $hotel_format_name = "Faikham Hotel";
}

if (($room_where) == "normal") {
    $room_format_name = "ห้องธรรมดา";
    $price_room = 790;
} else if (($room_where) == "deluxe_room") {
    $room_format_name = "ห้องใหญ่";
    $price_room = 990;
}

$totat_rate = ($price_room * $save_amount_day) * $amount_room;
$total_monery = number_format($totat_rate, 2);

if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['before_pay_send_real'])) {
    
    require_once 'config/db.php';

    $check_id = "SELECT * FROM list_order_booking ORDER BY id DESC LIMIT 1";
    $check_result = mysqli_query($conn, $check_id);

    if (mysqli_num_rows($check_result) > 0) {

        if ($row = mysqli_fetch_assoc($check_result)) { {

                //! DATA ZONE //
                {
                    $save_transferee_name = $_POST['transferee_name'];
                    $slip_img = $_FILES['image']['name'];
                    $temp_slip_img = $_FILES['image']['tmp_name'];
                    $targetinto = "img/Slip/" . $slip_img;
                    $test_pull = "2022-07-13";

                    $change_bank = $_POST['change_bank'];

                    $checkintime_guest_send = $_POST['checkintime_guest_send'];
                    $checkouttime_guset_send = $_POST['checkouttime_guset_send'];
                    $format_to_fullname_send = $_POST['format_to_fullname_send'];
                    $amount_room_send = $_POST['amount_room_send'];
                    $total_monery_send = $_POST['total_monery_send'];
                    $save_amount_day_send = $_POST['save_amount_day_send'];
                    $hotel_where_send = $_POST['hotel_where_send'];
                    $room_where_send = $_POST['room_where_send'];
                    $cus_detail_send = $_POST['cus_detail_send'];
                    $cus_email = $_POST['cus_email'];
                    $cus_tel = $_POST['cus_tel'];

                    $check_time_transferee = $_POST['check_time_transferee'];
                    $save_time_transferee_change = date("Y-m-d H:i:s", strtotime($check_time_transferee));
                }
                //! END DATA ZONE //

                //! GENERATOR ZONE //
                {
                    $get_step_1 = "GT-"; // GT = Guest
                    $get_step_2 = date('Ymd'); {
                        if (($room_where_send) == "normal") {
                            $save_step_3 = "-N"; // ห้องปกติ
                            $gen_num = "";
                        } else if (($room_where_send) == "deluxe_room") {
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
                }

                //! END GENERATOR ZONE //


                //! FORMAT TEXT AND SHOW //
                {
                    if (($room_where_send) == "normal") {
                        $room_format_name = "ห้องธรรมดา";
                    } else if (($room_where_send) == "deluxe_room") {
                        $room_format_name = "ห้องใหญ่";
                    }

                    if (($hotel_where_send) == "faikham_boutique") {
                        $hotel_format_name = "Faikham Boutique";
                    } else {
                        $hotel_format_name = "Faikham Hotel";
                    }
                }
                //! END FORMAT TEXT AND SHOW //

            }
            //! INSERT ZONE //
            {
                $row_update_room_amount_1 = $amount_room_send;

                $srm_conn = "SELECT * FROM `room_data` WHERE `hotel_where` = '$hotel_where_send' AND `room_type` = '$room_where_send'";
                $srm_run = mysqli_query($conn, $srm_conn);
                $srm_row = mysqli_fetch_assoc($srm_run);

                $rmax = '25';

                $room_amount_cus = $srm_row['room_amount'];

                $room_amount_cus_final = $room_amount_cus + $row_update_room_amount_1;
                $srm_er_total = $rmax - $room_amount_cus;

                if (($srm_er_total) == '0') {

                    $message_nointo = "โรงเเรม " . $hotel_format_name . " ห้องจองเต็มเเล้ว";
                    echo "<script>alert('$message_nointo'); window.location.href='booknow_guest.php';</script>";
                } else {

                    if (($room_amount_cus_final) > $rmax) {
                        $message_nointo = "โรงเเรม " . $hotel_format_name . " " . $room_format_name . " เหลือจำนวนที่ว่าง " . $srm_er_total . " ห้อง ไม่พอกรุณาเลือกจำนวนห้องใหม่";
                        echo "<script>alert('$message_nointo'); window.location.href='booknow_guest.php';</script>";
                    } else {
                        $query_update = "UPDATE room_data SET   
                        room_amount = '$room_amount_cus_final'
                        WHERE `room_data`.`hotel_where` = '$hotel_where_send' AND `room_type` = '$room_where_send'";

                        $query_update_run = mysqli_query($conn, $query_update);

                        $query_insert_data = "INSERT INTO `list_order_booking` (`id`,
                        `book_id`, 
                        `hotel_where` ,
                        `room_type` ,
                        `checkintime`,
                        `checkouttime`,
                        `cus_name`,
                        `room_day`,
                        `total_price`,
                        `status_booking`,
                        `slip_img`,
                        `receipt_who`,
                        `receipt_time`,
                        `receipt_no`,
                        `status_receipt`,
                        `bank_type`,
                        `room_day_total`)
                        VALUES (NULL, 
                        '$book_id_real',  
                        '$hotel_where_send',
                        '$room_where_send',
                        '$checkintime_guest_send',
                        '$checkouttime_guset_send',
                        '$format_to_fullname_send',
                        '$amount_room_send',
                        '$total_monery_send',
                        '0',
                        '$slip_img',
                        '$save_transferee_name',
                        '$save_time_transferee_change',
                        '$bill_id_final_gen',
                        '$test_pull',
                        '$change_bank',
                        '$save_amount_day_send');";

                        $result_insert = mysqli_query($conn, $query_insert_data);

                        move_uploaded_file($temp_slip_img, $targetinto);

                        //check room booking where
                        $ht_room;
                        if($hotel_where_send == "faikham_boutique")
                            $prefix = "fb_";
                        else 
                            $prefix = "fh_";

                        if (($room_where_send) == "normal") {
                            $rand_room = rand(1,2).str_pad(rand(1,20), 2, "0", STR_PAD_LEFT);
                        } else 
                            $rand_room = "3".str_pad(rand(1,20), 2, "0", STR_PAD_LEFT);

                        $qty_cRoom = "SELECT concat(IF(hotel_where='faikham_boutique','fb_','fh_'),room_where) as hotel_room_where FROM `room_booking` ORDER BY room_where ASC";
                        $res_cRoom = mysqli_query($conn, $qty_cRoom);
                        if (mysqli_num_rows($res_cRoom) > 0) {
                            while($row = mysqli_fetch_assoc($res_cRoom)) {
                                $ht_room[] = $row['hotel_room_where'];
                            }
                        }

                        while (in_array($prefix.$rand_room, $ht_room)) {
                            if (($room_where_send) == "normal") {
                                $rand_room = rand(1,2).str_pad(rand(1,20), 2, "0", STR_PAD_LEFT);
                            } else 
                                $rand_room = "3".str_pad(rand(1,20), 2, "0", STR_PAD_LEFT);
                        }
                        
                        $qty_insert = "INSERT INTO `room_booking` (`id`, `room_where`, `hotel_where`, `book_id`) VALUES (NULL, '$rand_room', '$hotel_where_send', '$book_id_real');";
                        $res_insert = mysqli_query($conn, $qty_insert);
                    }
                }

                if ($result_insert) {

                    $_SESSION['success'] = "เพิ่มข้อมูลเสร็จสิ้น";

                    $_SESSION['book_id_real'] = $book_id_real;
                    $_SESSION['checkintime_guest_send'] = $checkintime_guest_send;
                    $_SESSION['checkouttime_guset_send'] = $checkouttime_guset_send;
                    $_SESSION['fullname_send'] = $format_to_fullname_send;
                    $_SESSION['amount_room_send'] = $amount_room_send;
                    $_SESSION['total_monery_send'] = $total_monery_send;
                    $_SESSION['save_amount_day_send'] = $save_amount_day_send;
                    $_SESSION['hotel_where_send'] = $hotel_where_send;
                    $_SESSION['room_where_send'] = $room_where_send;
                    $_SESSION['cus_detail_send'] = $cus_detail_send;
                    $_SESSION['cus_email'] = $cus_email;
                    $_SESSION['cus_tel'] = $cus_tel;

                    $_SESSION['change_bank'] = $change_bank;

                    $_SESSION['save_time_transferee_change'] = $save_time_transferee_change;

                    $message_nointo = "เพิ่มข้อมูลเสร็จสิ้น";
                    echo "<script>alert('$message_nointo'); window.location.href='show_receipt.php';</script>";
                } else {
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    $message_nointo = "มีบางอย่างผิดพลาด";
                    echo "<script>alert('$message_nointo'); window.location.href='index.php';</script>";
                }
                //! END INSERT ZONE //
            }
        } else {
            echo "mysqli_fetch_assoc is error";
        }
    } else {
        echo "mysqli_num_rows is error";
    }
}

//? END REAL_INFO //



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ชำระเงิน</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="css/cssmain.css">

</head>

<body>

    <div class="container">
        <div class="m-auto w-80 mt-3 mb-3">
            <div class="col-12">

                <div class="card mt-3 mb-3">
                    <div class="card-body text-center">

                        <div class="row">

                            <div class="col p-1">
                                <p class="mb-1 text-center" style="font-size: 22px;">หน้าต่างการชำระเงิน</p>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="card mt-3 mb-3">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">รูปภาพ</th>
                                    <th scope="col">วันที่เข้า</th>
                                    <th scope="col">วันที่ออก</th>
                                    <th scope="col">ชื่อผู้เข้าพัก</th>
                                    <th scope="col">จำนวนวัน</th>
                                    <th scope="col">จำนวนห้อง</th>
                                    <th scope="col">ดูรายละเอียดเพิ่มเติม</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <div class="card" style="width: 10rem;">
                                            <img src="img/room_normal.png" class="card-img-top" alt="...">
                                        </div>
                                    </th>
                                    <td>
                                        <?php
                                        echo $savedate_pay_1;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $savedate_pay_2;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $frist_name_guest . " " . $last_name_guset;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $save_amount_day . " วัน";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $amount_room . " ห้อง";
                                        ?>
                                    </td>
                                    <td>

                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            เเสดงรายละเอียดการจอง
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">รายละเอียดการจอง</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body m-auto">

                                                        <div class="card" style="width: 25rem;">
                                                            <img src="img/room_normal.png" class="card-img-top" alt="...">
                                                            <div class="card-body">
                                                                <h5 class="card-title"><?php echo "" . $room_format_name . "" ?></h5>
                                                                <p class="card-text mt-2">วันที่เข้าพัก : <?php echo "" . $checkintime_guest . "" ?></p>
                                                                <p class="card-text mt-1">วันที่ออกจากพัก : <?php echo "" . $checkouttime_guset . "" ?></p>
                                                                <p class="card-text mt-1">ชื่อของผู้จอง : <?php echo "" . $frist_name_guest . " " . $last_name_guset ?></p>
                                                                <p class="card-text mt-1">เบอร์มือถือ : <?php echo "" . $tel_cus_guest . "" ?></p>
                                                                <p class="card-text mt-1">อีเมลของผู้ใช้ : <?php echo "" . $email_cus_guest . "" ?></p>
                                                                <p class="card-text mt-1">โรงเเรม : <?php echo "" . $hotel_format_name . "" ?></p>
                                                                <p class="card-text mt-1">เพิ่มเติม : <?php echo "" . $cus_detail . "" ?></p>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col">
                                    <div class="card mt-3 m-auto" style="width: 22rem;">
                                        <div class="card-body text-center">

                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

                                                <label for="form_name">เลือกธนาคาร</label>
                                                <select class="form-select" id="dropDownId" onchange="display()">
                                                    <option value="1" selected="selected">ธนาคารกสิกรไทย</option>
                                                    <option value="2">ธนาคารกรุงเทพ</option>
                                                </select>

                                                <div id="first">

                                                    <label for="Input_Hotel" class="form-label mt-2">ชื่อบัญชี</label>
                                                    <select id="Input_Hotel" class="form-select" name="kbank_select_name" value="" disabled>
                                                        <option value="kbank_name" selected>นาย ไก่สีเเดง ใหญ่ทรงดี</option>
                                                    </select>

                                                    <label for="Input_Hotel" class="form-label mt-2">เลขที่บัญชี</label>
                                                    <select id="Input_Hotel" class="form-select" name="kbank_select_number" value="" disabled>
                                                        <option value="kbank_number" selected>123-456-789</option>
                                                    </select>

                                                    <img src="img/qrcodes_show.php.png" class="card-img-top m-auto mt-4" alt="..." style="width: 125px; height:125px">

                                                </div>

                                                <div id="second" style="display: none;">

                                                    <label for="Input_Hotel" class="form-label mt-2">ชื่อบัญชี</label>
                                                    <select id="Input_Hotel" class="form-select" name="bkk_select_name" value="" disabled>
                                                        <option value="bkk_name" selected>นางสาว อร่อย สีอันจะเจริญ</option>
                                                    </select>

                                                    <label for="Input_Hotel" class="form-label mt-2">เลขที่บัญชี</label>
                                                    <select id="Input_Hotel" class="form-select" name="bkk_select_number" value="" disabled>
                                                        <option value="bkk_number" selected>987-546-213</option>
                                                    </select>

                                                    <img src="img/qrcodes_show.php.png" class="card-img-top m-auto mt-4" alt="..." style="width: 125px; height:125px">

                                                </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card mt-3" style="width: 30rem;">
                                        <div class="card-body">
                                            <div class="col m-auto">
                                                <div class="text-center">
                                                    <div id="preview" class="mt-3 mb-3"></div>
                                                    <div class="mb-3">

                                                        <label for="formFile" class="form-label">รูปภาพใบเสร็จ</label>
                                                        <input class="form-control" type="file" name="image" id="image" required>

                                                        <div class="mt-2">
                                                            <label for="birthday" class="form-label">เวลาที่โอนเงิน</label>
                                                            <input type="datetime-local" class="form-control" id="birthday" name="check_time_transferee" step="any" value="<?php echo $todaypay ?>">
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

                                <div class="col">

                                    <div class="card mt-3 m-auto" style="width: 18rem; float: right;">
                                        <div class="card-header" style="text-align: right;">
                                            โค้ดส่วนลด
                                        </div>
                                        <div class="card-body" style="text-align: right;">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="" class="form-control" id="Input_Text" name="code_promo" placeholder="x1x35">
                                                </div>
                                                <div class="col-4">
                                                    <button onclick="" class="btn btn-success" name="">ใช้งาน</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card mt-3 m-auto" style="width: 18rem; float: right;">
                                        <div class="card-header" style="text-align: right;">
                                            ยอดรวมทั้งหมด
                                        </div>
                                        <div class="card-body" style="text-align: right;">
                                            <p class="card-title"> ราคาห้อง <?php echo $price_room ?> x <?php echo $save_amount_day ?> วันที่พัก x <?php echo $amount_room ?> ห้อง </p>
                                            <p class="card-title"> ส่วนลด 0 บาท </p>
                                            <h5 class="card-title" id="show_total_monery_1"><?php echo $total_monery . " บาท"; ?></h5>
                                        </div>
                                    </div>

                                    <div class="card mt-3 m-auto" style="width: 18rem; float: right;">
                                        <div class="card-header" style="text-align: right;">
                                            ราคารวมทั้งสิ้นเป็นจำนวนเงิน
                                        </div>
                                        <div class="card-body" style="text-align: right;">
                                            <h5 class="card-title" id="show_total_monery_2" style="color:green"><?php echo $total_monery . " บาท"; ?></h5>
                                        </div>
                                    </div>

                                    <div class="" style="text-align: right;">
                                        <a href="index.html" class="btn btn-danger mt-4">กลับไปหน้าเเรก</a>
                                        <button type="submit" class="btn btn-success mt-4 px-3" type="submit" name="before_pay_send_real" onclick="return confirm('คุณต้องการที่จะจองห้องพักใช่ใหม ?')">จองห้องพัก</button>
                                    </div>

                                    <div class="hide">
                                        <input type="hidden" class="form-control" id="Input_Text" name="checkintime_guest_send" value="<?php echo $checkintime_guest ?>">
                                        <input type="hidden" class="form-control" id="Input_Text" name="checkouttime_guset_send" value="<?php echo $checkouttime_guset ?>">
                                        <input type="hidden" class="form-control" id="Input_Text" name="format_to_fullname_send" value="<?php echo $format_to_fullname ?>">
                                        <input type="hidden" class="form-control" id="Input_Text" name="amount_room_send" value="<?php echo $amount_room ?>">
                                        <input type="hidden" class="form-control" id="Input_Text" name="total_monery_send" value="<?php echo $total_monery  ?>">
                                        <input type="hidden" class="form-control" id="Input_Text" name="save_amount_day_send" value="<?php echo $save_amount_day  ?>">
                                        <input type="hidden" class="form-control" id="Input_Text" name="hotel_where_send" value="<?php echo $hotel_where ?>">
                                        <input type="hidden" class="form-control" id="Input_Text" name="room_where_send" value="<?php echo $room_where ?>">
                                        <input type="hidden" class="form-control" id="Input_Text" name="cus_detail_send" value="<?php echo $cus_detail ?>">
                                        <input type="hidden" class="form-control" id="Input_Text" name="cus_email" value="<?php echo $email_cus_guest ?>">
                                        <input type="hidden" class="form-control" id="Input_Text" name="cus_tel" value="<?php echo $tel_cus_guest ?>">
                                        <input type="hidden" class="form-control" id="change_bank" name="change_bank" value="1">
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


    <!-- ? ---------------------------------- End Script ---------------------------------- -->

    <script src="http://code.jquery.com/jquery-latest.js"></script>

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
        function imagePreview(fileInput) {
            if (fileInput.files && fileInput.files[0]) {
                var fileReader = new FileReader();
                fileReader.onload = function(event) {
                    $('#preview').html('<img src="' + event.target.result + '" width="250" height="250"/>');
                };
                fileReader.readAsDataURL(fileInput.files[0]);
            }
        }
        $("#image").change(function() {
            imagePreview(this);
        });
    </script>

    <script>
        function code_promo() {
            document.getElementById("show_total_monery_1").value = "Faikham Hotel";
            document.getElementById("Input_Text4_Sub").value = "faikham_hotel";
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <!-- ? ---------------------------------- End Script ---------------------------------- -->

</body>

</html>