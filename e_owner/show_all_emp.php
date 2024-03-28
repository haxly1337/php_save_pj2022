<?php

require_once '../config/db.php';
include("../Template-backend/Header.php");

function TelFormat($mobile)
{
    $minus_sign = "-";   // กำหนดเครื่องหมาย 
    $part1 = substr($mobile, 0, -7);  // เริ่มจากซ้ายตัวที่ 1 ( 0 ) ตัดทิ้งขวาทิ้ง 7 ตัวอักษร ได้ 085 
    $part2 = substr($mobile, 3, -3);  // เริ่มจากซ้าย ตัวที่ 4 (9) ตัดทิ้งขวาทิ้ง 3 ตัวอักษร ได้ 9490 
    $part3 = substr($mobile, 7); // เริ่มจากซ้าย ตัวที่ 8 (8) ไม่ตัดขวาทิ้ง ได้ 862  
    $a = $part1 . $minus_sign . $part2 . $minus_sign . $part3;
    return $a;
}

if (isset($_POST['sumbit_register'])) {

    // $cus_img = $_POST['image_insert'];
    $cus_username = $_POST['cus_username'];
    $cus_password = $_POST['cus_password'];
    $cus_name = $_POST['cus_first_name'];
    $cus_lastname = $_POST['cus_last_name'];
    $cus_email = $_POST['cus_email'];
    $cus_tel = $_POST['cus_tel'];
    $cus_address = $_POST['cus_address'];
    $cus_address_county = $_POST['cus_address_county'];
    $cus_address_district = $_POST['cus_address_district'];
    $cus_address_district_2 = $_POST['cus_address_district_2'];
    $cus_address_zipcode = $_POST['cus_address_zipcode'];
    $emp_select_role = $_POST['emp_select_role'];
    $emp_salary = $_POST['cus_salary'];

    $image_cus = $_FILES['image_insert']['name'];
    $temp_image = $_FILES['image_insert']['tmp_name'];
    $targetinto = "../img/" . $image_cus;

    $check_id = "SELECT * FROM all_user ORDER BY id DESC LIMIT 1";
    $check_result = mysqli_query($conn, $check_id);

    if (mysqli_num_rows($check_result) > 0) {
        if ($row = mysqli_fetch_assoc($check_result)) { {

                $code_member_id = $row['id'];
                $get_number = str_replace("", "", $code_member_id);
                $id_inc = $get_number + 1;
                $get_string = str_pad($id_inc, 5, 0, STR_PAD_LEFT);
                $code_member_id_real = $get_string;
            }
        }
    }

    $sql_u = "SELECT * FROM all_user WHERE username='$cus_username'";
    $sql_e = "SELECT * FROM all_user WHERE email='$cus_email'";
    $res_u = mysqli_query($conn, $sql_u);
    $res_e = mysqli_query($conn, $sql_e);

    if (mysqli_num_rows($res_u) > 0) {
        $name_error = "ชื่อผู้ใช้งานนี้มีผู้อื่นใช้ไปเเล้ว";
        echo "<script>alert('$message_nointo'); header('Refresh:0'); </script>";
    } else if (mysqli_num_rows($res_e) > 0) {
        $email_error = "อีเมลนี้มีผู้อื่นใช้ไปเเล้ว";
        echo "<script>alert('$message_nointo'); header('Refresh:0'); </script>";
    } else {
        $query_register = "INSERT INTO `all_user` (`id`, `code_member`, `first_name`, `last_name`, `username`, `password`, `email`, `tel`, `img`, `address`, `address_county`, `address_district`, `address_district2`, `address_zipcode`, `role`, `salary`) 
        VALUES (NULL, '$code_member_id_real', '$cus_name', '$cus_lastname', '$cus_username', ' $cus_password', '$cus_email', '$cus_tel', '$image_cus', '$cus_address', '$cus_address_county', '$cus_address_district', '$cus_address_district_2', '$cus_address_zipcode', '$emp_select_role', '$emp_salary');";
        $query_run = mysqli_query($conn, $query_register);

        move_uploaded_file($temp_image, $targetinto);

        if ($query_register) {
            $_SESSION['success'] = "ทำการเพิ่มข้อมูลสำเร็จ";
            $message_nointo =  $_SESSION['success'];
            echo "<script>alert('$message_nointo'); header('Refresh:0'); </script>";
        } else {
            $_SESSION['error'] = "เกิดข้อผิดพลางบางอย่าง";
            $message_nointo = $_SESSION['error'];
            echo "<script>alert('$message_nointo'); header('Refresh:0'); </script>";
        }
    }
}

//! ROW Share //
{
    $check_user_id =  $_SESSION['code_member'];

    $query_info = "SELECT * FROM all_user WHERE code_member = $check_user_id";
    $query_run_info = mysqli_query($conn, $query_info);
    $row = mysqli_fetch_assoc($query_run_info);
}
//! END ROW Share //

