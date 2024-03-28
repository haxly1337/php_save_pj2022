<?php
//! CONN //

session_start(); {
    require_once "config/db.php";
}
//* END CONN //

//! ROW 1 //
{
    $query_list = "SELECT * FROM `list_order_booking`";
    $query_run = mysqli_query($conn, $query_list);
    $row = mysqli_fetch_assoc($query_run);
}
//! END ROW 1 //

//! HIDDEN SELECTER //

//! END HIDDEN SELECTER //

if (isset($_POST['check_status_pay'])) {

    $save_book_id = $_POST['save_book_id'];

    $book_id_real = $_POST['insert_comm_1'];
    $code_member = $_POST['insert_comm_2'];
    $checkintime = $_POST['insert_comm_3'];
    $checkouttime = $_POST['insert_comm_4'];
    $cus_name = $_POST['insert_comm_5'];
    $tel_cus = '0';
    $email_cus = '0';
    $hotel_where = $_POST['insert_comm_8'];
    $room_type = $_POST['insert_comm_9'];
    $amount_room = $_POST['insert_comm_10'];
    $cus_detail = '';
    $image_cus = $_POST['insert_comm_12'];
    $promotion_code = '';

    $query_insert_data = "INSERT INTO `customer_data` (`id`,
        `book_id` ,
        `code_member` ,
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
        '$cus_name',
        '$tel_cus',
        '$email_cus',
        '$hotel_where',
        '$room_type',
        '$amount_room',
        '$cus_detail',
        '$image_cus',
        '$promotion_code');";

    $result_insert = mysqli_query($conn, $query_insert_data);

    if ($result_insert) {

        $query_update =  "UPDATE `list_order_booking` SET `status_booking` = '1' WHERE `list_order_booking`.`id` = $save_book_id;";
        $query_update_run = mysqli_query($conn, $query_update);

        $_SESSION['success'] = "ทำการยันยืนการชำระเงินเสร็จสิ้น";
        $message_nointo =  $_SESSION['success'];
        echo "<script>alert('$message_nointo'); window.location.href='list_book_owner.php';</script>";
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลางบางอย่าง";
        $message_nointo = $_SESSION['error'];
        echo "<script>alert('$message_nointo'); window.location.href='list_book_owner.php';</script>";
    }
}

