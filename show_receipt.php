<?php

require_once __DIR__ . '/vendor/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/tmp',
    ]),
    'THSarabun' => $fontData + [
        'THSarabun' => [
            'R' => 'THSarabun.ttf',
            'I' => 'THSarabun.ttf',
        ]
    ],
    'default_font' => 'THSarabun'
]);

ob_start();


//* Collect Data //
{

    session_start();

    $book_id_real = $_SESSION['book_id_real'];
    $checkintime_guest_send = $_SESSION['checkintime_guest_send'];
    $checkouttime_guset_send = $_SESSION['checkouttime_guset_send'];
    $fullname_send =  $_SESSION['fullname_send'];
    $amount_room_send = $_SESSION['amount_room_send'];
    $total_monery_send = $_SESSION['total_monery_send'];
    $save_amount_day_send = $_SESSION['save_amount_day_send'];
    $hotel_where_send = $_SESSION['hotel_where_send'];
    $room_where_send =  $_SESSION['room_where_send'];
    $cus_detail_send = $_SESSION['cus_detail_send'];
    $cus_email = $_SESSION['cus_email'];
    $cus_tel = $_SESSION['cus_tel'];

    $change_bank = $_SESSION['change_bank'];

    $save_time_transferee_change = $_SESSION['save_time_transferee_change'];

    $code_promo = "12345";
}
//* End Collect Data //

//! Format Zone //
{
    if (($hotel_where_send) == "faikham_boutique") {
        $hotel_where_send = "Faikham Boutique";
    } else {
        $hotel_where_send = "Faikham Hotel";
    }

    // Semi Address Hotel //
    if (($hotel_where_send) == "Faikham Boutique") {
        $show_address_1 = "หมู่ที่ 3 เลขที่18";
        $show_address_2 = "ตำบลสันกลาง";
        $show_address_3 = "อำเภอสันกำแพง";
        $show_address_4 = "จังหวัดเชียงใหม่";
        $show_address_5 = "เลขไปรษณีย์ 50130";
        $supporter_hotel = "053-960-887";
    } else {
        $show_address_1 = "19 1-4 ถนน สันนาลุง";
        $show_address_2 = "ตำบลวัดเกต";
        $show_address_3 = "อำเภอเมืองเชียงใหม่";
        $show_address_4 = "จังหวัดเชียงใหม่";
        $show_address_5 = "เลขไปรษณีย์ 50000";
        $supporter_hotel = "063-096-6696";
    }

    if (($room_where_send) == "normal") {
        $room_where_send = "ห้องปกติ";
    } else {
        $room_where_send = "ห้องใหญ่พิเคษ";
    }

    if (($change_bank) == "1") {
        $change_bank = "ธนาคารกสิกรไทย";
    } else if (($change_bank) == "2") {
        $change_bank = "ธนาคารกรุงเทพ";
    } else {
        $change_bank = "เกิดข้อผิดพลาด";
    }

    if (($code_promo) == "12345") {
        $code_promo = 200;
    } else {
        $code_promo = 0;
    }

    $checkintime_guest_send = date("d-m-Y", strtotime($checkintime_guest_send));
    $checkouttime_guset_send = date("d-m-Y", strtotime($checkouttime_guset_send));
}

//! End Format Zone //

//? Maths Zone //
{
    if (($room_where_send) == "ห้องปกติ") {
        $price_room = 790;
    } else {
        $price_room = 990;
    }

    // Math Room
    $math_price_room = $price_room * $amount_room_send;
    $math_price_room = number_format($math_price_room, 0);

    $math_price_room_2 = (($price_room * $amount_room_send) * $save_amount_day_send);
    $math_price_room_2 = number_format($math_price_room_2, 0);

    // Math Total
    $math_total = (($price_room - $code_promo) * $amount_room_send) * $save_amount_day_send;
    $math_total = number_format($math_total, 0);
}
//? End Maths Zone //

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใบเสร็จรายการจองห้องพัก</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/lineicons.css" />
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" />

    <link rel="stylesheet" href="css/cssmain.css">

</head>