{
    if (isset($_POST['change_info_emp'])) {

        $save_user_id = $_POST['emp_main_id'];
        $save_code_member_id = $_POST['emp_main_code_member'];
        $save_username = $_POST['emp_save_username'];
        $save_password = $_POST['emp_save_password'];
        $save_img = $_POST['emp_save_img'];

        $cus_first_name = $_POST["cus_first_name"];
        $cus_last_name = $_POST["cus_last_name"];
        $cus_email = $_POST["cus_email"];
        $cus_tel = $_POST["cus_tel"];
        $cus_address = $_POST["cus_address"];
        $cus_address_county = $_POST["cus_address_county"];
        $cus_address_district = $_POST["cus_address_district"];
        $cus_address_district_2 = $_POST["cus_address_district_2"];
        $cus_address_zipcode = $_POST["cus_address_zipcode"];
        $emp_select_role = $_POST['emp_select_role'];
        $cus_salary = $_POST['cus_salary'];

        $file = $_FILES['image_edit']['name'];
        $temp_image = $_FILES['image_edit']['tmp_name'];
        $targetinto = "../img/" . $file;

        if ($file != "") {

            $query_update = "UPDATE all_user SET
            code_member = '$save_code_member_id',
            first_name = '$cus_first_name' ,
            last_name = '$cus_last_name' , 
            username = '$save_username' ,
            password = '$save_password' ,
            email = '$cus_email' ,
            tel = '$cus_tel' ,
            img = '$file' ,
            address = '$cus_address'  ,
            address_county = '$cus_address_county'  ,
            address_district = '$cus_address_district'  ,
            address_district2 = '$cus_address_district_2'  ,
            address_zipcode = '$cus_address_zipcode' ,
            role = '$emp_select_role' , 
            salary = '$cus_salary'
            WHERE id ='$save_user_id' ";

            $query_update_run = mysqli_query($conn, $query_update);
            move_uploaded_file($temp_image, $targetinto);

            if ($query_update_run) {
                $_SESSION['success'] = "ทำการเเก้ไขข้อมูลสำเร็จ";
                $message_nointo =  $_SESSION['success'];
                echo "<script>alert('$message_nointo'); window.location.href='show_all_emp_owner.php';</script>";
            } else {
                $_SESSION['error'] = "เกิดข้อผิดพลางบางอย่าง";
                $message_nointo = $_SESSION['error'];
                echo "<script>alert('$message_nointo'); window.location.href='show_all_emp_owner.php';</script>";
            }
        } else {

            $file = $save_img;

            $query_update = "UPDATE all_user SET
            code_member = '$save_code_member_id',
            first_name = '$cus_first_name' ,
            last_name = '$cus_last_name' , 
            username = '$save_username' ,
            password = '$save_password' ,
            email = '$cus_email' ,
            tel = '$cus_tel' ,
            img = '$file' ,
            address = '$cus_address'  ,
            address_county = '$cus_address_county'  ,
            address_district = '$cus_address_district'  ,
            address_district2 = '$cus_address_district_2'  ,
            address_zipcode = '$cus_address_zipcode' ,
            role = '$emp_select_role' , 
            salary = '$cus_salary'
            
            WHERE id ='$save_user_id' ";

            $query_update_run = mysqli_query($conn, $query_update);
            move_uploaded_file($temp_image, $targetinto);

            if ($query_update_run) {
                $_SESSION['success'] = "ทำการเเก้ไขข้อมูลสำเร็จ";
                $message_nointo =  $_SESSION['success'];
                echo "<script>alert('$message_nointo'); window.location.href='show_all_emp_owner.php';</script>";
            } else {
                $_SESSION['error'] = "เกิดข้อผิดพลางบางอย่าง";
                $message_nointo = $_SESSION['error'];
                echo "<script>alert('$message_nointo'); window.location.href='show_all_emp_owner.php';</script>";
            }
        }
    }
}

// CHECK NUMBER FORMAT TO DECIMAL
{
    $all_user_salary = $row['salary'];
    $all_user_salary_format = number_format($all_user_salary, 2, ".", ",");
}
// END CHECK NUMBER FORMAT TO DECIMAL

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ข้อมูลพนักงาน </title>

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
                            <h2>ข้อมูลพนักงาน</h2>
                        </div>
                    </div>
                    <div class="container">
                        <?php
                        include('../show_all_emp_owner.php')
                        ?>
                    </div>

                    <!-- ========== footer start =========== -->
                    <footer class="footer">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 order-last order-md-first">
                                    <div class="copyright text-center text-md-start">
                                        <p class="text-sm">
                                            Designed and Developed by
                                            <a href="https://plainadmin.com" rel="nofollow" target="_blank">
                                                Faikham
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                <!-- end col-->
                                <div class="col-md-6">
                                    <div class="
                  terms
                  d-flex
                  justify-content-center justify-content-md-end
                ">
                                        <!-- <a href="#0" class="text-sm">Term & Conditions</a>
                <a href="#0" class="text-sm ml-15">Privacy & Policy</a> -->
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end container -->
                    </footer>
                    <!-- ========== footer end =========== -->
                    </main>
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