if (isset($_POST['cancel_booking'])) {

    $main_id = $_POST['insert_comm_0'];
    $hotel_where = $_POST['insert_comm_8'];
    $room_type = $_POST['insert_comm_9'];
    $amount_room = $_POST['insert_comm_10'];

    $row_update_room_amount_1 = $amount_room;

    $srm_conn = "SELECT * FROM `room_data` WHERE `hotel_where` = '$hotel_where' AND `room_type` = '$room_type'";
    $srm_run = mysqli_query($conn, $srm_conn);
    $srm_row = mysqli_fetch_assoc($srm_run);

    $room_amount_cus = $srm_row['room_amount'];

    $room_amount_cus_final = $room_amount_cus - $row_update_room_amount_1;

    $query_update = "UPDATE room_data SET   
    room_amount = '$room_amount_cus_final'
    WHERE `room_data`.`hotel_where` = '$hotel_where' AND `room_type` = '$room_type'";

    $query_update_run = mysqli_query($conn, $query_update);

    if ($query_update_run) {

        $query = "DELETE FROM list_order_booking WHERE id = $main_id";
        $result_table = mysqli_query($conn, $query);

        $_SESSION['success'] = "ทำการยกเลิกเสร็จสิ้น";
        $message_nointo =  $_SESSION['success'];
        echo "<script>alert('$message_nointo'); window.location.href='list_book_owner.php';</script>";
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลางบางอย่าง";
        $message_nointo = $_SESSION['error'];
        echo "<script>alert('$message_nointo'); window.location.href='list_book_owner.php';</script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการจองห้องพัก</title>

    <link rel="stylesheet" href="assets/css/main.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css>
    <link rel="stylesheet" href=https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css>

    <link rel="stylesheet" href="assets/css/lineicons.css" />
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.css" />

    <style>
        body {
            background-color: #f0efb3;
            height: auto;
            width: auto;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            margin-top: 20px;
        }
    </style>



</head>

<body>

    <div class="col-lg m-auto" style="width: 1250px;">
        <div class="card">
            <div class="card-body">
                <div class="col-lg text-center">
                    <h4>รายการจองห้องพัก</h4>
                </div>
                <div class="mt-2">
                    <form name="frmSearch" method="get" action="">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="birthdaytime" class="form-label">วันที่เข้าพัก</label>
                                <input type="date" class="form-control" id="birthdaytime" name="dateFirst">
                            </div>
                            <div class="col-md-6">
                                <label for="birthdaytime2" class="form-label">วันที่ออก</label>
                                <input type="date" class="form-control" id="birthdaytime2" name="dateSecond">
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-success mt-3" name="search">ค้นหา</button>
                                </div>
                                <div class="col">
                                    <a class="btn btn-primary mt-3" href="index_backend_owner.php" style="float: right;" role="button">กลับหน้าหลัก</a>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>

                <div class="table-responsive mt-3">
                    <table id="example" class="table table-striped" style="width:100%">

                        <thead>
                            <tr>
                                <th scope="col">รหัสจอง</th>
                                <th scope="col">เช็คอิน</th>
                                <th scope="col">เช็คเอาท์</th>
                                <th scope="col">ชื่อผู้จอง</th>
                                <th scope="col">จำห้องที่จอง</th>
                                <th scope="col">ยอดทั้งหมด</th>
                                <th scope="col">สถานะ</th>
                                <th scope="col" class="text-center">เเสดงข้อมูล</th>
                                <th scope="col" class="text-center">ยืนยันข้อมูล</th>
                                <th scope="col" class="text-center">ยกเลิกการจอง</th>
                                <th scope="col" class="text-center">ลบข้อมูล</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            if (isset($_GET['dateFirst']) && isset($_GET['dateSecond'])) { {
                                    $from_date = $_GET['dateFirst'];
                                    $to_date = $_GET['dateSecond'];
                                    $query_hotel = "SELECT * FROM list_order_booking WHERE (checkintime BETWEEN '$from_date' AND '$to_date')";
                                    $query_run_hotel = mysqli_query($conn, $query_hotel);
                                }

                                if (mysqli_num_rows($query_run_hotel) > 0) {
                                    foreach ($query_run_hotel as $row) { ?>

                                        <tr>
                                            <td>
                                                <?php
                                                $save_main_id = $row['id'];
                                                $save_book_id =  $row['book_id'];
                                                echo  $save_book_id;
                                                ?>
                                            </td>
                                            <td> <?= $row['checkintime'] ?> </td>
                                            <td> <?= $row['checkouttime'] ?> </td>
                                            <td> <?= $row['cus_name'] ?> </td>
                                            <td> <?= $row['room_day'] ?> </td>
                                            <td> <?= $row['total_price'] ?> </td>
                                            <td>
                                                <?php
                                                if (($row['status_booking']) == "0") {
                                                    $save_status = "ยังไม่ได้ยืนยัน";
                                                    $set_input_to_dis = "";
                                                    echo "$save_status";
                                                } else {
                                                    $save_status = "ชำระเงินเเล้ว";
                                                    $set_input_to_dis = "disabled";
                                                    echo "$save_status";
                                                }
                                                ?>
                                            </td>

                                            <td class="text-center" style="width: 80px;">
                                                <form action="list_book_show_img_owner.php" method="POST" enctype="multipart/form-data">
                                                    <div class="hide">

                                                        <input type="hidden" class="form-control" id="Input_Text" name="raw_img_time" value="<?= $row['receipt_time'] ?>">
                                                        <input type="hidden" class="form-control" id="Input_Text" name="raw_img_no" value="<?= $row['receipt_no'] ?>">
                                                        <input type="hidden" class="form-control" id="Input_Text" name="raw_img_who" value="<?= $row['receipt_who'] ?>">
                                                        <input type="hidden" class="form-control" id="Input_Text" name="raw_img" value="<?= $row['slip_img'] ?>">
                                                        <input type="hidden" class="form-control" id="Input_Text" name="raw_bank_type" value="<?= $row['bank_type'] ?>">
                                                        <input type="hidden" class="form-control" id="Input_Text" name="raw_status_booking" value="<?= $row['status_booking'] ?>">
                                                        <input type="hidden" class="form-control" id="Input_Text" name="raw_cusname" value="<?= $row['cus_name'] ?>">
                                                        <input type="hidden" class="form-control" id="Input_Text" name="raw_total_price" value="<?= $row['total_price'] ?>">
                                                        <input type="hidden" class="form-control" id="Input_Text" name="raw_room_day_total" value="<?= $row['room_day_total'] ?>">
                                                        <input type="hidden" class="form-control" id="Input_Text" name="raw_room_type" value="<?= $row['room_type'] ?>">

                                                    </div>
                                                    <button type="submit" class="btn btn-primary" type="submit" name="show_new_page_img"><i class="lni lni-support"></i></button>
                                                </form>

                                            </td>

                                            </td>

                                            <td class="text-center" style="width: 80px;">
                                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" class="form-control" id="Input_Text" name="save_book_id" value="<?php echo $save_main_id ?>">

                                                    <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_1" value="<?php echo $row['book_id'] ?>">
                                                    <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_2" value="<?php echo $_SESSION['code_member'] ?>">
                                                    <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_3" value="<?php echo $row['checkintime'] ?>">
                                                    <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_4" value="<?php echo $row['checkouttime'] ?>">
                                                    <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_5" value="<?php echo $row['cus_name'] ?>">
                                                    <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_6" value="">
                                                    <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_7" value="">
                                                    <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_8" value="<?php echo $row['hotel_where'] ?>">
                                                    <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_9" value="<?php echo $row['room_type'] ?>">
                                                    <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_10" value="<?php echo $row['room_day_total'] ?>">
                                                    <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_11" value="">
                                                    <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_12" value="<?php echo $row['slip_img'] ?>">

                                                    <button type="submit" class="btn btn-success" type="submit" name="check_status_pay" onclick="return confirm('คุณต้องการยืนยันการชำระเงินใช่ใหม ?')" <?php echo $set_input_to_dis ?>><i class="lni lni-save"></i></button>
                                                </form>
                                            </td>

                                            <td class="text-center" style="width: 80px;">
                                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

                                                    <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_8" value="<?php echo $row['hotel_where'] ?>">
                                                    <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_9" value="<?php echo $row['room_type'] ?>">
                                                    <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_10" value="<?php echo $row['room_day'] ?>">

                                                    <button type="submit" class="btn btn-warning" type="submit" name="cancel_booking" onclick="return confirm('คุณต้องการยกเลิกการจองใช่ใหม ?')" <?php echo $set_input_to_dis ?>><i class="lni lni-cut"></i></i></button>
                                                </form>
                                            </td>

                                            <td class="text-center" style="width: 80px;">
                                                <a href="list_book_del_owner.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบการยกเลิกจองใช่ใหม ?')"><i class="lni lni-trash-can"></i></a>
                                            </td>

                                        </tr>
                                    <?php
                                    }
                                }
                            } else {

                                $query_hotel = "SELECT * FROM `list_order_booking`";
                                $query_run_hotel = mysqli_query($conn, $query_hotel);

                                while ($row = mysqli_fetch_array($query_run_hotel)) { ?>

                                    <tr>
                                        <td>
                                            <?php
                                            $save_main_id = $row['id'];
                                            $save_book_id =  $row['book_id'];
                                            echo  $save_book_id;
                                            ?>
                                        </td>
                                        <td> <?= $row['checkintime'] ?> </td>
                                        <td> <?= $row['checkouttime'] ?> </td>
                                        <td> <?= $row['cus_name'] ?> </td>
                                        <td> <?= $row['room_day'] ?> </td>
                                        <td> <?= $row['total_price'] ?> </td>
                                        <td>
                                            <?php
                                            if (($row['status_booking']) == "0") {
                                                $save_status = "ยังไม่ได้ยืนยัน";
                                                $set_input_to_dis = "";
                                                echo "$save_status";
                                            } else {
                                                $save_status = "ชำระเงินเเล้ว";
                                                $set_input_to_dis = "disabled";
                                                echo "$save_status";
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center" style="width: 80px;">

                                            <form action="list_book_show_img_owner.php" method="POST" enctype="multipart/form-data">
                                                <div class="hide">

                                                    <input type="hidden" class="form-control" id="Input_Text" name="raw_img_time" value="<?= $row['receipt_time'] ?>">
                                                    <input type="hidden" class="form-control" id="Input_Text" name="raw_img_no" value="<?= $row['receipt_no'] ?>">
                                                    <input type="hidden" class="form-control" id="Input_Text" name="raw_img_who" value="<?= $row['receipt_who'] ?>">
                                                    <input type="hidden" class="form-control" id="Input_Text" name="raw_img" value="<?= $row['slip_img'] ?>">
                                                    <input type="hidden" class="form-control" id="Input_Text" name="raw_bank_type" value="<?= $row['bank_type'] ?>">
                                                    <input type="hidden" class="form-control" id="Input_Text" name="raw_status_booking" value="<?= $row['status_booking'] ?>">
                                                    <input type="hidden" class="form-control" id="Input_Text" name="raw_cusname" value="<?= $row['cus_name'] ?>">
                                                    <input type="hidden" class="form-control" id="Input_Text" name="raw_total_price" value="<?= $row['total_price'] ?>">
                                                    <input type="hidden" class="form-control" id="Input_Text" name="raw_room_day_total" value="<?= $row['room_day_total'] ?>">
                                                    <input type="hidden" class="form-control" id="Input_Text" name="raw_room_type" value="<?= $row['room_type'] ?>">

                                                </div>
                                                <button type="submit" class="btn btn-primary" type="submit" name="show_new_page_img"><i class="lni lni-support"></i></button>
                                            </form>

                                        </td>

                                        <td class="text-center" style="width: 80px;">
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" class="form-control" id="Input_Text" name="save_book_id" value="<?php echo $save_main_id ?>">

                                                <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_1" value="<?php echo $row['book_id'] ?>">
                                                <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_2" value="<?php echo $_SESSION['code_member'] ?>">
                                                <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_3" value="<?php echo $row['checkintime'] ?>">
                                                <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_4" value="<?php echo $row['checkouttime'] ?>">
                                                <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_5" value="<?php echo $row['cus_name'] ?>">
                                                <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_6" value="">
                                                <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_7" value="">
                                                <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_8" value="<?php echo $row['hotel_where'] ?>">
                                                <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_9" value="<?php echo $row['room_type'] ?>">
                                                <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_10" value="<?php echo $row['room_day_total'] ?>">
                                                <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_11" value="">
                                                <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_12" value="<?php echo $row['slip_img'] ?>">

                                                <button type="submit" class="btn btn-success" type="submit" name="check_status_pay" onclick="return confirm('คุณต้องการยืนยันการชำระเงินใช่ใหม ?')" <?php echo $set_input_to_dis ?>><i class="lni lni-save"></i></button>
                                            </form>
                                        </td>

                                        <td class="text-center" style="width: 80px;">
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

                                                <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_0" value="<?php echo $row['id'] ?>">
                                                <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_8" value="<?php echo $row['hotel_where'] ?>">
                                                <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_9" value="<?php echo $row['room_type'] ?>">
                                                <input type="hidden" class="form-control" id="Input_Text" name="insert_comm_10" value="<?php echo $row['room_day'] ?>">

                                                <button type="submit" class="btn btn-warning" type="submit" name="cancel_booking" onclick="return confirm('คุณต้องการยกเลิกการจองใช่ใหม ?')" <?php echo $set_input_to_dis ?>><i class="lni lni-cut"></i></i></button>
                                            </form>
                                        </td>

                                        <td class="text-center" style="width: 80px;">
                                            <a href="list_book_del_owner.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบการยกเลิกจองใช่ใหม ?')"><i class="lni lni-trash-can"></i></a>
                                        </td>

                                    </tr>
                            <?php
                                }
                            }
                            ?>

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function check_receipt() {
            var date_test_1 = "<?php echo $row['id'] ?>"
            var show_test_here = "100"
            document.getElementById("show_test_username").value = date_test_1;
        }
    </script>



    <?php mysqli_close($conn); ?>

    <!-- ? ---------------------------------- End Script ---------------------------------- -->
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

    <!-- ? ---------------------------------- End Script ---------------------------------- -->

</body>

</html>