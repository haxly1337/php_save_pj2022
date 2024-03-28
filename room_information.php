<?php

require_once 'config/db.php';
session_start();
error_reporting(E_ALL ^ E_NOTICE);


$save_user_id = $_SESSION['userid'];
$save_user_code_member = $_SESSION['code_member'];
$save_user_first_name = $_SESSION['first_name'];
$save_user_last_name = $_SESSION['last_name'];
$save_user_role = $_SESSION['role'];

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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <link type="text/css" rel="stylesheet" href="css/cssmain.css">
    <style>
        body {
            background-image: url("img/bg1.png");
            background-color: #cccccc;
            height: 500px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        ;
    </style>
    <title>Fai Kham</title>

</head>

<body>

    <!--! ---------------------------------- Head Bar Start ---------------------------------- -->

    <?php
    include('nav.php');
    ?>

    <!--! ---------------------------------- Head Bar End ----------------------------------  -->

    <!--! ---------------------------------- Body Show Start ----------------------------------  -->
    <div class="container">
        <div class="col-lg">

            <div class="card mt-4 m-auto w-75">
                <div class="card-body">

                    <div class="row">

                        <div class="col-6">
                            <div class="card m-auto mt-2" style="width: 80%">
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
                                <div class="card-body text-center">
                                    <button type="button" onclick="changehotel_1()" class="btn btn-primary" data-bs-toggle="modal" id="hotel_one" data-bs-target="#Modal_Show_1">กดเพื่อดูรูป</button>
                                </div>

                                <div class="modal fade" id="Modal_Show_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">รูปภาพเพิ่มเติม Faikham Hotel </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">

                                                    <div class="carousel-inner">
                                                        <div class="carousel-item active">
                                                            <img src="img/faikham_hotel/nom_1.png" class="d-block w-100" alt="...">
                                                        </div>
                                                        <div class="carousel-item">
                                                            <img src="img/faikham_hotel/nom_2.png" class="d-block w-100" alt="...">
                                                        </div>
                                                        <div class="carousel-item">
                                                            <img src="img/faikham_hotel/nom_3.png" class="d-block w-100" alt="...">
                                                        </div>
                                                        <div class="carousel-item">
                                                            <img src="img/faikham_hotel/nom_4.png" class="d-block w-100" alt="...">
                                                        </div>
                                                        <div class="carousel-item">
                                                            <img src="img/faikham_hotel/nom_5.png" class="d-block w-100" alt="...">
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
                        </div>

                        <div class="col-6">
                            <div class="card m-auto mt-2" style="width: 80%">
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
                                <div class="card-body text-center">
                                    <button type="button" onclick="changehotel_2()" class="btn btn-primary" data-bs-toggle="modal" id="hotel_two" data-bs-target="#Modal_Show_2">กดเพื่อดูรูป</button>
                                </div>

                                <div class="modal fade" id="Modal_Show_2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">รูปภาพเพิ่มเติม Faikham Boutique </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div id="carouselExampleControls_2" class="carousel slide" data-bs-ride="carousel">

                                                    <div class="carousel-inner">
                                                        <div class="carousel-item active">
                                                            <img src="img/faikham_bq/nom_1.png" class="d-block w-100" alt="...">
                                                        </div>
                                                        <div class="carousel-item">
                                                            <img src="img/faikham_bq/nom_2.png" class="d-block w-100" alt="...">
                                                        </div>
                                                        <div class="carousel-item">
                                                            <img src="img/faikham_bq/nom_3.png" class="d-block w-100" alt="...">
                                                        </div>
                                                        <div class="carousel-item">
                                                            <img src="img/faikham_bq/nom_4.png" class="d-block w-100" alt="...">
                                                        </div>
                                                        <div class="carousel-item">
                                                            <img src="img/faikham_bq/nom_5.png" class="d-block w-100" alt="...">
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
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--! ---------------------------------- Body Show End ----------------------------------  -->


    <!-- ? ---------------------------------- End Script ---------------------------------- -->

    <script type="text/javascript">
        $('.datepicker').datepicker({
            startDate: new Date()
        });
    </script>

    <script src="javascript/show_modal.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <!-- ? ---------------------------------- End Script ---------------------------------- -->
</body>

</html>