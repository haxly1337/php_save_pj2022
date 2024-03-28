<?php

require_once 'config/db.php';
session_start();

// CHECK USER ID //
{
    $check_user_id =  $_SESSION['code_member'];

    $query_info = "SELECT * FROM all_user WHERE code_member = $check_user_id";
    $query_run_info = mysqli_query($conn, $query_info);
    $row = mysqli_fetch_assoc($query_run_info);

    $save_user_id = $row['id'];
    $save_code_member_id = $row['code_member'];
    $save_username = $row['username'];
    $save_password = $row['password'];
    $save_img = $row['img'];
    $save_role = $row['role'];
}
//END CHECK USER ID //

// CHECK NUMBER FORMAT TO DECIMAL
{
    $all_user_salary = $row['salary'];
    $all_user_salary_format = number_format($all_user_salary, 2, ".", ",");
}
// END CHECK NUMBER FORMAT TO DECIMAL

// CHECK IMG //
{
    $check_user_img = $row['img'];

    if (($check_user_img) == "no-img") {
        $check_user_img = "download (1).jpg";
    } else {
        $check_user_id = $row['img'];
    }
}
// END CHECK IMG

{
    if (isset($_POST['change_info_user'])) {

        // $image_edit =  $_POST['image_edit'];
        $cus_first_name = $_POST["cus_first_name"];
        $cus_last_name = $_POST["cus_last_name"];
        $cus_email = $_POST["cus_email"];
        $cus_tel = $_POST["cus_tel"];
        $cus_address = $_POST["cus_address"];
        $cus_address_county = $_POST["cus_address_county"];
        $cus_address_district = $_POST["cus_address_district"];
        $cus_address_district_2 = $_POST["cus_address_district_2"];
        $cus_address_zipcode = $_POST["cus_address_zipcode"];
        $cus_salary = $_POST['cus_salary_2'];

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
            role = '$save_role' , 
            salary = '$cus_salary'
            
            WHERE id ='$save_user_id' ";

            $query_update_run = mysqli_query($conn, $query_update);
            move_uploaded_file($temp_image, $targetinto);

            if ($query_update_run) {
                $_SESSION['success'] = "ทำการเเก้ไขข้อมูลสำเร็จ";
                $message_nointo =  $_SESSION['success'];
                echo "<script>alert('$message_nointo'); window.location.href='info_me.php';</script>";
            } else {
                $_SESSION['error'] = "เกิดข้อผิดพลางบางอย่าง";
                $message_nointo = $_SESSION['error'];
                echo "<script>alert('$message_nointo'); window.location.href='info_me.php';</script>";
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
            role = '$save_role' , 
            salary = '$cus_salary'
            
            WHERE id ='$save_user_id' ";

            $query_update_run = mysqli_query($conn, $query_update);
            move_uploaded_file($temp_image, $targetinto);

            if ($query_update_run) {
                $_SESSION['success'] = "ทำการเเก้ไขข้อมูลสำเร็จ";
                $message_nointo =  $_SESSION['success'];
                echo "<script>alert('$message_nointo'); window.location.href='info_me.php';</script>";
            } else {
                $_SESSION['error'] = "เกิดข้อผิดพลางบางอย่าง";
                $message_nointo = $_SESSION['error'];
                echo "<script>alert('$message_nointo'); window.location.href='info_me.php';</script>";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลของฉันส่วนตัวของฉัน</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="css/cssmain.css">

</head>

<body>

    <div class="container">
        <div class="col-lg">
            <div class="card m-auto w-75">
                <div class="card-body">

                    <div class="col-lg-12 text-center">
                        <h3 class="center pt-3"> ข้อมูลของคุณ : <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name'] ?></h3>
                        <p> รหัสพนักงาน : <?php echo $_SESSION['code_member']; ?> </p>
                    </div>

                    <div class="col-lg text-center">
                        <img src="<?php echo "img/" . $check_user_img ?>" width="200" height="200">
                    </div>

                    <div class="row">

                        <div class="col-sm">
                            <div class="mt-2">
                                <div>
                                    <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ชื่อ</label>
                                    <input type="text" class="form-control" id="Input_Text" name="cus_username" value="<?php echo $row['first_name'] ?>" placeholder="ตัวอย่าง : thana123" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="mt-2">
                                <div>
                                    <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">นามสกุล</label>
                                    <input type="text" class="form-control" id="Input_Text" name="cus_password" value="<?php echo $row['last_name'] ?>" placeholder="ตัวอย่าง : 1234" maxlength="16" disabled>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm">
                            <div class="mt-2">
                                <div>
                                    <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">อีเมล์</label>
                                    <input type="text" class="form-control" id="Input_Text" name="cus_email" value="<?php echo $row['email'] ?>" placeholder="ตัวอย่าง : user01@gmail.com" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="mt-2">
                                <div>
                                    <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">เบอร์มือถือ</label>
                                    <input type="text" class="form-control" id="Input_Text" name="cus_tel" value="<?php echo $row['tel'] ?>" placeholder="ตัวอย่าง : 0910791234" disabled>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm">
                            <div class="mt-2">
                                <div>
                                    <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ที่อยู่</label>
                                    <input type="text" class="form-control" id="Input_Text" name="cus_address" value="<?php echo $row['address'] ?>" placeholder="ตัวอย่าง : 60/1 หมู่10" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="mt-2">
                                <div>
                                    <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ตำบล</label>
                                    <input type="text" class="form-control" id="Input_Text" name="cus_address_county" value="<?php echo $row['address_county'] ?>" placeholder="ตัวอย่าง : ตำบลวังดิน" disabled>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm">
                            <div class="mt-2">
                                <div>
                                    <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">อำเภอ</label>
                                    <input type="text" class="form-control" id="Input_Text" name="cus_address_district" value="<?php echo $row['address_district'] ?>" placeholder="ตัวอย่าง : อำเภอเมือง" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="mt-2">
                                <div>
                                    <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">จังหวัด</label>
                                    <input type="text" class="form-control" id="Input_Text" name="cus_address_district_2" value="<?php echo $row['address_district2'] ?>" placeholder="ตัวอย่าง : จังหวัดอุตรดิตถ์" disabled>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-sm">
                        <div class="mt-2">
                            <div>
                                <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">รหัสไปรษณีย์</label>
                                <input type="text" class="form-control" id="Input_Text" name="cus_address_zipcode" value="<?php echo $row['address_zipcode'] ?>" placeholder="ตัวอย่าง : 11504" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm">
                        <div class="mt-2">
                            <div>
                                <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">เงินเดือน</label>
                                <input type="text" class="form-control" id="Input_Text" name="cus_address_zipcode" value="<?php echo $all_user_salary_format . " บาท" ?>" placeholder="ตัวอย่าง : 11504" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">

                        <div class="col-md">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal" >
                                เเก้ไขข้อมูลส่วนตัว
                            </button>
                        </div>

                        <div class="col-md">
                            <a class="btn btn-primary" href="index_test_showing.php" role="button" style="float: right;">กลับหน้าหลัก</a>
                        </div>


                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">เเก้ไขข้อมูลส่วนตัว</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

                                            <div class="col-lg text-center" id="preview">
                                                <img src="<?php echo "img/" . $check_user_img ?>" width="200" height="200">
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
                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ชื่อ</label>
                                                            <input type="text" class="form-control" id="Input_Text" name="cus_first_name" value="<?php echo $row['first_name'] ?>" placeholder="ตัวอย่าง : ธนาบดี ">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm">
                                                    <div class="mt-2">
                                                        <div>
                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">นามสกุล</label>
                                                            <input type="text" class="form-control" id="Input_Text" name="cus_last_name" value="<?php echo $row['last_name'] ?>" placeholder="ตัวอย่าง : มากมี " maxlength="">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-sm">
                                                    <div class="mt-2">
                                                        <div>
                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">อีเมล์</label>
                                                            <input type="text" class="form-control" id="Input_Text" name="cus_email" value="<?php echo $row['email'] ?>" placeholder="ตัวอย่าง : user01@gmail.com">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm">
                                                    <div class="mt-2">
                                                        <div>
                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">เบอร์มือถือ</label>
                                                            <input type="text" class="form-control" id="Input_Text" name="cus_tel" value="<?php echo $row['tel'] ?>" placeholder="ตัวอย่าง : 0910791234">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-sm">
                                                    <div class="mt-2">
                                                        <div>
                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ที่อยู่</label>
                                                            <input type="text" class="form-control" id="Input_Text" name="cus_address" value="<?php echo $row['address'] ?>" placeholder="ตัวอย่าง : 60/1 หมู่10">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm">
                                                    <div class="mt-2">
                                                        <div>
                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ตำบล</label>
                                                            <input type="text" class="form-control" id="Input_Text" name="cus_address_county" value="<?php echo $row['address_county'] ?>" placeholder="ตัวอย่าง : ตำบลวังดิน">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-sm">
                                                    <div class="mt-2">
                                                        <div>
                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">อำเภอ</label>
                                                            <input type="text" class="form-control" id="Input_Text" name="cus_address_district" value="<?php echo $row['address_district'] ?>" placeholder="ตัวอย่าง : อำเภอเมือง">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm">
                                                    <div class="mt-2">
                                                        <div>
                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">จังหวัด</label>
                                                            <input type="text" class="form-control" id="Input_Text" name="cus_address_district_2" value="<?php echo $row['address_district2'] ?>" placeholder="ตัวอย่าง : จังหวัดอุตรดิตถ์">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-sm">
                                                <div class="mt-2">
                                                    <div>
                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">รหัสไปรษณีย์</label>
                                                        <input type="text" class="form-control" id="Input_Text" name="cus_address_zipcode" value="<?php echo $row['address_zipcode'] ?>" placeholder="ตัวอย่าง : 11504">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm">
                                                <div class="mt-2">
                                                    <div>
                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">เงินเดือน</label>
                                                        <input type="text" class="form-control" id="Input_Text" name="cus_salary" value="<?php echo $all_user_salary_format . " บาท" ?>" placeholder="ตัวอย่าง : 11504" disabled>
                                                        <input type="hidden" class="form-control" id="Input_Text" name="cus_salary_2" value="<?php echo $all_user_salary . " บาท" ?>" placeholder="ตัวอย่าง : 11504">
                                                    </div>
                                                </div>
                                            </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                        <button type="submit" class="btn btn-primary" name="change_info_user" onclick="return confirm('คุณต้องการเเก้ไขข้อมูลใช่ใหม ?')">เเก้ไขข้อมูล</button>
                                    </div>

                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
    </div>



    <!-- ? ---------------------------------- End Script ---------------------------------- -->

    <script>
        function imagePreview(fileInput) {
            if (fileInput.files && fileInput.files[0]) {
                var fileReader = new FileReader();
                fileReader.onload = function(event) {
                    $('#preview').html('<img src="' + event.target.result + '" width="200" height="200"/>');
                };
                fileReader.readAsDataURL(fileInput.files[0]);
            }
        }
        $("#image").change(function() {
            imagePreview(this);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <!-- ? ---------------------------------- End Script ---------------------------------- -->
</body>

</html>