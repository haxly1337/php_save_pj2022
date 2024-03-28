<?php
    session_start();
    require_once "config/db.php";
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

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