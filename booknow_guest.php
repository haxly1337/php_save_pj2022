<?php

error_reporting(E_ALL & ~E_NOTICE);

require_once 'config/db.php';

session_start();

$save_date_raw1 = $_GET['checkintime_guest'];
$save_date_raw2 = $_GET['checkouttime_guset'];

$date_format1 = date("d-m-Y", strtotime($save_date_raw1));
$date_format2 = date("d-m-Y", strtotime($save_date_raw2));

$savedate1 = $date_format1;
$savedate2 = $date_format2;

if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['show_detail_and_info'])) {

    $frist_name_guest = $_POST['frist_name_guest'];
    $last_name_guset = $_POST['last_name_guset'];
    $hotel_where_check = $_POST['hotel_where'];

    if (($hotel_where_check) == "faikham_boutique") {
        $hotel_format_name = "Faikham Boutique";
    } else {
        $hotel_format_name = "Faikham Hotel";
    }

    $format_to_fullname = $frist_name_guest . " " . $last_name_guset;

    $check_id = "SELECT * FROM list_order_booking WHERE `cus_name` = '$format_to_fullname'";
    $check_result = mysqli_query($conn, $check_id);
    $row = mysqli_fetch_assoc($check_result);

    //! CHECK USER  //
    $check_full_name = $row['cus_name']; {
        if (($format_to_fullname) == $check_full_name) {
            $message_booking = "คุณได้จองไปเเล้ว รหัสการจอง ID : " . $row['book_id'] . " โรงเเรม " . $hotel_format_name . " กรุณาติดต่อทางโรงเเรม : 089-191-2737";
            echo "<script>alert('$message_booking'); window.location.href='booknow_guest.php';</script>";
        } else {
            echo "<script>window.location.href='booknow_guest_room.php';</script>";

            $_SESSION['checkintime_guest'] = $_POST['checkintime_guest'];
            $_SESSION['checkouttime_guset'] = $_POST['checkouttime_guset'];
            $_SESSION['frist_name_guest'] = $_POST['frist_name_guest'];
            $_SESSION['last_name_guset'] = $_POST['last_name_guset'];
            $_SESSION['tel_cus_guest'] = $_POST['tel_cus_guest'];
            $_SESSION['email_cus_guest'] = $_POST['email_cus_guest'];
            $_SESSION['hotel_where'] = $_POST['hotel_where'];

            // $_SESSION['room_where'] = $_POST['room_where'];
            // $_SESSION['amount_room'] = $_POST['amount_room'];

            $_SESSION['cus_detail'] = $_POST['cus_detail'];
        }
    }
    //! END CHECK USER //
}

//! Show Room //
{
    $rmax = '25'; {
        $srm_conn = "SELECT * FROM `room_data` WHERE `hotel_where` = 'faikham_hotel' AND `room_type` = 'normal'";
        $srm_run = mysqli_query($conn, $srm_conn);
        $srm_row = mysqli_fetch_assoc($srm_run);

        $room_amount_cus = $srm_row['room_amount'];
        $save_room_hotel = $rmax - $room_amount_cus;
    } {
        $srm_conn_2 = "SELECT * FROM `room_data` WHERE `hotel_where` = 'faikham_hotel' AND `room_type` = 'deluxe_room'";
        $srm_run_2 = mysqli_query($conn, $srm_conn_2);
        $srm_row_2 = mysqli_fetch_assoc($srm_run_2);

        $room_amount_cus_2 = $srm_row_2['room_amount'];
        $save_room_hotel_2 = $rmax - $room_amount_cus_2;
    } {
        $srm_conn_3 = "SELECT * FROM `room_data` WHERE `hotel_where` = 'faikham_boutique' AND `room_type` = 'normal'";
        $srm_run_3 = mysqli_query($conn, $srm_conn_3);
        $srm_row_3 = mysqli_fetch_assoc($srm_run_3);

        $room_amount_cus_3 = $srm_row_3['room_amount'];
        $save_room_hotel_3 = $rmax - $room_amount_cus_3;
    } {
        $srm_conn_4 = "SELECT * FROM `room_data` WHERE `hotel_where` = 'faikham_boutique' AND `room_type` = 'deluxe_room'";
        $srm_run_4 = mysqli_query($conn, $srm_conn_4);
        $srm_row_4 = mysqli_fetch_assoc($srm_run_4);

        $room_amount_cus_4 = $srm_row_4['room_amount'];
        $save_room_hotel_4 = $rmax - $room_amount_cus_4;
    }
}
//! End Show Room //


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Now</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="css/cssmain.css">

</head>

