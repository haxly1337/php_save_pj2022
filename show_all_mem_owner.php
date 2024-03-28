<?php

// require_once 'config/db.php';
// session_start();

// function TelFormat($mobile)
// {
//     $minus_sign = "-";   // กำหนดเครื่องหมาย 
//     $part1 = substr($mobile, 0, -7);  // เริ่มจากซ้ายตัวที่ 1 ( 0 ) ตัดทิ้งขวาทิ้ง 7 ตัวอักษร ได้ 085 
//     $part2 = substr($mobile, 3, -3);  // เริ่มจากซ้าย ตัวที่ 4 (9) ตัดทิ้งขวาทิ้ง 3 ตัวอักษร ได้ 9490 
//     $part3 = substr($mobile, 7); // เริ่มจากซ้าย ตัวที่ 8 (8) ไม่ตัดขวาทิ้ง ได้ 862  
//     $a = $part1 . $minus_sign . $part2 . $minus_sign . $part3;
//     return $a;
// }

// if (isset($_POST['sumbit_register'])) {

//     $cus_username = $_POST['cus_username'];
//     $cus_password = $_POST['cus_password'];
//     $cus_name = $_POST['cus_name'];
//     $cus_lastname = $_POST['cus_lastname'];
//     $cus_email = $_POST['cus_email'];
//     $cus_tel = $_POST['cus_tel'];
//     $cus_address = $_POST['cus_address'];
//     $cus_address_county = $_POST['cus_address_county'];
//     $cus_address_district = $_POST['cus_address_district'];
//     $cus_address_district_2 = $_POST['cus_address_district_2'];
//     $cus_address_zipcode = $_POST['cus_address_zipcode'];

//     $check_id = "SELECT * FROM all_user ORDER BY id DESC LIMIT 1";
//     $check_result = mysqli_query($conn, $check_id);

//     if (mysqli_num_rows($check_result) > 0) {
//         if ($row = mysqli_fetch_assoc($check_result)) { {

//                 $code_member_id = $row['id'];
//                 $get_number = str_replace("", "", $code_member_id);
//                 $id_inc = $get_number + 1;
//                 $get_string = str_pad($id_inc, 5, 0, STR_PAD_LEFT);
//                 $code_member_id_real = $get_string;
//             }
//         }
//     }

//     $sql_u = "SELECT * FROM all_user WHERE username='$cus_username'";
//     $sql_e = "SELECT * FROM all_user WHERE email='$cus_email'";
//     $res_u = mysqli_query($conn, $sql_u);
//     $res_e = mysqli_query($conn, $sql_e);

//     if (mysqli_num_rows($res_u) > 0) {
//         $name_error = "ชื่อผู้ใช้งานนี้มีผู้อื่นใช้ไปเเล้ว";
//         echo "<script>alert('$name_error'); window.location.href='show_all_mem_owner.php';</script>";
//     } else if (mysqli_num_rows($res_e) > 0) {
//         $email_error = "อีเมลนี้มีผู้อื่นใช้ไปเเล้ว";
//         echo "<script>alert('$email_error'); window.location.href='show_all_mem_owner.php';</script>";
//     } else {
//         $query_register = "INSERT INTO `all_user` (`id`, `code_member`, `first_name`, `last_name`, `username`, `password`, `email`, `tel`, `img`, `address`, `address_county`, `address_district`, `address_district2`, `address_zipcode`, `role`, `salary`) 
//         VALUES (NULL, '$code_member_id_real', '$cus_name', '$cus_lastname', '$cus_username', ' $cus_password', '$cus_email', '$cus_tel', 'no-img', '$cus_address', '$cus_address_county', '$cus_address_district', '$cus_address_district_2', '$cus_address_zipcode', '$emp_select_role', '$emp_salary');";
//         $query_run = mysqli_query($conn, $query_register);
//         if ($query_run) {
//             $_SESSION['success'] = "สมัครเข้าใช้งานเสร็จสิ้น";
//             $message_nointo =  $_SESSION['success'];
//             echo "<script>alert('$message_nointo'); window.location.href='show_all_mem_owner.php';</script>";
//         } else {
//             $_SESSION['error'] = "มีบางอย่างผิดพลาด";
//             $message_nointo = $_SESSION['error'];
//             echo "<script>alert('$message_nointo'); window.location.href='show_all_mem_owner.php';</script>";
//         }
//     }
// }