<body>

    <div class="container">
        <div class="col-lg">
            <div class="card m-auto w-75">
                <div class="card-body">
                    <div class="col-lg">

                        <div class="row text-center">

                            <div class="col-md m-auto p-auto">
                                <div class="" style="font-size: 20px; font-weight: 500; ">
                                    <p>Faikham</p>
                                </div>
                            </div>
                            <div class="col-md m-auto p-auto">
                                <div class="" style="font-size: 20px; font-weight: 100;">
                                    <p>ใบจองห้องพัก</p>
                                </div>
                            </div>
                            <div class="col-md m-auto p-auto" style="font-size: 18px; font-weight: 100;">
                                <div class="">
                                    <p>คุณ : <?php echo $fullname_send ?></p>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="mb-3">
                        <hr style="padding: 0px; margin: 0px;">
                    </div>

                    <div class="col-lg">
                        <div class="row">

                            <div class="col-md">
                                <div class="test_something_ti" style="float: left;">
                                    <div>
                                        <div class="col me-5">
                                            <p class="mb-0 me-5" style="font-size:18px;">โรงเเรมตั้งที่อยู่ :</P>
                                        </div>
                                        <div class="col me-5">
                                            <p class="mb-0 me-5"><?php echo "  " . $show_address_1 ?></p>
                                        </div>
                                        <div class="col me-5">
                                            <p class="mb-0 me-5"><?php echo "  " . $show_address_2 ?></p>
                                        </div>
                                        <div class="col me-5">
                                            <p class="mb-0 me-5"><?php echo "  " . $show_address_3 ?></p>
                                        </div>
                                        <div class="col me-5">
                                            <p class="mb-0 me-5"><?php echo "  " . $show_address_4 ?></p>
                                        </div>
                                        <div class="col me-5">
                                            <p class="mb-0 me-5"><?php echo "  " . $show_address_5 ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md">
                                <div class="test_something_ti" style="float: right;">
                                    <p style="font-size:18px;">เบอร์โทรติดต่อ : <?php echo $supporter_hotel ?> </p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md mt-4 mb-0">
                        <p class="mb-0" style="font-size:17.5px; float: left;">รหัสการจอง </p>
                        <p class="mb-0" style="font-size:17.5px;"> : <?php echo " " . $book_id_real ?></p>
                    </div>

                    <div class="col-md mt-1 mb-4 p-auto">
                        <p class="mb-0" style="font-size:17.5px; float: left;">จองวันที่ </p>
                        <p class="mb-0" style="font-size:17.5px;"> : <?php echo " " . $checkintime_guest_send ?></p>
                    </div>

                    <table class="table table-bordered mt-0 m-auto" style="width: 900px;">
                        <thead>
                            <tr>
                                <th colspan="3" style="text-align: center;">รายละเอียดผู้จอง</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width:150px">ชื่อผู้จอง</td>
                                <td colspan="2"><?php echo $fullname_send ?></td>
                            </tr>
                            <tr>
                                <td>อีเมลผู้จอง</td>
                                <td colspan="2"><?php echo $cus_email ?></td>
                            </tr>
                            <tr>
                                <td>เบอร์ติดต่อผู้จอง</td>
                                <td colspan="2"><?php echo $cus_tel ?></td>
                            </tr>
                            <tr>
                                <td>ธนาคารที่โอนเงิน</td>
                                <td colspan="2"><?php echo $change_bank ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered mt-4 m-auto" style="width: 900px;">
                        <thead>

                            <tr>
                                <th colspan="3" style="text-align: center;">รายละเอียดการจอง</th>
                                <th scope="col" style="text-align: center;">จำนวน</th>
                            </tr>

                        </thead>
                        <tbody>

                            <tr>
                                <td style="width:150px">โรงเเรมที่พัก</td>
                                <td colspan="2" style="width:150px"><?php echo $hotel_where_send ?></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>ระยะเวลาการจอง</td>
                                <td colspan="2"><?php echo $checkintime_guest_send . " ถึง " . $checkouttime_guset_send . " ( " . $save_amount_day_send . " วัน )" ?></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>ประเภทห้องพัก</td>
                                <td colspan="2"><?php echo $room_where_send ?></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>ราคารวม</td>
                                <td colspan="2"><?php echo $price_room . " ราคาห้อง" . $room_where_send . " x " . $amount_room_send . " จำนวนห้อง x " . $save_amount_day_send . " วัน" ?></td>
                                <td style="text-align: center;"> <?php echo $math_price_room_2 ?> บาท </td>
                            </tr>

                            <tr>
                                <td>ส่วนลด</td>
                                <td colspan="2"><?php echo $code_promo ?> บาท</td>
                                <td style="text-align: center;"> <?php echo $code_promo ?> บาท </td>
                            </tr>

                            <tr>
                                <td colspan="3" style="text-align: right;">ผลรวมทั้งสิ้น</td>
                                <td style="text-align: center;"><?php echo $math_total ?> บาท </td>
                            </tr>

                        </tbody>
                    </table>

                    <?php 
                        $html = ob_get_contents();
                        $mpdf->WriteHTML($html);
                        $mpdf->Output("myreceipt.pdf"); 
                        ob_end_flush();
                    ?>

                    <div class="row">

                        <div class="col-lg text-center mt-3">
                            <a href="myreceipt.pdf" class="btn btn-danger" target=""> <i class="mdi mdi-tag-arrow-up-outline"></i> พิมพ์ใบเสร็จ PDF </a>
                        </div>
                        
                        <div class="col-lg text-center mt-3">
                            <a href="index.php" class="btn btn-primary" target="">กลับไปยังหน้าหลัก</a>
                        </div>


                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- ? ---------------------------------- End Script ---------------------------------- -->

    <script src="http://code.jquery.com/jquery-latest.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <!-- ? ---------------------------------- End Script ---------------------------------- -->

</body>

</html>