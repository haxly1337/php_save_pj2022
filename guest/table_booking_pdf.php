<?php
//   require("../require/function.php");
//   $conn = connect_db(0);

require_once '../config/db.php';

require_once __DIR__ . "/../vendor/autoload.php";


if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    // $result = mysqli_query($conn, "SELECT * FROM `list_order_booking` WHERE id ='$keyword'") or die(mysqli_error($conn));
    $BookingQuery = mysqli_query($conn, "SELECT * FROM `list_order_booking` WHERE `id` = '$keyword'");
    // $row = mysqli_fetch_array($BookingQuery);
}

//! Loop info in PDF ( Center )
{

    //! Semi Check Room Type
    {
        if (($check_hotel_where['room_type']) == "normal") {
            $show_room = "ห้องขนาดปกติ";
            $show_room_p = "790";
        } else {
            $show_room = "ห้องขนาดพิเคษ";
            $show_room_p = "990";
        };
    }

    $content = "";
    $i = 1;
    while ($row = mysqli_fetch_assoc($BookingQuery)) {
        $tablebody .= '<tr style="border:1px solid #000;">
            <td style="font-size: 20px; border-right:1px solid #000;padding:3px; text-align:center;"  >' . $row['checkintime'] . '</td>
            <td style="font-size: 20px; border-right:1px solid #000;padding:3px; text-align:center">' . $row['checkouttime'] . '</td>
            <td style="font-size: 20px; border-right:1px solid #000;padding:3px; text-align:center">' . $row['cus_name'] . '</td>
            <td style="font-size: 20px; border-right:1px solid #000;padding:3px; text-align:center">' . $show_room . '</td>
            <td style="font-size: 20px; border-right:1px solid #000;padding:3px; text-align:center">' . $row['room_day_total'] . '</td>
            <td style="font-size: 20px; border-right:1px solid #000;padding:3px; text-align:center">' . $show_room_p . ' บาท</td>
          </tr>';
        $i++;
    }
}
//! End Loop info in PDF ( Center )


//! Set Font info in PDF
{
    $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
    $fontDirs = $defaultConfig['fontDir'];

    $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
    $fontData = $defaultFontConfig['fontdata'];

    $mpdf = new \Mpdf\Mpdf([
        'fontDir' => array_merge($fontDirs, [
            __DIR__ . '/tmp',
        ]),
        'fontdata' => $fontData + [
            'sarabun' => [
                'R' => 'THSarabunNew.ttf',
                'I' => 'THSarabunNew Italic.ttf',
                'B' => 'THSarabunNew Bold.ttf',
                'BI' => 'THSarabunNew BoldItalic.ttf'
            ]
        ],
        'default_font' => 'sarabun'
    ]);
}
//! End Set Font info in PDF

//! Set Time in PDF
{

    $thai_year = date("Y") + 543;

    echo date("วันที่ d เดือน m ปี $thai_year"); //มัน default เป็น คศ
    echo "<br>";
    echo date("เวลา H นาฬิกา i นาที s วินาที");  //มันจะ default berlin ต้องไปแก้ที่ xampp

    $tmonth = date("m");

    switch ($tmonth) {
        case "01":
            $tmonth = "มกราคม";
            break;
        case "02":
            $tmonth = "กุมภาพันธ์";
            break;
        case "03":
            $tmonth = "มีนาคม";
            break;
        case "04":
            $tmonth = "เมษายน";
            break;
        case "05":
            $tmonth = "พฤษภาคม";
            break;
        case "06":
            $tmonth = "มิถุนายน";
            break;
        case "07":
            $tmonth = "กรกฎาคม";
            break;
        case "08":
            $tmonth = "สิงหาคม";
            break;
        case "09":
            $tmonth = "กันยายน";
            break;
        case "010":
            $tmonth = "ตุลาคม";
            break;
        case "011":
            $tmonth = "พฤศจิกายน";
            break;
        case "012":
            $tmonth = "ธันวาคม ";
            break;
    }

    $day = date("d");


    function DateThai($strDate)
    {
        $strYear = date("Y", strtotime($strDate));
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("j", strtotime($strDate));

        $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
    }

    $today = " $day $tmonth  $thai_year";  //มัน default เป็น คศ

}
//! End Set Time in PDF

//! Check Hotel Where to Show
{
    // Semi Address Hotel //

    $BookingQuery = mysqli_query($conn, "SELECT * FROM `list_order_booking` WHERE `id` = '$keyword'");
    $check_hotel_where = mysqli_fetch_array($BookingQuery);

    if (($check_hotel_where['hotel_where']) == "faikham_boutique") {
        $show_address_0 = "Faikham Boutique";
        $show_address_1 = "หมู่ที่ 3 เลขที่18";
        $show_address_2 = "ตำบลสันกลาง";
        $show_address_3 = "อำเภอสันกำแพง";
        $show_address_4 = "จังหวัดเชียงใหม่";
        $show_address_5 = "เลขไปรษณีย์ 50130";
        $supporter_hotel = "053-960-887";
    } else {
        $show_address_0 = "Faikham Hotel";
        $show_address_1 = "19 1-4 ถนน สันนาลุง";
        $show_address_2 = "ตำบลวัดเกต";
        $show_address_3 = "อำเภอเมืองเชียงใหม่";
        $show_address_4 = "จังหวัดเชียงใหม่";
        $show_address_5 = "เลขไปรษณีย์ 50000";
        $supporter_hotel = "063-096-6696";
    }
}
//! End Check Hotel Where to Show