// //! ROW Share //
// {
//     $check_user_id =  $_SESSION['code_member'];

//     $query_info = "SELECT * FROM all_user WHERE code_member = $check_user_id";
//     $query_run_info = mysqli_query($conn, $query_info);
//     $row = mysqli_fetch_assoc($query_run_info);
// }
// //! END ROW Share //

// {
//     if (isset($_POST['change_info_emp'])) {

//         $save_user_id = $_POST['emp_main_id'];
//         $save_code_member_id = $_POST['emp_main_code_member'];
//         $save_username = $_POST['emp_save_username'];
//         $save_password = $_POST['emp_save_password'];
//         $save_img = $_POST['emp_save_img'];

//         $cus_first_name = $_POST["cus_first_name"];
//         $cus_last_name = $_POST["cus_last_name"];
//         $cus_email = $_POST["cus_email"];
//         $cus_tel = $_POST["cus_tel"];
//         $cus_address = $_POST["cus_address"];
//         $cus_address_county = $_POST["cus_address_county"];
//         $cus_address_district = $_POST["cus_address_district"];
//         $cus_address_district_2 = $_POST["cus_address_district_2"];
//         $cus_address_zipcode = $_POST["cus_address_zipcode"];

//         $query_update = "UPDATE all_user SET
//                         code_member = '$save_code_member_id',
//                         first_name = '$cus_first_name' ,
//                         last_name = '$cus_last_name' , 
//                         username = '$save_username' ,
//                         password = '$save_password' ,
//                         email = '$cus_email' ,
//                         tel = '$cus_tel' ,
//                         img = '$save_img' ,
//                         address = '$cus_address'  ,
//                         address_county = '$cus_address_county'  ,
//                         address_district = '$cus_address_district'  ,
//                         address_district2 = '$cus_address_district_2'  ,
//                         address_zipcode = '$cus_address_zipcode' ,
//                         role = 'mem' , 
//                         salary = '0'

//                         WHERE id ='$save_user_id' ";

//         $query_update_run = mysqli_query($conn, $query_update);
//         if ($query_update_run) {
//             $_SESSION['success'] = "เเก้ไขข้อมูลเสร็จสิ้น";
//             $message_nointo =  $_SESSION['success'];
//             echo "<script>alert('$message_nointo'); window.location.href='show_all_mem_owner.php';</script>";
//         } else {
//             $_SESSION['error'] = "เกิดข้อผิดพลางบางอย่าง";
//             $message_nointo = $_SESSION['error'];
//             echo "<script>alert('$message_nointo'); window.location.href='show_all_mem_owner.php';</script>";
//         }
//     }
// }

// // CHECK NUMBER FORMAT TO DECIMAL
// {
//     $all_user_salary = $row['salary'];
//     $all_user_salary_format = number_format($all_user_salary, 2, ".", ",");
// }
// // END CHECK NUMBER FORMAT TO DECIMAL

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลสมาชิก </title>

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->

    <!-- <link rel="stylesheet" href="css/cssmain.css"> -->

</head>

