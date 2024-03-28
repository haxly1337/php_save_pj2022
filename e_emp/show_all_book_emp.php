<?php

session_start();
require_once 'config/db.php';

$query_table = "SELECT * FROM customer_data";
$result_table = mysqli_query($conn, $query_table);

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

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>เเสดงรายชื่อผู้ที่มาพัก</title>

        <link rel="stylesheet" href="assets/css/main.css" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css>
        <link rel="stylesheet" href=https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css>

        <link rel="stylesheet" href="assets/css/lineicons.css" />
        <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" />
        <link rel="stylesheet" href="assets/css/fullcalendar.css" />
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

        <div class="container">
            <div class="card m-auto" style="width: 90%;">
                <div class="card-body">
                    <div class="col-lg text-center">
                        <h4>เเสดงรายชื่อผู้ที่มาพัก</h4>
                    </div>
                    <div class="mt-2">

                        <form name="frmSearch" method="get" action="">
                            <div class="mt-2">
                                <div class="col-md-12">
                                    <label for="Input_Hotel" class="form-label">โรงเเรม</label>
                                    <select id="Input_Hotel" class="form-select" name="hotel_where_select" value="noselect">
                                        <option value="noselect">..</option>
                                        <option value="faikham_hotel">Faikham Hotel</option>
                                        <option value="faikham_boutique">Faikham Boutique</option>
                                    </select>
                                </div>
                            </div>

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

                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-success mt-3" name="search">ค้นหารายการ</button>
                                </div>
                                <div class="col">
                                    <div class="" style="float :right">
                                        <a class="btn btn-primary mt-3" href="index_backend_emp.php" role="button">กลับหน้าหลัก</a>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>

                    <div class="table-responsive mt-3">

                        <table id="example" class="table table-striped" style="width:100%">

                            <thead>
                                <tr>
                                    <th scope="col">รหัสผู้ใช้</th>
                                    <th scope="col">โรงเเรม</th>
                                    <th scope="col">เวลาเข้าพัก</th>
                                    <th scope="col">เวลาออกจากทีพัก</th>
                                    <th scope="col">ชื่อ-นามสกุล</th>
                                    <th scope="col">ประเภทห้อง</th>
                                    <th scope="col" class="text-center">เช็คอิน</th>
                                    <th scope="col" class="text-center">เช็คเอาท์</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                if (isset($_GET['hotel_where_select']) && isset($_GET['dateFirst'])) { {
                                        $from_date = $_GET['dateFirst'];
                                        $to_date =  $_GET['dateSecond'];
                                        $hotel_where_select = $_GET['hotel_where_select'];
                                        $query_hotel = "SELECT * FROM customer_data WHERE ( hotel_where = '$hotel_where_select' AND checkintime BETWEEN '$from_date' AND '$to_date')";
                                        // $query_hotel = "SELECT * FROM customer_data WHERE ( hotel_where = '$hotel_where_select' AND checkintime = '$from_date')";
                                        $query_run_hotel = mysqli_query($conn, $query_hotel);
                                    }

                                    if (mysqli_num_rows($query_run_hotel) > 0) {
                                        foreach ($query_run_hotel as $row) { ?>

                                            <tr>
                                                <td style="padding: 8px;"><?= $row['id']; ?></td>
                                                <td style="padding: 8px;"><?= $row['hotel_where']; ?></td>
                                                <td style="padding: 8px;">
                                                    <?php
                                                    $date_checkintime = $row['checkintime'];
                                                    $date_checkintime = date("d-m-Y", strtotime($date_checkintime));
                                                    echo $date_checkintime;
                                                    ?></td>
                                                <td style="padding: 8px;">
                                                    <?php
                                                    $date_checkinouttime = $row['checkouttime'];
                                                    $date_checkinouttime = date("d-m-Y", strtotime($date_checkinouttime));
                                                    echo $date_checkinouttime;
                                                    ?>
                                                </td>
                                                <td style="padding: 8px;"><?= $row['cus_name']; ?></td>
                                                <td style="padding: 8px;">
                                                    <?php
                                                    if (($row['room_type']) == "normal") {
                                                        $save_room = 'ห้องปกติ';
                                                        echo $save_room;
                                                    } else if (($row['room_type']) == "deluxe_room") {
                                                        $save_room = 'ห้องพิเศษ';
                                                        echo $save_room;
                                                    } else {
                                                        echo 'เกิดข้อผิดพลาด';
                                                    }
                                                    ?>
                                                </td>

                                                <td class="text-center" style="padding: 8px;">
                                                    <a href="" class="btn btn-warning"><i class="lni lni-slice"></i></a>
                                                </td>

                                                <td class="text-center" style="padding: 8px;">
                                                    <a href="del_show_all_book_emp.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบการยกเลิกจองใช่ใหม ?')"><i class="lni lni-trash-can"></i></a>
                                                </td>

                                            </tr>
                                <?php
                                        }
                                    }
                                }
                                ?>

                            </tbody>
                        </table>

                    </div>
                    <?php mysqli_close($conn); ?>
                </div>
            </div>
        </div>

        <!-- End Script-->
        <script>
            function imagePreview(fileInput) {
                if (fileInput.files && fileInput.files[0]) {
                    var fileReader = new FileReader();
                    fileReader.onload = function(event) {
                        $('#preview').html('<img src="' + event.target.result + '" width="300" height="300"/>');
                    };
                    fileReader.readAsDataURL(fileInput.files[0]);
                }
            }
            $("#image").change(function() {
                imagePreview(this);
            });
        </script>

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
    <?php } ?>
    </body>

    </html>