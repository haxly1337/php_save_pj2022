<?php

require_once 'config/db.php';
session_start();

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
    $targetinto = "img/" . $image_cus;

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
        echo "<script>alert('$name_error'); window.location.href='show_all_emp.php';</script>";
    } else if (mysqli_num_rows($res_e) > 0) {
        $email_error = "อีเมลนี้มีผู้อื่นใช้ไปเเล้ว";
        echo "<script>alert('$email_error'); window.location.href='show_all_emp.php';</script>";
    } else {
        $query_register = "INSERT INTO `all_user` (`id`, `code_member`, `first_name`, `last_name`, `username`, `password`, `email`, `tel`, `img`, `address`, `address_county`, `address_district`, `address_district2`, `address_zipcode`, `role`, `salary`) 
        VALUES (NULL, '$code_member_id_real', '$cus_name', '$cus_lastname', '$cus_username', ' $cus_password', '$cus_email', '$cus_tel', '$image_cus', '$cus_address', '$cus_address_county', '$cus_address_district', '$cus_address_district_2', '$cus_address_zipcode', '$emp_select_role', '$emp_salary');";
        $query_run = mysqli_query($conn, $query_register);

        move_uploaded_file($temp_image, $targetinto);

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
        $targetinto = "img/" . $file;

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
                echo "<script>alert('$message_nointo'); window.location.href='show_all_emp.php';</script>";
            } else {
                $_SESSION['error'] = "เกิดข้อผิดพลางบางอย่าง";
                $message_nointo = $_SESSION['error'];
                echo "<script>alert('$message_nointo'); window.location.href='show_all_emp.php';</script>";
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
                echo "<script>alert('$message_nointo'); window.location.href='show_all_emp.php';</script>";
            } else {
                $_SESSION['error'] = "เกิดข้อผิดพลางบางอย่าง";
                $message_nointo = $_SESSION['error'];
                echo "<script>alert('$message_nointo'); window.location.href='show_all_emp.php';</script>";
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เเสดงรายชื่อพนักงานทั้งหมด</title>

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

    <div class="container">
        <div class="col-lg">
            <div class="card">
                <div class="card-body">

                    <div class="col-lg text-center">
                        <h3>เเสดงรายชื่อพนักงานทั้งหมด</h3>
                    </div>

                    <div class="row">

                        <div class="col-md">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm">

                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            เพิ่มพนักงาน
                                        </button>

                                        <button type="submit" class="btn btn-success" name="show_all_name_emp" id="">เเสดงรายชื่อพนักงานทั้งหมด</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-md m-auto">
                            <a class="btn btn-primary" href="index_test_showing.php" role="button" style="float: right;">กลับหน้าหลัก</a>
                        </div>

                    </div>

                    <div class="col-lg">

                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">เพิ่มพนักงาน</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="col-md-12 mt-2">
                                                <div class="text-center">
                                                    <label for="formFile" class="form-label">รูปภาพผู้ใช้งาน</label>
                                                    <input class="form-control" type="file" name="image_insert" id="image" value=""/>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-sm">
                                                    <div class="mt-2">
                                                        <div>
                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ชื่อผู้ใช้งาน</label>
                                                            <input type="text" class="form-control" id="Input_Text" name="cus_username" placeholder="ตัวอย่าง : thana123" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm">
                                                    <div class="mt-2">
                                                        <div>
                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">รหัสผ่าน</label>
                                                            <input type="password" class="form-control" id="Input_Text" name="cus_password" placeholder="ตัวอย่าง : 1234" maxlength="16" required>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-sm">
                                                    <div class="mt-2">
                                                        <div>
                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ชื่อ</label>
                                                            <input type="text" class="form-control" id="Input_Text" name="cus_first_name" placeholder="ตัวอย่าง : นาย อร่อยมาก" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm">
                                                    <div class="mt-2">
                                                        <div>
                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">นามสกุล</label>
                                                            <input type="text" class="form-control" id="Input_Text" name="cus_last_name" placeholder="ตัวอย่าง : หวานหอมอร่อย" required>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-sm">
                                                    <div class="mt-2">
                                                        <div>
                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">อีเมล์</label>
                                                            <input type="text" class="form-control" id="Input_Text" name="cus_email" placeholder="ตัวอย่าง : user01@gmail.com">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm">
                                                    <div class="mt-2">
                                                        <div>
                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">เบอร์มือถือ</label>
                                                            <input type="text" class="form-control" id="Input_Text" name="cus_tel" placeholder="ตัวอย่าง : 0910791234" maxlength="10" required>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-sm">
                                                    <div class="mt-2">
                                                        <div>
                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ที่อยู่</label>
                                                            <input type="text" class="form-control" id="Input_Text" name="cus_address" placeholder="ตัวอย่าง : 60/1 หมู่10" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm">
                                                    <div class="mt-2">
                                                        <div>
                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ตำบล</label>
                                                            <input type="text" class="form-control" id="Input_Text" name="cus_address_county" placeholder="ตัวอย่าง : ตำบลวังดิน" required>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-sm">
                                                    <div class="mt-2">
                                                        <div>
                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">อำเภอ</label>
                                                            <input type="text" class="form-control" id="Input_Text" name="cus_address_district" placeholder="ตัวอย่าง : อำเภอเมือง" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm">
                                                    <div class="mt-2">
                                                        <div>
                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">จังหวัด</label>
                                                            <input type="text" class="form-control" id="Input_Text" name="cus_address_district_2" placeholder="ตัวอย่าง : จังหวัดอุตรดิตถ์" required>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-sm">
                                                <div class="mt-2">
                                                    <div>
                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">รหัสไปรษณีย์</label>
                                                        <input type="text" class="form-control" id="Input_Text" name="cus_address_zipcode" placeholder="ตัวอย่าง : 11504" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-2">
                                                <div class="col-md">
                                                    <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">สถานะงาน</label>
                                                    <select id="Input_Hotel" class="form-select" name="emp_select_role" value="<?php echo $row['role'] ?>">
                                                        <option value="emp">พนักงาน</option>
                                                        <option value="admin">แอดมิน</option>
                                                        <option value="mana">ผู้จัดการ</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm">
                                                <div class="mt-2">
                                                    <div>
                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">เงินเดือน</label>
                                                        <input type="text" class="form-control" id="Input_Text" name="cus_salary" placeholder="ตัวอย่าง : 10,000 บาท" required>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                            <button type="sumbit" class="btn btn-primary" name="sumbit_register">สมัครเข้าใช้งาน</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-lg mt-4">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive mt-3">
                            <table id="example" class="table table-striped" style="width:100%">

                                <thead>
                                    <tr>
                                        <th scope="col">รหัสผู้ใช้งาน</th>
                                        <th scope="col">ชื่อ</th>
                                        <th scope="col">นามสกุล</th>
                                        <th scope="col">เบอร์มือถือ</th>
                                        <th scope="col">สถานะ</th>
                                        <th scope="col" class="text-center">รูปภาพ</th>
                                        <th scope="col" class="text-center">เเก้ไขข้อมูลคุณ</th>
                                        <th scope="col" class="text-center">ลบข้อมูล</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    if (isset($_POST['show_all_name_emp'])) {

                                        $query_emp = "SELECT * FROM all_user WHERE (role = 'emp') OR (role = 'admin') OR (role = 'mana')";
                                        $query_run_emp = mysqli_query($conn, $query_emp);

                                        while ($row = mysqli_fetch_assoc($query_run_emp)) {
                                    ?>
                                            <tr>
                                                <td style="padding: 8px;">
                                                    <?php echo $row['code_member'] ?>
                                                </td>
                                                <td style="padding: 8px;"> <?php echo $row['first_name'] ?> </td>
                                                <td style="padding: 8px;"> <?php echo $row['last_name'] ?> </td>
                                                <td style="padding: 8px;">
                                                    <?php

                                                    $all_emp_tel = $row['tel'];

                                                    echo TelFormat($all_emp_tel);
                                                    ?>
                                                </td>
                                                <td style="padding: 8px;">
                                                    <?php
                                                    if (($row['role']) == "emp") {
                                                        echo "พนักงาน";
                                                    } else if (($row['role']) == "admin") {
                                                        echo "เเอดมิน";
                                                    } else {
                                                        echo "ผู้จัดการ";
                                                    }
                                                    ?>
                                                </td>

                                                <td class="text-center" style="padding: 8px;">
                                                    <img src="<?php echo "img/" . $row['img'] ?>" width="50" height="50">
                                                </td>

                                                <td class="text-center" style="padding: 8px;">

                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo $row['id'] ?>">
                                                        <i class="lni lni-highlight-alt"></i>
                                                    </button>

                                                    <div class="modal fade" id="exampleModal_<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">

                                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

                                                                <div class="modal-content">

                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">เเก้ไขข้อมูล คุณ : <?php echo $row['first_name'] . " " . $row['last_name'] ?></h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>

                                                                    <div class="modal-body">

                                                                        <div class="col-lg text-center" id="preview">
                                                                            <img src="<?php echo "img/" . $row['img'] ?>" width="200" height="200">
                                                                        </div>

                                                                        <div class="col-md-12 mt-2">
                                                                            <div class="text-center">
                                                                                <label for="formFile" class="form-label">รูปภาพผู้ใช้งาน</label>
                                                                                <input class="form-control" type="file" name="image_edit" id="image" /><span hidden><?php echo $row['img'] ?></span>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">

                                                                            <div class="col-sm">
                                                                                <div class="mt-2">
                                                                                    <div>
                                                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ชื่อผู้ใช้งาน</label>
                                                                                        <input type="text" class="form-control" id="Input_Text" name="cus_username" placeholder="ตัวอย่าง : thana123" value="<?php echo $row['username'] ?>" disabled>

                                                                                        <input type="hidden" class="form-control" id="Input_Text" name="emp_main_id" value="<?php echo $row['id'] ?>">
                                                                                        <input type="hidden" class="form-control" id="Input_Text" name="emp_main_code_member" value="<?php echo $row['code_member'] ?>">
                                                                                        <input type="hidden" class="form-control" id="Input_Text" name="emp_save_username" value="<?php echo $row['username'] ?>">
                                                                                        <input type="hidden" class="form-control" id="Input_Text" name="emp_save_password" value="<?php echo $row['password'] ?>">
                                                                                        <input type="hidden" class="form-control" id="Input_Text" name="emp_save_img" value="<?php echo $row['img'] ?>">

                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm">
                                                                                <div class="mt-2">
                                                                                    <div>
                                                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">รหัสผ่าน</label>
                                                                                        <input type="password" class="form-control" id="Input_Text" name="cus_password" placeholder="ตัวอย่าง : 1234" value="<?php echo $row['password'] ?>" maxlength="16" disabled>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                        <div class="row">

                                                                            <div class="col-sm">
                                                                                <div class="mt-2">
                                                                                    <div>
                                                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ชื่อ</label>
                                                                                        <input type="text" class="form-control" id="Input_Text" name="cus_first_name" placeholder="ตัวอย่าง : นาย อร่อยมาก" value="<?php echo $row['first_name'] ?>" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm">
                                                                                <div class="mt-2">
                                                                                    <div>
                                                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">นามสกุล</label>
                                                                                        <input type="text" class="form-control" id="Input_Text" name="cus_last_name" placeholder="ตัวอย่าง : หวานหอมอร่อย" value="<?php echo $row['last_name'] ?>" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                        <div class="row">

                                                                            <div class="col-sm">
                                                                                <div class="mt-2">
                                                                                    <div>
                                                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">อีเมล์</label>
                                                                                        <input type="text" class="form-control" id="Input_Text" name="cus_email" placeholder="ตัวอย่าง : user01@gmail.com" value="<?php echo $row['email'] ?>">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm">
                                                                                <div class="mt-2">
                                                                                    <div>
                                                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">เบอร์มือถือ</label>
                                                                                        <input type="text" class="form-control" id="Input_Text" name="cus_tel" placeholder="ตัวอย่าง : 0910791234" value="<?php echo $row['tel'] ?>" maxlength="10" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                        <div class="row">

                                                                            <div class="col-sm">
                                                                                <div class="mt-2">
                                                                                    <div>
                                                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ที่อยู่</label>
                                                                                        <input type="text" class="form-control" id="Input_Text" name="cus_address" placeholder="ตัวอย่าง : 60/1 หมู่10" value="<?php echo $row['address'] ?>" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm">
                                                                                <div class="mt-2">
                                                                                    <div>
                                                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ตำบล</label>
                                                                                        <input type="text" class="form-control" id="Input_Text" name="cus_address_county" placeholder="ตัวอย่าง : ตำบลวังดิน" value="<?php echo $row['address_county'] ?>" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                        <div class="row">

                                                                            <div class="col-sm">
                                                                                <div class="mt-2">
                                                                                    <div>
                                                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">อำเภอ</label>
                                                                                        <input type="text" class="form-control" id="Input_Text" name="cus_address_district" placeholder="ตัวอย่าง : อำเภอเมือง" value="<?php echo $row['address_district'] ?>" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm">
                                                                                <div class="mt-2">
                                                                                    <div>
                                                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">จังหวัด</label>
                                                                                        <input type="text" class="form-control" id="Input_Text" name="cus_address_district_2" placeholder="ตัวอย่าง : จังหวัดอุตรดิตถ์" value="<?php echo $row['address_district2'] ?>" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                        <div class="col-sm">
                                                                            <div class="mt-2">
                                                                                <div>
                                                                                    <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ไปรษณีย์</label>
                                                                                    <input type="text" class="form-control" id="Input_Text" name="cus_address_zipcode" placeholder="ตัวอย่าง : 11504" value="<?php echo $row['address_zipcode'] ?>" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="mt-2">
                                                                            <div class="col-md">
                                                                                <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">สถานะงาน</label>
                                                                                <select id="Input_Hotel" class="form-select" name="emp_select_role" value="">
                                                                                    <option value="<?php echo $row['role'] ?>">....</option>
                                                                                    <option value="emp">พนักงาน</option>
                                                                                    <option value="admin">แอดมิน</option>
                                                                                    <option value="mana">ผู้จัดการ</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm">
                                                                            <div class="mt-2">
                                                                                <div>
                                                                                    <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">เงินเดือน</label>
                                                                                    <input type="text" class="form-control" id="Input_Text" name="cus_salary" placeholder="ตัวอย่าง : 10,000 บาท" value="<?php echo $row['salary'] . " บาท" ?>" required>
                                                                                    <input type="hidden" class="form-control" id="Input_Text" name="cus_salary_2" value="<?php echo $row['salary'] . " บาท" ?>" placeholder="ตัวอย่าง : 11504">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                                                        <button type="submit" class="btn btn-primary" name="change_info_emp" onclick="return confirm('คุณต้องการเเก้ไขข้อมูล?')">เเก้ไขข้อมูล</button>
                                                                    </div>

                                                            </form>

                                                        </div>
                                                    </div>

                                                </td>

                                                <td class="text-center" style="padding: 8px;">
                                                    <a href="del_show_all_emp.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบข้อมูลใช่ใหม ?')"><i class="lni lni-trash-can"></i></a>
                                                </td>

                                            </tr>
                                        <?php
                                        }
                                    } else { ?>

                                        <?php
                                        $query_emp = "SELECT * FROM all_user WHERE (role = 'emp') OR (role = 'admin') OR (role = 'mana')";
                                        $query_run_emp = mysqli_query($conn, $query_emp);

                                        while ($row = mysqli_fetch_assoc($query_run_emp)) {
                                        ?>
                                            <tr>
                                                <td style="padding: 8px;">
                                                    <?php echo $row['code_member'] ?>
                                                </td>

                                                <td style="padding: 8px;">
                                                    <?php echo $row['first_name'] ?>
                                                </td>

                                                <td style="padding: 8px;">
                                                    <?php echo $row['last_name'] ?>
                                                </td>

                                                <td style="padding: 8px;">
                                                    <?php

                                                    $all_emp_tel = $row['tel'];

                                                    echo TelFormat($all_emp_tel);
                                                    ?>
                                                </td>

                                                <td style="padding: 8px;">
                                                    <?php
                                                    if (($row['role']) == "emp") {
                                                        echo "พนักงาน";
                                                    } else if (($row['role']) == "admin") {
                                                        echo "เเอดมิน";
                                                    } else {
                                                        echo "ผู้จัดการ";
                                                    }
                                                    ?>
                                                </td>

                                                <td class="text-center" style="padding: 8px;">
                                                    <img src="<?php echo "img/" . $row['img'] ?>" width="50" height="50">
                                                </td>


                                                <td class="text-center" style="padding: 8px;">

                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo $row['id'] ?>">
                                                        <i class="lni lni-highlight-alt"></i>
                                                    </button>

                                                    <div class="modal fade" id="exampleModal_<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">

                                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">เเก้ไขข้อมูล คุณ : <?php echo $row['first_name'] . " " . $row['last_name'] ?></h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <div class="col-lg text-center" id="preview">
                                                                            <img src="<?php echo "img/" . $row['img'] ?>" width="200" height="200">
                                                                        </div>

                                                                        <div class="col-md-12 mt-2">
                                                                            <div class="text-center">
                                                                                <label for="formFile" class="form-label">รูปภาพผู้ใช้งาน</label>
                                                                                <input class="form-control" type="file" name="image_edit" id="image" /><span hidden><?php echo $row['img'] ?></span>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">

                                                                            <div class="col-sm">
                                                                                <div class="mt-2">
                                                                                    <div>
                                                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ชื่อผู้ใช้งาน</label>
                                                                                        <input type="text" class="form-control" id="Input_Text" name="cus_username" placeholder="ตัวอย่าง : thana123" value="<?php echo $row['username'] ?>" disabled>

                                                                                        <input type="hidden" class="form-control" id="Input_Text" name="emp_main_id" value="<?php echo $row['id'] ?>">
                                                                                        <input type="hidden" class="form-control" id="Input_Text" name="emp_main_code_member" value="<?php echo $row['code_member'] ?>">
                                                                                        <input type="hidden" class="form-control" id="Input_Text" name="emp_save_username" value="<?php echo $row['username'] ?>">
                                                                                        <input type="hidden" class="form-control" id="Input_Text" name="emp_save_password" value="<?php echo $row['password'] ?>">
                                                                                        <input type="hidden" class="form-control" id="Input_Text" name="emp_save_img" value="<?php echo $row['img'] ?>">

                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm">
                                                                                <div class="mt-2">
                                                                                    <div>
                                                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">รหัสผ่าน</label>
                                                                                        <input type="password" class="form-control" id="Input_Text" name="cus_password" placeholder="ตัวอย่าง : 1234" value="<?php echo $row['password'] ?>" maxlength="16" disabled>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                        <div class="row">

                                                                            <div class="col-sm">
                                                                                <div class="mt-2">
                                                                                    <div>
                                                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ชื่อ</label>
                                                                                        <input type="text" class="form-control" id="Input_Text" name="cus_first_name" placeholder="ตัวอย่าง : นาย อร่อยมาก" value="<?php echo $row['first_name'] ?>" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm">
                                                                                <div class="mt-2">
                                                                                    <div>
                                                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">นามสกุล</label>
                                                                                        <input type="text" class="form-control" id="Input_Text" name="cus_last_name" placeholder="ตัวอย่าง : หวานหอมอร่อย" value="<?php echo $row['last_name'] ?>" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                        <div class="row">

                                                                            <div class="col-sm">
                                                                                <div class="mt-2">
                                                                                    <div>
                                                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">อีเมล์</label>
                                                                                        <input type="text" class="form-control" id="Input_Text" name="cus_email" placeholder="ตัวอย่าง : user01@gmail.com" value="<?php echo $row['email'] ?>">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm">
                                                                                <div class="mt-2">
                                                                                    <div>
                                                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">เบอร์มือถือ</label>
                                                                                        <input type="text" class="form-control" id="Input_Text" name="cus_tel" placeholder="ตัวอย่าง : 0910791234" value="<?php echo $row['tel'] ?>" maxlength="10" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                        <div class="row">

                                                                            <div class="col-sm">
                                                                                <div class="mt-2">
                                                                                    <div>
                                                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ที่อยู่</label>
                                                                                        <input type="text" class="form-control" id="Input_Text" name="cus_address" placeholder="ตัวอย่าง : 60/1 หมู่10" value="<?php echo $row['address'] ?>" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm">
                                                                                <div class="mt-2">
                                                                                    <div>
                                                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ตำบล</label>
                                                                                        <input type="text" class="form-control" id="Input_Text" name="cus_address_county" placeholder="ตัวอย่าง : ตำบลวังดิน" value="<?php echo $row['address_county'] ?>" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                        <div class="row">

                                                                            <div class="col-sm">
                                                                                <div class="mt-2">
                                                                                    <div>
                                                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">อำเภอ</label>
                                                                                        <input type="text" class="form-control" id="Input_Text" name="cus_address_district" placeholder="ตัวอย่าง : อำเภอเมือง" value="<?php echo $row['address_district'] ?>" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm">
                                                                                <div class="mt-2">
                                                                                    <div>
                                                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">จังหวัด</label>
                                                                                        <input type="text" class="form-control" id="Input_Text" name="cus_address_district_2" placeholder="ตัวอย่าง : จังหวัดอุตรดิตถ์" value="<?php echo $row['address_district2'] ?>" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                        <div class="col-sm">
                                                                            <div class="mt-2">
                                                                                <div>
                                                                                    <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ไปรษณีย์</label>
                                                                                    <input type="text" class="form-control" id="Input_Text" name="cus_address_zipcode" placeholder="ตัวอย่าง : 11504" value="<?php echo $row['address_zipcode'] ?>" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="mt-2">
                                                                            <div class="col-md">
                                                                                <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">สถานะงาน</label>
                                                                                <select id="Input_Hotel" class="form-select" name="emp_select_role" value="">
                                                                                    <option value="<?php echo $row['role'] ?>">....</option>
                                                                                    <option value="emp">พนักงาน</option>
                                                                                    <option value="admin">แอดมิน</option>
                                                                                    <option value="mana">ผู้จัดการ</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm">
                                                                            <div class="mt-2">
                                                                                <div>
                                                                                    <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">เงินเดือน</label>
                                                                                    <input type="text" class="form-control" id="Input_Text" name="cus_salary" placeholder="ตัวอย่าง : 10,000 บาท" value="<?php echo $row['salary'] . " บาท" ?>" required>
                                                                                    <input type="hidden" class="form-control" id="Input_Text" name="cus_salary_2" value="<?php echo $row['salary'] . " บาท" ?>" placeholder="ตัวอย่าง : 11504">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                                                        <button type="submit" class="btn btn-primary" name="change_info_emp" onclick="return confirm('คุณต้องการเเก้ไขข้อมูล?')">เเก้ไขข้อมูล</button>
                                                                    </div>

                                                            </form>

                                                        </div>
                                                    </div>

                                                </td>

                                                <td class="text-center" style="padding: 8px;">
                                                    <a href="del_show_all_emp.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบข้อมูลใช่ใหม ?')"><i class="lni lni-trash-can"></i></a>
                                                </td>

                                            </tr>
                                        <?php
                                        }
                                        ?>

                                    <?php
                                    }
                                    ?>

                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>



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