$tableh =
    '
    <title>ใบเสร็จ_'.$check_hotel_where['receipt_no'].'</title>
    <style>
    body{
        font-family: ""; 
    }
    h2 {
    padding:0px;  
    }
    </style>
 
    <table style="width:100%"  border=0 >
        <tr>
            <th>  <img src="../img/5.png" height="15%" width="15%"> </th>
        </tr>
    </table>

    <hr>
    <br>

    <table style="width:100%" border=0>
    <tr>
        <th style = "font-size: 20px; text-align: left;" width=160px;> ที่อยู่โรงเเรม ' . $show_address_0 . ': </th>
    </tr>
    <tr>
        <th style = "font-size: 18px; text-align: left;" width=160px;> ' . $show_address_1 . ' </th>
    </tr>
    <tr>
        <th style = "font-size: 18px; text-align: left;" width=160px;> ' . $show_address_2 . ' </th>
    </tr>
    <tr>
        <th style = "font-size: 18px; text-align: left;" width=160px;> ' . $show_address_3 . ' </th>
    </tr>
    <tr>
        <th style = "font-size: 18px; text-align: left;" width=160px;> ' . $show_address_4 . ' </th>
    </tr>
    <tr>
        <th style = "font-size: 18px; text-align: left;" width=160px;> ' . $show_address_5 . ' </th>
    </tr>
    <tr>
        <th style = "font-size: 18px; text-align: left;" width=160px;> ' . $supporter_hotel . ' </th>
    </tr>
    </table>

    <p class="" style="margin: 3px;"></p>

    <table style="width:100%"  border=0 >
    <tr>
        <th style = "font-size: 20px; text-align: left; padding:0px; " width=160px;>รหัสการจอง : ' . $check_hotel_where['book_id'] . '</th>
    </tr>
    <tr>
        <th style = "font-size: 20px; text-align: left;" padding:0px;  width=160px;>ออกรายงาน ณ วันที่ : ' . $today . '</th>
    </tr>
    </table>

    <p class="" style="margin: 2px;"></p>
  
    <table id="bg-table" width="100%" style="border-collapse: collapse;font-size:11pt;margin-top:8px;">
        <tr style="border:1px solid #000;padding:4px;">
            <th  style="font-size: 20px; border-right:1px solid #000;padding:4px;text-align:center;"   width="10%">วันที่เช็คอิน</td>
            <th  style="font-size: 20px; border-right:1px solid #000;padding:4px;text-align:center;"  width="15%">วันที่เช็คเอาท์ </td>
            <th  width="15%" style="font-size: 20px; border-right:1px solid #000;padding:4px;text-align:center;">ชื่อผู้เข้าพัก</td>
            <th  style="font-size: 20px; border-right:1px solid #000;padding:4px;text-align:center;"  width="15%">ประเภทห้อง</td>
            <th  width="15%" style="font-size: 20px; border-right:1px solid #000;padding:4px;text-align:center;">จำนวนวัน</td>
            <th  style="font-size: 20px; border-right:1px solid #000;padding:4px;text-align:center;"  width="15%">ราคาห้อง</td>
        </tr>
    
    </thead>

    <tbody>';

$tableend =
    "
<tr>
    <td style=''></td>
    <td style=''></td>
    <td style=''></td>
    <td style=''></td>
    <td style='font-size: 20px; border:1px solid #000; padding:3px; text-align:right;'>ยอดรวมทั้งสิ้น</td>
    <td style='font-size: 20px; border:1px solid #000; padding:3px; text-align:center;'>" . number_format($check_hotel_where['total_price'], 2) . " บาท</td>
</tr>

</tbody>
</table>
<br>
<hr>
";

$footer = '
        <p class="" style="margin: 2px; font-size: 20px; text-align:center;">ฝ่ายคำขอขอบคุณที่ใช้บริการ</p>

';



$mpdf->WriteHTML($tableh);

$mpdf->WriteHTML($tablebody);

$mpdf->WriteHTML($tableend);

$mpdf->WriteHTML($footer);


$mpdf->Output();
 
//https://monkeywebstudio.com/%E0%B8%AA%E0%B8%A3%E0%B9%89%E0%B8%B2%E0%B8%87%E0%B9%84%E0%B8%9F%E0%B8%A5%E0%B9%8C-pdf-%E0%B8%94%E0%B9%89%E0%B8%A7%E0%B8%A2-mpdf/
