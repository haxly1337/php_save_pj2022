<?php

require_once '../config/db.php';
include("../Template-backend/Header.php");


function DateThai($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
}

if (!isset($_SESSION['userid'])) {  
    header('location: logintoblackend.php');
} else {
    if (isset($_POST['addcuswalkin'])) {

        $code_member = $_SESSION['code_member'];
        $checkintime = $_POST['checkintime'];
        $checkouttime = $_POST['checkouttime'];
        $frist_name = $_POST['frist_name'];
        $last_name = $_POST['last_name'];
        $tel_cus = $_POST['tel_cus'];
        $email_cus = $_POST['email_cus'];
        $hotel_where = $_POST['hotel_where'];
        $room_type = $_POST['room_where'];
        $amount_room = $_POST['amount_room'];
        $cus_detail = $_POST['cus_detail'];
        $cus_code = $_POST['cus_code'];

        $ip_checkIn = $_POST['checkintime'];
        $ip_checkOut = $_POST['checkouttime'];
        $ip_FirstName = $_POST['frist_name'];
        $ip_LastName = $_POST['last_name'];
        $ip_Tel = $_POST['tel_cus'];
        $ip_Email = $_POST['email_cus'];
        $ip_Hotel = $_POST['hotel_where'];
        $ip_rType = $_POST['room_where'];
        $ip_rAmount = $_POST['amount_room'];
        $ip_Extra = $_POST['cus_detail'];
        $cus_code = $_POST['cus_code'];

        $total_all_price = 0;

        if($ip_Hotel == '1')
            $ip_Hotel = 'faikham_hotel';
        else 
            $ip_Hotel = 'faikham_boutique';

        if($ip_rType == '1')
            $ip_rType = 'normal';
        else 
            $ip_rType = 'deluxe_room';

        $format_to_fullname = $frist_name . " " . $last_name;

        $image_cus = $_FILES['image']['name'];
        $temp_image = $_FILES['image']['tmp_name'];
        $targetinto = "img/" . $image_cus;

        if (($_POST['hotel_where']) == "noselect") {
            $message_no = "กรุณาเลือกโรงเเรม";
            echo "<script>alert('$message_no'); window.location.href='addwalkin.php';</script>";
            exit;
        } else {

            //! GENERATOR ZONE //
            {
                $get_step_1 = "WKIN-"; // GT = Guest && WKIN = Walkin

                if (($_POST['hotel_where']) == "faikham_hotel") {
                    // if (($hotel_where) == "faikham_hotel") {
                    $save_step_1_5 = "FH-";
                } else if (($_POST['hotel_where']) == "faikham_boutique") {
                    $save_step_1_5 = "FB-";
                } else {
                    $save_step_1_5 = "ER-";
                }

                $get_step_2 = date('Ymd');

                if (($room_type) == "normal") {
                    $save_step_3 = "-N"; // ห้องปกติ
                } else if (($room_type) == "deluxe_room") {
                    $save_step_3 = "-DX"; // ห้องพิเศษ
                } else {
                    $save_step_3 = "-ERORR";
                }

                $get_step_final = "$get_step_1" . "$save_step_1_5" . "$get_step_2" . "$save_step_3";

                // CHECK_ID //
                {
                    $check_id = "SELECT * FROM customer_data ORDER BY id DESC LIMIT 1";
                    $check_result = mysqli_query($conn, $check_id);

                    if (mysqli_num_rows($check_result) > 0) {
                        if ($row = mysqli_fetch_assoc($check_result)) { {

                                $book_id = $row['id'];
                                $get_number = str_replace("", "", $book_id);
                                $id_inc = $get_number + 1;
                                $get_string = str_pad($id_inc, 5, 0, STR_PAD_LEFT);
                                $book_id_real =  $get_step_final . $get_string;
                            }
                        }
                    }
                }
                // END CHECK_ID //

            }
            //! END GENERATOR ZONE //

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
    
                    //`room_data`
                    //stats = 0     ว่าง
                    //stats = 1     ยืนยันแล้ว เข้่าพักได้
                    //stats = 2     จอง
                    foreach ($randRoom as $value) {
                        $qty_Update = "UPDATE `room_data` SET `status`='1' WHERE room_id = '$value' AND hotel_where='$ip_Hotel' AND room_type='$ip_rType'";
                        $res_Update = mysqli_query($conn, $qty_Update);
    
                        //room_day = room_id
                        //`list_order_booking`
                        //User_id -999 / status_booking -1 = Walkin
                        //<!-- -999 Unsuccess / 1 Confirm / 2 Wait Confirm / 777 Checkout -->
                        $qty_InsertList = "INSERT INTO `list_order_booking`
                        (`book_id`, `hotel_where`, `room_type`, `checkintime`, `checkouttime`, `user_id`, `cus_name`, `room_day`, `total_price`, `status_booking`, `slip_img`, `receipt_who`, `receipt_time`, `receipt_no`, `status_receipt`, `bank_type`, `room_day_total`,`code_member`, `room_status`) 
                        VALUES ('$book_id_real','$ip_Hotel','$ip_rType','$ip_checkIn','$ip_checkOut','-999','$ip_FirstName $ip_LastName','$value','$total_all_price','-1','note_bank_k_2.jpg','','','','','','$ip_rAmount','$cus_code','1')";
                        $res_InsertList = mysqli_query($conn, $qty_InsertList);
                        move_uploaded_file($temp_slip_img, $targetinto);
                    }
                }
    
                echo "<script> window.location.href='3_finish_room.php'; </script>";
            }

            /*$query = "INSERT INTO `customer_data` (`id`, 
            `book_id`,
            `code_member`,
            `checkintime`,
            `checkouttime`,
            `cus_name`,
            `tel_cus`,
            `email_cus`,
            `hotel_where`,
            `room_type`,
            `amount_room`,
            `cus_detail`,
            `image_cus`,
            `promotion_code`) 
            VALUES (NULL, 
            '$book_id_real',
            '$code_member',
            '$checkintime',
            '$checkouttime',
            '$format_to_fullname',
            '$tel_cus',
            '$email_cus',
            '$hotel_where',
            '$room_type',
            '$amount_room',
            '$cus_detail',
            '$image_cus',
            '$cus_code');";*/

            // $query = "INSERT INTO customer_data (code_member,checkintime,checkouttime,frist_name,last_name,tel_cus,email_cus,hotel_where,room_where,amount_room,cus_detail,image_cus)
            // VALUE ('$code_member','$checkintime','$checkouttime','$frist_name','$last_name','$tel_cus','$email_cus','$hotel_where','$room_where','$amount_room','$cus_detail','$image_cus')";




            $result = mysqli_query($conn, $query);
            move_uploaded_file($temp_image, $targetinto);

            if ($result) {
                $_SESSION['success'] = "เพิ่มข้อมูลเสร็จสิ้น";
                $message_nointo = "เพิ่มข้อมูลเสร็จสิ้น";
                echo "<script>alert('$message_nointo'); window.location.href='addwalkin.php';</script>";
            } else {
                $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                $message_nointo = "มีบางอย่างผิดพลาด";
                echo "<script>alert('$message_nointo'); window.location.href='addwalkin.php';</script>";
            }
        }
    }
}

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> การจัดการโปรโมชั่น </title>

    <!-- DataTable -->
    <link rel="stylesheet" href=https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css>
    <link rel="stylesheet" href="assets/css/lineicons.css" />
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.css" />
    <!-- DataTable -->