<body>

    <div class="container">
        <div class="col-lg">
            <div class="card">
                <div class="card-body">

                    <!-- <div class="col-lg text-center">
                        <h4>เเสดงชื่อสมาชิกทั้งหมด</h4>
                    </div> -->

                    <div class="row">

                        <div class="col-md">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm text-end">
                                        <button type="submit" class="btn btn-success" name="show_all_name_emp" id="">เเสดงชื่อสมาชิกทั้งหมด</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- <div class="col-md m-auto">
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal" style="float: right;">
                                    เพิ่มพนักงาน
                                </button>
                            </div> -->

                    </div>

                    <div class="col-lg mt-4">
                        <div class="table-responsive mt-3">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">รหัสผ่านผู้ใช้งาน</th>
                                        <th scope="col">ชื่อ</th>
                                        <th scope="col">นามสกุล</th>
                                        <th scope="col">เบอร์มือถือ</th>
                                        <th scope="col">สถานะ</th>
                                        <th scope="col">เเก้ไข</th>
                                        <th scope="col" style="text-align: center;">ลบข้อมูล</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if (isset($_POST['show_all_name_emp'])) {

                                        $query_emp = "SELECT * FROM all_user WHERE (role = 'mem')";
                                        $query_run_emp = mysqli_query($conn, $query_emp);

                                        while ($row = mysqli_fetch_assoc($query_run_emp)) {
                                    ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row['code_member'] ?>
                                                </td>
                                                <td> <?php echo $row['first_name'] ?> </td>
                                                <td> <?php echo $row['last_name'] ?> </td>
                                                <td>
                                                    <?php

                                                    $all_emp_tel = $row['tel'];

                                                    echo TelFormat($all_emp_tel);
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (($row['role']) == "mem") {
                                                        echo "สมาชิก";
                                                    }
                                                    ?>
                                                </td>
                                                <td>

                                                    <!-- <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo $row['id'] ?>">
                                                    เเก้ไขข้อมูลคุณ
                                                </button> -->

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
                                                                            <img src="<?php echo "../img/" . $row['img'] ?>" width="200" height="200">
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
                                                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ชื่อจริงของผู้ใช้งาน</label>
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
                                                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">อีเมลของผู้ใช้งาน</label>
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
                                                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ตำบล</label>
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

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                                                        <button type="submit" class="btn btn-primary" name="change_info_emp">เเก้ไขข้อมูล</button>
                                                                    </div>

                                                            </form>

                                                        </div>
                                                    </div>

                                                </td>

                                                <td class="text-center" style="padding: 8px;">
                                                    <!-- <a href="del_show_all_mem_owner.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบข้อมูลใช่ใหม ?')">ลบข้อมูล</a> -->
                                                    <a href="del_show_all_mem.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบข้อมูลใช่ใหม ?')"><i class="lni lni-trash-can"></i></a>
                                                </td>


                                            </tr>
                                        <?php
                                        }
                                    } else { ?>

                                        <?php

                                        $query_emp = "SELECT * FROM all_user WHERE (role = 'mem')";
                                        $query_run_emp = mysqli_query($conn, $query_emp);

                                        while ($row = mysqli_fetch_assoc($query_run_emp)) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row['code_member'] ?>
                                                </td>
                                                <td> <?php echo $row['first_name'] ?> </td>
                                                <td> <?php echo $row['last_name'] ?> </td>
                                                <td>
                                                    <?php

                                                    $all_emp_tel = $row['tel'];

                                                    echo TelFormat($all_emp_tel);
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (($row['role']) == "mem") {
                                                        echo "สมาชิก";
                                                    }
                                                    ?>
                                                </td>
                                                <td>

                                                    <!-- <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo $row['id'] ?>">
                                                    เเก้ไขข้อมูลคุณ
                                                </button> -->

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
                                                                            <img src="<?php echo "../img/" . $row['img'] ?>" width="200" height="200">
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
                                                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ชื่อจริงของผู้ใช้งาน</label>
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
                                                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">อีเมลของผู้ใช้งาน</label>
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
                                                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ตำบล</label>
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

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                                                        <button type="submit" class="btn btn-primary" name="change_info_emp">เเก้ไขข้อมูล</button>
                                                                    </div>

                                                            </form>

                                                        </div>
                                                    </div>

                                                </td>
                                                <td class="text-center" style="padding: 8px;">
                                                    <!-- <a href="del_show_all_mem_owner.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบข้อมูลใช่ใหม ?')">ลบข้อมูล</a> -->

                                                    <a href="del_show_all_mem.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบข้อมูลใช่ใหม ?')"><i class="lni lni-trash-can"></i></a>
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




            <!-- ? ---------------------------------- End Script ---------------------------------- -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
            <!-- ? ---------------------------------- End Script ---------------------------------- -->
</body>

</html>