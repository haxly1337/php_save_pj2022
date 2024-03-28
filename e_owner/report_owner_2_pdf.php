<?php
//   require("../require/function.php");
//   $conn = connect_db(0);

require_once '../config/db.php';

require_once __DIR__ . "/../vendor/autoload.php";

$resultRole = mysqli_query($conn, "SELECT DISTINCT(hotel_where) as role FROM `list_order_booking`;");

$test_1;

while ($row = mysqli_fetch_assoc($resultRole)) {

    if (($row['role']) == 'faikham_hotel') {
        $test_1[$row['role'] . '_TH'] = "Faikham Hotel";
        $test_1["Faikham Hotel"] = $row['role'];
    } else if (($row['role']) == 'faikham_boutique') {
        $test_1[$row['role'] . '_TH'] = "Faikham Boutique";
        $test_1["Faikham Boutique"] = $row['role'];
    }
}

if (isset($_GET['keyword'])) {

    $keyword = $test_1[$_GET['keyword']];
    $result = mysqli_query($conn, "SELECT * FROM list_order_booking WHERE hotel_where ='$keyword'") or die(mysqli_error($conn));
} else {
    $result = mysqli_query($conn, "SELECT * FROM list_order_booking  ") or die(mysqli_error($conn));
}


$content = "";

$i = 1;
while (list(
    $member_ID,
    $member_book_id,
    $member_hotel_where,
    $member_room_type,
    $member_checkintime,
    $member_checkouttime,
    $member_user_id,
    $member_cus_name,
    $member_room_day,
    $member_total_price,
    $member_status_booking,
    $member_slip_img,
    $member_receipt_who,
    $member_receipt_time,
    $member_receipt_no,
    $member_status_receipt,
    $member_bank_type,
    $member_room_day_total,
    $member_code_member,
    $member_room_status
) = mysqli_fetch_row($result)) {

    $tablebody .= '<tr style="border:1px solid #000;">
        <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $member_book_id . '</td>
        <td style="border-right:1px solid #000;padding:3px;text-align:center">' . $member_checkintime . '</td>
        <td style="border-right:1px solid #000;padding:3px; text-align:center">' . $member_checkouttime . '</td>
        <td style="border-right:1px solid #000;padding:3px; text-align:center">' . $member_cus_name . '</td>
        <td style="border-right:1px solid #000;padding:3px; text-align:center">' . $test_1[$member_hotel_where . '_TH'] . '</td>
        <td style="border-right:1px solid #000;padding:3px; text-align:center">' . $member_room_day_total . '</td>
        <td style="border-right:1px solid #000;padding:3px; text-align:center">' . $member_total_price . '</td>
      </tr>';
    $i++;
}




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


$thai_year = date("Y") + 543;

echo date("วันที่ d เดือน m ปี $thai_year"); //มัน default เป็น คศ
echo "<br>";
echo date("เวลา H นาฬิกา i นาที s วินาที");  //มันจะ default berlinต้องไปแก้ที่xampp

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



$today = " $day $tmonth  $thai_year"; //มัน default เป็น คศ


$tableh = '

<style>
  body{
    font-family: "Garuda"; 
}
h2 {
  display:inline;
  text-align:center";
}
h2 {
  padding:0px;  
}
</style>
 


    <table style="width:100%"  border=0 >
    
    <tr>
        <th> <img src="../img/5.png" height="15%" width="15%"> </th>
    </tr>
  
    </table>
    <hr>
    <br>
    <table style="width:100%"  border=0 >
    <tr>
        <th style = "font-size: 20px;" width=160px;  > รายงานข้อมูลการจองห้องพัก </th>
    </tr>
  
    </table>

 <p class="" style="margin: 6px;"></p>
<table style="width:100%"  border=0 >
    <tr>
        <th width=160px ><title> ออกรายงาน ณ วันที่ : ' . $today . '</title></th>
        
   

      </tr>
  

    </table>
   <br>   
            
   
 
<table id="bg-table" width="100%" style="border-collapse: collapse;font-size:10pt;margin-top:8px;">
    <tr style="border:1px solid #000;padding:4px;">
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"   width="10%">รหัสการจอง</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="15%">วันเช็คอิน </td>
        <td  width="15%" style="border-right:1px solid #000;padding:4px;text-align:center;">วันเช็คเอาท์</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="15%">ชื่อผู้จอง</td>
        <td  width="15%" style="border-right:1px solid #000;padding:4px;text-align:center;">โรงเเรม</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="15%">จำนวนวัน</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="15%">ยอดชำระเงิน</td>
    </tr>
 
</thead>
  <tbody>';
$tableend = "</tbody>
</table> <br><hr>";


$footer = '
<title> Faikham Hotel </title>
 
  
';



$mpdf->WriteHTML($tableh);

$mpdf->WriteHTML($tablebody);

$mpdf->WriteHTML($tableend);

$mpdf->WriteHTML($footer);


$mpdf->Output();
 
//https://monkeywebstudio.com/%E0%B8%AA%E0%B8%A3%E0%B9%89%E0%B8%B2%E0%B8%87%E0%B9%84%E0%B8%9F%E0%B8%A5%E0%B9%8C-pdf-%E0%B8%94%E0%B9%89%E0%B8%A7%E0%B8%A2-mpdf/
