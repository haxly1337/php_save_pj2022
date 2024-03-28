<?php

require_once 'config/db.php';

session_start();

$checkintime_guest = $_SESSION['checkintime_guest'];
$checkouttime_guset = $_SESSION['checkouttime_guset'];
$frist_name_guest = $_SESSION['frist_name_guest'];
$last_name_guset = $_SESSION['last_name_guset'];
$tel_cus_guest = $_SESSION['tel_cus_guest'];
$email_cus_guest = $_SESSION['email_cus_guest'];
$hotel_where = $_SESSION['hotel_where'];
$cus_detail = $_SESSION['cus_detail'];

//! Format Zone //
{
    if (($hotel_where) == "faikham_boutique") {

        $hotel_format_name = "Faikham Boutique";

        $img_faikham = "faikham_bq";
    } else {

        $hotel_format_name = "Faikham Hotel";

        $img_faikham = "faikham_hotel";
    }
}
//! End Format Zone //

//! Show Only //
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
//! End Show Only //

//! CHECK ROOM  //
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['send_value_next'])) {

    $check_step_1 = $_POST['room_where'];

    if (($check_step_1) == '') {
        $message_booking = "กรุณาเลือกห้องพักของท่าน";
        echo "<script>alert('$message_booking');</script>";
    } else {
        echo "<script>window.location.href='check_guset_pay.php';</script>";

        $_SESSION['checkintime_guest'] = $_POST['checkintime_guest'];
        $_SESSION['checkouttime_guset'] = $_POST['checkouttime_guset'];
        $_SESSION['frist_name_guest'] = $_POST['frist_name_guest'];
        $_SESSION['last_name_guset'] = $_POST['last_name_guset'];
        $_SESSION['tel_cus_guest'] = $_POST['tel_cus_guest'];
        $_SESSION['email_cus_guest'] = $_POST['email_cus_guest'];
        $_SESSION['hotel_where'] = $_POST['hotel_where'];

        $_SESSION['room_where'] = $_POST['room_where'];
        $_SESSION['amount_room'] = $_POST['amount_room'];

        $_SESSION['cus_detail'] = $_POST['cus_detail'];
    }
}
//! END CHECK ROOM //

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เลือกห้อง</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="css/cssmain.css">

</head>