<body>

    <div class="m-auto w-50 p-3">

        <div class="card mb-3">
            <div class="card-body text-center">
                <h4 class="center m-auto"> คุณจองห้องพัก ณ วันที่ <?php echo $savedate1 . " ถึง " . $savedate2 ?> </h4>
                <hr>
                <h5 class="mt-2">กรุณาเลือกโรงเเรม</h1>
            </div>
        </div>

        <div class="row mt-4 text-center">

            <div class="col-6">
                <div class="card m-auto" style="width: 80%">
                    <img src="img/faikham_hotel/faikham_hotel.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Faikham Hotel</h5>
                        <p class="card-text">ฝ้ายคำ โฮสเทล 19/1-4 ถ.สันนาลุง ซอย 1 ต.วัดเกต อ.เมือง เชียงใหม่ 50000</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">จำนวนห้องที่เหลือตอนนี้ </li>
                        <li class="list-group-item">
                            <?php
                            if (($save_room_hotel) == "0") {
                                echo "ห้องปกติเต็มหมดเเล้ว";
                            } else {
                                echo "ห้องปกติเหลือจำนวน : " . $save_room_hotel . " ห้อง";
                            }
                            ?>
                        </li>
                        <li class="list-group-item">
                            <?php
                            if (($save_room_hotel_2) == "0") {
                                echo "ห้องพิเศษเต็มหมดเเล้ว";
                            } else {
                                echo "ห้องพิเศษเหลือจำนวน : " . $save_room_hotel_2 . " ห้อง";
                            }
                            ?>
                        </li>
                        </li>
                    </ul>
                    <div class="card-body">
                        <!-- <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a> -->
                        <button type="button" onclick="changehotel_1()" class="btn btn-primary" data-bs-toggle="modal" id="hotel_one" data-bs-target="#Modal_Show_2">เลือกโรงแรมแห่งนี้</button>
                    </div>

                </div>
            </div>

            <div class="col-6">
                <div class="card m-auto" style="width: 80%">
                    <img src="img/1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Faikham Boutique</h5>
                        <p class="card-text">
                            ฝ้ายคำ บูธีค 18 หมู่ 3 ต.สันกลาง อ.สันกำแพง เชียงใหม่ 50130
                        </p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">จำนวนห้องที่เหลือตอนนี้</li>
                        <li class="list-group-item">
                            <?php
                            if (($save_room_hotel_3) == "0") {
                                echo "ห้องปกติเต็มหมดเเล้ว";
                            } else {
                                echo "ห้องปกติเหลือจำนวน : " . $save_room_hotel_3 . " ห้อง";
                            }
                            ?>
                        </li>
                        <li class="list-group-item">
                            <?php
                            if (($save_room_hotel_4) == "0") {
                                echo "ห้องพิเศษเต็มหมดเเล้ว";
                            } else {
                                echo "ห้องพิเศษเหลือจำนวน : " . $save_room_hotel_4 . " ห้อง";
                            }
                            ?>
                        </li>
                    </ul>
                    <div class="card-body">
                        <!-- <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a> -->
                        <button type="button" onclick="changehotel_2()" class="btn btn-primary" data-bs-toggle="modal" id="hotel_two" data-bs-target="#Modal_Show_2">เลือกโรงแรมแห่งนี้</button>
                    </div>

                    <div class="modal fade" id="Modal_Show_2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel" value=""></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <!-- <form action="check_guset_pay.php" method="POST" enctype="multipart/form-data"> -->
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                                    <div class="modal-body">

                                        <!--* Slot 1 -->
                                        <div class="mt-2">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="birthday" class="form-label">วันที่เข้าพัก</label>
                                                    <input type="date" class="form-control" id="birthday" name="checkintime_guest" value="<?php echo $save_date_raw1; ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="birthday" class="form-label">วันที่ออก</label>
                                                    <input type="date" class="form-control" id="birthday" name="checkouttime_guset" value="<?php echo $save_date_raw2; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-2">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="Input_Text" class="form-label">ชื่อ</label>
                                                    <input type="" class="form-control" id="Input_Text" name="frist_name_guest" aria-describedby="" placeholder="ตัวอย่าง : นาย ธนาบดี" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="Input_Text" class="form-label">นามสกุล</label>
                                                    <input type="" class="form-control" id="Input_Text1" name="last_name_guset" aria-describedby="" placeholder="ตัวอย่าง : เกียรติรู่งวิไลกุล" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-2">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="Input_Text" class="form-label">เบอร์ติดต่อ</label>
                                                    <input type="" class="form-control" id="Input_Text2" name="tel_cus_guest" aria-describedby="" placeholder="ตัวอย่าง : 012-345-4567" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="Input_Text" class="form-label">อีเมล์</label>
                                                    <input type="" class="form-control" id="Input_Text3" name="email_cus_guest" aria-describedby="" placeholder="ตัวอย่าง : simple@gmail.com">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="w-75 m-auto mb-2 mt-2">
                                            <div class="col-md-12">
                                                <label for="Input_Text" class="form-label">โรงเเรม</label>
                                                <input type="" class="form-control text-center" id="Input_Text4" name="hotel_where_fake" value="" disabled>
                                                <input type="hidden" class="form-control text-center" id="Input_Text4_Sub" name="hotel_where" value="">
                                            </div>
                                        </div>

                                        <div class="mt-2 mb-3">
                                            <div>
                                                <label for="Input_Text" class="form-label">เพิ่มเติม</label>
                                                <input type="Input_Room_Add" class="form-control" id="Input_Text6" name="cus_detail" placeholder="ตัวอย่าง : หมอน 2 ใบ หรือ ที่นอนสำรอง">
                                                <label for="Input_Text" class="form-label mt-2">**ไม่สามารถเพิ่มเตียงนอนได้เนื่องจากขนาดของห้อง**</label>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                            <button type="submit" class="btn btn-primary" type="submit" name="show_detail_and_info">ต่อไป</button>
                                        </div>

                                    </div> <!-- End Model -->

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

    <script>
        function changehotel_1() {
            document.getElementById("exampleModalLabel").textContent = "จองห้องพักโรงเเรม Faikham Hotel";
            document.getElementById("Input_Text4").value = "Faikham Hotel";
            document.getElementById("Input_Text4_Sub").value = "faikham_hotel";
        }
    </script>

    <script>
        function changehotel_2() {
            document.getElementById("exampleModalLabel").textContent = "จองห้องพักโรงเเรม Faikham Boutique";
            document.getElementById("Input_Text4").value = "Faikham Boutique";
            document.getElementById("Input_Text4_Sub").value = "faikham_boutique";
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    
    <!-- ? ---------------------------------- End Script ---------------------------------- -->
</body>

</html>