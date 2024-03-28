<?php

require_once 'config/db.php';
session_start();

if (isset($_POST['sumbit_register'])) {

    $cus_username = $_POST['cus_username'];
    $cus_password = $_POST['cus_password'];
    $cus_name = $_POST['cus_name'];
    $cus_lastname = $_POST['cus_lastname'];
    $cus_email = $_POST['cus_email'];
    $cus_tel = $_POST['cus_tel'];
    $cus_address = $_POST['cus_address'];
    $cus_address_county = $_POST['cus_address_county'];
    $cus_address_district = $_POST['cus_address_district'];
    $cus_address_district_2 = $_POST['cus_address_district_2'];
    $cus_address_zipcode = $_POST['cus_address_zipcode'];

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
      echo "<script>alert('$name_error'); window.location.href='login_and_register.php';</script>";
    }else if(mysqli_num_rows($res_e) > 0){
      $email_error = "อีเมลนี้มีผู้อื่นใช้ไปเเล้ว"; 	
      echo "<script>alert('$email_error'); window.location.href='login_and_register.php';</script>";
    }else{
        $query_register = "INSERT INTO `all_user` (`id`, `code_member`, `first_name`, `last_name`, `username`, `password`, `email`, `tel`, `img`, `address`, `address_county`, `address_district`, `address_district2`, `address_zipcode`, `role`, `salary`) 
        VALUES (NULL, '$code_member_id_real', '$cus_name', '$cus_lastname', '$cus_username', '$cus_password', '$cus_email', '$cus_tel', 'no-ing.png', '$cus_address', '$cus_address_county', '$cus_address_district', '$cus_address_district_2', '$cus_address_zipcode', 'mem', '0');";
        $query_run = mysqli_query($conn, $query_register);
        if ($query_run) {
            $_SESSION['success'] = "สมัครเข้าใช้งานเสร็จสิ้น";
            $message_nointo =  $_SESSION['success'];
            echo "<script>alert('$message_nointo'); window.location.href='login_and_register.php';</script>";
        } else {
            $_SESSION['error'] = "มีบางอย่างผิดพลาด";
            $message_nointo = $_SESSION['error'];
            echo "<script>alert('$message_nointo'); window.location.href='login_and_register.php';</script>";
        }
    }
    
}

if (isset($_POST['submit_login'])) {

    $cus_username_login = $_POST['cus_username_login'];
    $cus_password_login = $_POST['cus_password_login'];

    try {

        $query = "SELECT * FROM all_user WHERE username ='$cus_username_login' AND password = '$cus_password_login'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);

            $_SESSION['userid'] = $row['id'];
            $_SESSION['code_member'] = $row['code_member'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['role'] = $row['role'];

            $message_nointo = "ลงชื่อเข้าใช้งานเสร็จสิ้น";
            echo "<script>alert('$message_nointo');</script>";
            header("location: index.php");
            
        } else {
            $message_wronguserorpassword = "User หรือ Password ไม่ถูกต้อง";
            echo "<script type='text/javascript'>alert('$message_wronguserorpassword ');</script>";
            header("location: login_and_register.php");
        }
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงชื่อเข้าสู่ระบบ</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="css/cssmain.css">

</head>

<body>

    <div class="container">
        <div class="col-lg">
            <div class="card m-auto" style="width: 400px;">
                <div class="card-body m-auto text-center">

                    <div class="col-md mb-4">
                        <div class="card-header">
                            <h4>ลงชื่อเข้าสู่ระบบ</h4>
                        </div>
                    </div>

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

                        <div class="col-md">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">ชื่อผู้ใช้งาน</span>
                                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="cus_username_login">
                            </div>
                        </div>

                        <div class="col-md">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">รหัสผ่านผู้ใช้งาน</span>
                                <input type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="cus_password_login">
                            </div>
                        </div>

                        <div class="col-md mb-3">
                            <button type="submit" class="btn btn-primary" type="submit" name="submit_login" value="submit">เข้าสู่ระบบ</button>
                        </div>
                    </form>

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

                        <div class="col-lg">

                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                สมัครสมาชิก
                            </button>

                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">สมัครสมาชิก</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row">

                                                <div class="col-sm">
                                                    <div class="mt-2">
                                                        <div>
                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ชื่อผู้ใช้งาน</label>
                                                            <input type="text" class="form-control" id="Input_Text" name="cus_username" placeholder="ตัวอย่าง : thana" required>
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

                                            <div class="mt-2">
                                                <div>
                                                    <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">กรอกรหัสผ่านอีกครั้ง</label>
                                                    <input type="password" class="form-control" id="Input_Text" name="" placeholder="ตัวอย่าง : 1234" maxlength="16" required>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-sm">
                                                    <div class="mt-2">
                                                        <div>
                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ชื่อ</label>
                                                            <input type="text" class="form-control" id="Input_Text" name="cus_name" placeholder="ตัวอย่าง : นาย อร่อยมาก" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm">
                                                    <div class="mt-2">
                                                        <div>
                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">นามสกุล</label>
                                                            <input type="text" class="form-control" id="Input_Text" name="cus_lastname" placeholder="ตัวอย่าง : ธนาบดี" required>
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
                                                            <input type="text" class="form-control" id="Input_Text" name="cus_tel" placeholder="ตัวอย่าง : 0910791234" required>
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
                                                            <input type="text" class="form-control" id="Input_Text" name="cus_address_county" placeholder="ตัวอย่าง : วังดิน" required>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-sm">
                                                    <div class="mt-2">
                                                        <div>
                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">อำเภอ</label>
                                                            <input type="text" class="form-control" id="Input_Text" name="cus_address_district" placeholder="ตัวอย่าง : เมือง" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm">
                                                    <div class="mt-2">
                                                        <div>
                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">จังหวัด</label>
                                                            <input type="text" class="form-control" id="Input_Text" name="cus_address_district_2" placeholder="ตัวอย่าง : อุตรดิตถ์" required>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-sm">
                                                <div class="mt-2">
                                                    <div>
                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">รหัสไปรษณีย์</label>
                                                        <input type="text" class="form-control" id="Input_Text" name="cus_address_zipcode" placeholder="ตัวอย่าง : 53000" required>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                            <button type="sumbit" class="btn btn-primary" name="sumbit_register">สมัครสมาชิก</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>

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