<body>

    <div class="m-auto w-50 p-3">

        <div class="card mb-3">
            <div class="card-body text-center">
                <h4 class="center m-auto"> คุณจองห้องพัก ณ วันที่ <?php echo $checkintime_guest . " ถึง " . $checkouttime_guset ?> </h4>
                <hr>
                <h5 class="mt-2">กรุณาเลือกขนาดห้องพักของโรงเเรม : <?php echo $hotel_format_name ?> </h1>
            </div>
        </div>

        <div class="card">
            <card class="card-body">

                <div class="col-md">
                    <div class="card mb-3 m-auto" style="max-width: 650px;">
                        <div class="row g-0">
                            <div class="col-md-4 m-auto px-2">
                                <img src="img/<?php echo $img_faikham ?>/nom_1.png" class="img-fluid rounded-start" alt="..." style="border-radius: 15px;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">ห้องขนาดปกติ
                                        (
                                        <?php

                                        if (($hotel_where) == "faikham_boutique") {

                                            if (($save_room_hotel_3) == "0") {
                                                echo "ห้องพักเต็ม";
                                                $dis1 = "disabled";
                                            } else {
                                                echo "ห้องขนาดปกติ : " . $save_room_hotel_3 . " ห้อง";
                                                $dis1 = "";
                                            }
                                        } else {
                                            if (($save_room_hotel) == "0") {
                                                echo "ห้องพักเต็ม";
                                                $dis1 = "disabled";
                                            } else {
                                                echo "ห้องขนาดใหญ่ : " . $save_room_hotel . " ห้อง";
                                                $dis1 = "";
                                            }
                                        }

                                        ?>
                                        )
                                    </h5>
                                    <p class="card-text">เตียงเดี่ยว,ตู้เย็น,ทีวี,เครื่องปรับอากาศ,อุปรกรณ์อาบน้ำ,เครื่องน้ำอุ่น,WIFIฟรี</p>
                                    <p class="card-text">ราคา 790.- บาท</p>

                                    <div class="row">
                                        <div class="col">

                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal_room_type_1">
                                                กดเพื่อดูรูปภาพเพิ่มเติม
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal_room_type_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">รูปภาพเพิ่มเติม ห้องขนาดปกติ </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">

                                                                <div class="carousel-inner">
                                                                    <div class="carousel-item active">
                                                                        <img src="img/<?php echo $img_faikham ?>/nom_1.png" class="d-block w-100" alt="...">
                                                                    </div>
                                                                    <div class="carousel-item">
                                                                        <img src="img/<?php echo $img_faikham ?>/nom_2.png" class="d-block w-100" alt="...">
                                                                    </div>
                                                                    <div class="carousel-item">
                                                                        <img src="img/<?php echo $img_faikham ?>/nom_3.png" class="d-block w-100" alt="...">
                                                                    </div>
                                                                    <div class="carousel-item">
                                                                        <img src="img/<?php echo $img_faikham ?>/nom_4.png" class="d-block w-100" alt="...">
                                                                    </div>
                                                                    <div class="carousel-item">
                                                                        <img src="img/<?php echo $img_faikham ?>/nom_5.png" class="d-block w-100" alt="...">
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
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col" style="float: left;">
                                            <button type="sumbit" class="btn btn-primary" name="select_room" id="show_something_1" onclick="clicktoselect()" style="float: right;" <?php echo $dis1 ?>>
                                                จองห้องพัก
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md">
                                            <p class="mt-3" style="text-align:right;">จำนวนห้องที่ต้องการพัก </p>
                                        </div>

                                        <div class="col-md">
                                            <div class="mt-2">
                                                <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); send_values_1()" placeholder="ตัวอย่าง : 2" type="number" class="form-control" id="oninput_save_1" min="0" max="25" name="amount_room" maxlength="2" style="text-align: left;">
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md">
                    <div class="card mb-3 m-auto" style="max-width: 650px;">
                        <div class="row g-0">
                            <div class="col-md-4 m-auto px-2">
                                <img src="img/<?php echo $img_faikham ?>/dx_1.png" class="img-fluid rounded-start" alt="..." style="border-radius: 15px;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">ห้องขนาดใหญ่
                                        (
                                        <?php

                                        if (($hotel_where) == "faikham_boutique") {

                                            if (($save_room_hotel_4) == "0") {
                                                echo "ห้องพักเต็ม";
                                                $dis2 = "disabled";
                                            } else {
                                                echo "ห้องขนาดปกติ : " . $save_room_hotel_4 . " ห้อง";
                                                $dis2 = "";
                                            }
                                        } else {
                                            if (($save_room_hotel_2) == "0") {
                                                echo "ห้องพักเต็ม";
                                                $dis2 = "disabled";
                                            } else {
                                                echo "ห้องขนาดปกติ : " . $save_room_hotel_2 . " ห้อง";
                                                $dis2 = "";
                                            }
                                        }

                                        ?>
                                        )</h5>
                                    <p class="card-text">เตียง King Size,ตู้เย็น,ทีวี,เครื่องปรับอากาศ,อุปรกรณ์อาบน้ำ,เครื่องน้ำอุ่น,WIFIฟรี</p>
                                    <p class="card-text">ราคา 990.- บาท</p>

                                    <div class="row">
                                        <div class="col">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal_room_type_2">
                                                กดเพื่อดูรูปภาพเพิ่มเติม
                                            </button>

                                            <div class="modal fade" id="exampleModal_room_type_2" tabindex="-1" aria-labelledby="exampleModalLabel_2" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel_2">รูปภาพเพิ่มเติม ห้องขนาดใหญ่ </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div id="carouselExampleControls_2" class="carousel slide" data-bs-ride="carousel">

                                                                <div class="carousel-inner">
                                                                    <div class="carousel-item active">
                                                                        <img src="img/<?php echo $img_faikham ?>/dx_1.png" class="d-block w-100" alt="...">
                                                                    </div>
                                                                    <div class="carousel-item">
                                                                        <img src="img/<?php echo $img_faikham ?>/dx_2.png" class="d-block w-100" alt="...">
                                                                    </div>
                                                                    <div class="carousel-item">
                                                                        <img src="img/<?php echo $img_faikham ?>/dx_3.png" class="d-block w-100" alt="...">
                                                                    </div>
                                                                    <div class="carousel-item">
                                                                        <img src="img/<?php echo $img_faikham ?>/dx_4.png" class="d-block w-100" alt="...">
                                                                    </div>
                                                                    <div class="carousel-item">
                                                                        <img src="img/<?php echo $img_faikham ?>/dx_5.png" class="d-block w-100" alt="...">
                                                                    </div>
                                                                </div>

                                                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls_2" data-bs-slide="prev">
                                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Previous</span>
                                                                </button>
                                                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls_2" data-bs-slide="next">
                                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Next</span>
                                                                </button>

                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col" style="float: left;">
                                            <button type="sumbit" class="btn btn-primary mb-3" name="select_room" id="show_something_2" onclick="clicktoselect2()" style="float: right;" <?php echo $dis2 ?>>
                                                จองห้องพัก
                                            </button>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md">
                                            <p class="mt-3" style="text-align:right;">จำนวนห้องที่ต้องการพัก </p>
                                        </div>

                                        <div class="col-md">
                                            <div class="mt-2">
                                                <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); send_values_2()" placeholder="ตัวอย่าง : 2" type="number" class="form-control" id="oninput_save_2" min="0" max="25" name="amount_room" maxlength="2" style="text-align: left;">
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg">
                        <div style="text-align: left;">
                            <a href="booknow_guest.php" class="btn btn-primary mt-4">กลับไป</a>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div style="text-align: right;">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

                                <div class="hide">
                                    <input type="hidden" class="form-control" id="Input_Text" name="checkintime_guest" value="<?php echo $checkintime_guest ?>">
                                    <input type="hidden" class="form-control" id="Input_Text" name="checkouttime_guset" value="<?php echo $checkouttime_guset ?>">
                                    <input type="hidden" class="form-control" id="Input_Text" name="frist_name_guest" value="<?php echo $frist_name_guest ?>">
                                    <input type="hidden" class="form-control" id="Input_Text" name="last_name_guset" value="<?php echo $last_name_guset ?>">
                                    <input type="hidden" class="form-control" id="Input_Text" name="tel_cus_guest" value="<?php echo $tel_cus_guest  ?>">
                                    <input type="hidden" class="form-control" id="Input_Text" name="email_cus_guest" value="<?php echo $email_cus_guest  ?>">
                                    <input type="hidden" class="form-control" id="Input_Text" name="hotel_where" value="<?php echo $hotel_where ?>">
                                    <input type="hidden" class="form-control" id="Input_Text_room_where" name="room_where" value="">
                                    <input type="hidden" class="form-control" id="room_amount_room_value" name="amount_room" value="">
                                    <input type="hidden" class="form-control" id="Input_Text" name="cus_detail" value="<?php echo $cus_detail ?>">
                                </div>

                                <button type="submit" name="send_value_next" class="btn btn-primary mt-4" onclick="return confirm('คุณต้องการที่จะไปยังหน้าถัดไปใช่ใหม?')">
                                    ชำระเงิน
                                </button>
                            </form>
                        </div>
                    </div>
                </div>



            </card>
        </div>
    </div>

    <!-- ? ---------------------------------- End Script ---------------------------------- -->

    <script>
        function clicktoselect() {

            document.getElementById("Input_Text_room_where").value = "normal";
            document.getElementById("show_something_1").textContent = "เลือกอยู่";
            document.getElementById("show_something_2").textContent = "จองห้องพัก";

            document.getElementById('show_something_1').style.backgroundColor = '#649C61';
            document.getElementById("show_something_1").style.borderColor = "#649C61";

            document.getElementById('show_something_2').style.backgroundColor = '#0d6efd';
            document.getElementById("show_something_2").style.borderColor = "#0d6efd";

        }

        function clicktoselect2() {

            document.getElementById("Input_Text_room_where").value = "deluxe_room";
            document.getElementById("show_something_2").textContent = "เลือกอยู่";
            document.getElementById("show_something_1").textContent = "จองห้องพัก";

            document.getElementById('show_something_2').style.backgroundColor = '#649C61';
            document.getElementById("show_something_2").style.borderColor = "#649C61";

            document.getElementById('show_something_1').style.backgroundColor = '#0d6efd';
            document.getElementById("show_something_1").style.borderColor = "#0d6efd";

        }
    </script>

    <script>
        function send_values_1() {
            var x = document.getElementById("oninput_save_1").value;
            document.getElementById("room_amount_room_value").value = x;
            document.getElementById("oninput_save_2").value = '0';
        }
    </script>

    <script>
        function send_values_2() {
            var x = document.getElementById("oninput_save_2").value;
            document.getElementById("room_amount_room_value").value = x;
            document.getElementById("oninput_save_1").value = '0';
        }
    </script>

    <!-- <script>
        function display() {
            var index = click;
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
    </script> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <!-- ? ---------------------------------- End Script ---------------------------------- -->
</body>

</html>