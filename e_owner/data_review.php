<?php

require_once '../config/db.php';
include("../Template-backend/Header.php");

$result_emp = mysqli_query($conn, "SELECT `review_data`.*, `all_user`.first_name, `all_user`.last_name  FROM `review_data` INNER JOIN `all_user` ON `review_data`.user_id = `all_user`.id");

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
                            <h2>ข้อมูลการรีวิว</h2>
                        </div>
                    </div>
                    <div class="container">

                        <div class="col-lg">
                            <div class="card m-auto mt-3">
                                <div class="card-body">
                                    <div class="col-lg">

                                    </div>

                                    <div class="table-responsive mt-3">
                                        <table id="example" class="table table-striped" style="width:100%">

                                            <thead>
                                                <tr>
                                                    <th scope="col">ลำดับ</th>
                                                    <th scope="col">ชื่อ</th>
                                                    <th scope="col">คะเเนน</th>
                                                    <th scope="col">รายละเอียด</th>
                                                    <th scope="col">เวลาที่รีวิว</th>
                                                    <th scope="col">รหัสการจอง</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while (list(
                                                    $member_ID,
                                                    $member_rating,
                                                    $member_comment,
                                                    $member_create_time,
                                                    $member_user_id,
                                                    $member_book_id,
                                                    $member_firstname,
                                                    $member_lastname,
                                                ) = mysqli_fetch_row($result_emp)) {
                                                    echo "<tr>";
                                                    echo "<td>$member_ID</td>";
                                                    echo "<td>$member_firstname $member_lastname</td>";
                                                    echo "<td>$member_rating</td>";
                                                    echo "<td>$member_comment</td>";
                                                    echo "<td>$member_create_time</td>";
                                                    echo "<td>$member_book_id</td>";
                                                    echo "</tr>";
                                                };
                                                ?>

                                            </tbody>

                                        </table>
                                    </div>

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

</body>

</html>