</head>

<body>
    <!-- ========== section start ========== -->
    <section class="section">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title mb-30">
                            <h2>จัดการการจองห้องพักลูกค้าวอล์คอิน</h2>
                        </div>
                    </div>
                    <div class="container">
                        <?php
                        include('../addwalkin.php')
                        ?>
                    </div>
                    <script>
                        function click_to_show() {
                            document.getElementById("input_show_select_where").value = "faikham_hotel";
                        }
                    </script>

                    <script>
                        function click_to_show_2() {
                            document.getElementById("input_show_select_where").value = "faikham_boutique";
                        }
                    </script>

                    <script src="http://code.jquery.com/jquery-latest.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

                    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
                    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

                    <script>
                        $(document).ready(function() {
                            $('#example').DataTable();
                        });
                    </script>

                    <script type="text/javascript">
                        // เพิ่มส่วนนี้เข้าไปจะถือว่าเป็นการตั้งค่าให้ Datatable เป็น Default ใหม่เลย
                        $.extend(true, $.fn.dataTable.defaults, {
                            "language": {
                                "sProcessing": "กำลังดำเนินการ...",
                                "sLengthMenu": "แสดง _MENU_  แถว",
                                "sZeroRecords": "ไม่พบข้อมูล",
                                "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                                "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
                                "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
                                "sInfoPostFix": "",
                                "sSearch": "ค้นหา:",
                                "sUrl": "",
                                "oPaginate": {
                                    "sFirst": "เริ่มต้น",
                                    "sPrevious": "ก่อนหน้า",
                                    "sNext": "ถัดไป",
                                    "sLast": "สุดท้าย"
                                }
                            }
                        });

                        // เรียกใช้งาน Datatable function

                        $('#dataTable').DataTable();
                    </script>

                    <!-- End Script-->

</body>

</html>