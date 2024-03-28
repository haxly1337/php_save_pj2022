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
    if (isset($_POST['addcuswalkin'])) {

        $code_member = $_SESSION['code_member'];
        $checkintime = $_POST['checkintime'];
        $checkouttime = $_POST['checkouttime'];
        $frist_name = $_POST['frist_name'];
        $last_name = $_POST['last_name'];
        $tel_cus = $_POST['tel_cus'];
        $email_cus = $_POST['email_cus'];
        $hotel_where = $_POST['hotel_where'];
        $room_type = $_POST['room_where'];
        $amount_room = $_POST['amount_room'];
        $cus_detail = $_POST['cus_detail'];
        $cus_code = $_POST['cus_code'];

        $format_to_fullname = $frist_name . " " . $last_name;

        $image_cus = $_FILES['image']['name'];
        $temp_image = $_FILES['image']['tmp_name'];
        $targetinto = "img/" . $image_cus;

        if (($_POST['hotel_where']) == "noselect") {
            $message_no = "กรุณาเลือกโรงเเรม";
            echo "<script>alert('$message_no'); window.location.href='addwalkin_mana.php';</script>";
            exit;
        } else {

            //! GENERATOR ZONE //
            {
                $get_step_1 = "WKIN-"; // GT = Guest && WKIN = Walkin

                if (($_POST['hotel_where']) == "faikham_hotel") {
                    // if (($hotel_where) == "faikham_hotel") {
                    $save_step_1_5 = "FH-";
                } else if (($_POST['hotel_where']) == "faikham_boutique") {
                    $save_step_1_5 = "FB-";
                } else {
                    $save_step_1_5 = "ER-";
                }

                $get_step_2 = date('Ymd');

                if (($room_type) == "normal") {
                    $save_step_3 = "-N"; // ห้องปกติ
                } else if (($room_type) == "deluxe_room") {
                    $save_step_3 = "-DX"; // ห้องพิเศษ
                } else {
                    $save_step_3 = "-ERORR";
                }

                $get_step_final = "$get_step_1" . "$save_step_1_5" . "$get_step_2" . "$save_step_3";

                // CHECK_ID //
                {
                    $check_id = "SELECT * FROM customer_data ORDER BY id DESC LIMIT 1";
                    $check_result = mysqli_query($conn, $check_id);

                    if (mysqli_num_rows($check_result) > 0) {
                        if ($row = mysqli_fetch_assoc($check_result)) { {

                                $book_id = $row['id'];
                                $get_number = str_replace("", "", $book_id);
                                $id_inc = $get_number + 1;
                                $get_string = str_pad($id_inc, 5, 0, STR_PAD_LEFT);
                                $book_id_real =  $get_step_final . $get_string;
                            }
                        }
                    }
                }
                // END CHECK_ID //

            }
            //! END GENERATOR ZONE //

            $query = "INSERT INTO `customer_data` (`id`, 
            `book_id`,
            `code_member`,
            `checkintime`,
            `checkouttime`,
            `cus_name`,
            `tel_cus`,
            `email_cus`,
            `hotel_where`,
            `room_type`,
            `amount_room`,
            `cus_detail`,
            `image_cus`,
            `promotion_code`) 
            VALUES (NULL, 
            '$book_id_real',
            '$code_member',
            '$checkintime',
            '$checkouttime',
            '$format_to_fullname',
            '$tel_cus',
            '$email_cus',
            '$hotel_where',
            '$room_type',
            '$amount_room',
            '$cus_detail',
            '$image_cus',
            '$cus_code');";

            $result = mysqli_query($conn, $query);
            move_uploaded_file($temp_image, $targetinto);

            if ($result) {
                $_SESSION['success'] = "เพิ่มข้อมูลเสร็จสิ้น";
                $message_nointo = "เพิ่มข้อมูลเสร็จสิ้น";
                echo "<script>alert('$message_nointo'); window.location.href='addwalkin_mana.php';</script>";
            } else {
                $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                $message_nointo = "มีบางอย่างผิดพลาด";
                echo "<script>alert('$message_nointo'); window.location.href='addwalkin_mana.php';</script>";
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
        <title>( เพิ่มลูกค้าเเบบ Walkin ) พนักงาน <?php echo "คุณ : " . $_SESSION['name'] ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="css/cssmain.css">
        <script src="http://code.jquery.com/jquery-latest.js"></script>
    </head>

    <body>

        <div class="container">
            <div class="card">
                <div class="card-body">

                    <div class="col-lg-12 text-center">
                        <h4 class="center pt-3"> จองห้องพักลูกค้าเเบบวอล์คอิน ( สำหรับพนักงาน )</h4>
                        <p class="mt-1 mb-0" style="font-size: 18px;">รหัสพนักงาน : <?php echo $_SESSION['code_member']; ?></p>
                        <p class="mt-0" style="font-size: 18px;"> คุณ : <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name'] ?></p>
                    </div>

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" class="w-75 m-auto">
                        <!-- <form action="add_cus_walkin.php" method="POST" enctype="multipart/form-data"> -->

                        <!-- Slot 1 -->
                        <div class="mt-2">
                            <div class="row">
                                <div class="col-md -6">
                                    <label for="birthday" class="form-label">วันที่เข้าพัก</label>
                                    <input type="date" class="form-control" id="birthday" name="checkintime" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="birthday" class="form-label">วันที่ออก</label>
                                    <input type="date" class="form-control" id="birthday2" name="checkouttime" required>
                                </div>
                            </div>
                        </div>
                        <!-- Slot 1 -->

                        <!-- Slot 2 -->
                        <div class="mt-2">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Input_Text" class="form-label">ชื่อผู้เข้าพัก</label>
                                    <input type="" class="form-control" id="Input_Text" name="frist_name" aria-describedby="" placeholder="ตัวอย่าง : นาย ธนาบดี" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="Input_Text" class="form-label">นามสกุล</label>
                                    <input type="" class="form-control" id="Input_Text1" name="last_name" aria-describedby="" placeholder="ตัวอย่าง : เกียรติรู่งวิไลกุล" required>
                                </div>
                            </div>
                        </div>
                        <!-- Slot 2 -->

                        <!-- Slot 3 -->
                        <div class="mt-2">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Input_Text" class="form-label">เบอร์ติดต่อ</label>
                                    <input type="" class="form-control" id="Input_Text2" name="tel_cus" aria-describedby="" placeholder="ตัวอย่าง : 012-345-4567" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="Input_Text" class="form-label">อีเมล์</label>
                                    <input type="" class="form-control" id="Input_Text3" name="email_cus" aria-describedby="" placeholder="ตัวอย่าง : simple@gmail.com">
                                </div>
                            </div>
                        </div>
                        <!-- Slot 3 -->

                        <!-- Slot 4 -->
                        <div class="mt-2">
                            <div class="col-md-12">
                                <label for="Input_Hotel" class="form-label">โรงเเรม</label>
                                <select id="Input_Hotel" class="form-select" name="hotel_where" value="">
                                    <option value="0">..</option>
                                    <option value="faikham_hotel">Faikham Hotel</option>
                                    <option value="faikham_boutique">Faikham Boutique</option>
                                </select>
                            </div>
                        </div>
                        <!-- Slot 4 -->

                        <!-- Slot 5 -->
                        <div class="mt-2">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Input_Room" class="form-label">ประเภทห้องพัก</label>
                                    <select id="Input_Room" class="form-select" name="room_where" value="normal">
                                        <option value="normal">Normal ( ห้องปกติ )</option>
                                        <option value="deluxe_room">Deluxe Room ( ห้องดีลักซ์ )</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="Input_Text" class="form-label">จำนวนห้องพัก</label>
                                    <input type="number" class="form-control" id="Input_Text4" min="0" max="10" name="amount_room" placeholder="ตัวอย่าง : 1" maxlength="2">
                                </div>
                            </div>
                        </div>
                        <!-- Slot 5 -->

                        <!-- Slot 6 -->
                        <div class="mt-2">
                            <div>
                                <label for="Input_Text" class="form-label">เพิ่มเติม</label>
                                <input type="Input_Room_Add" class="form-control" id="Input_Text5" name="cus_detail" placeholder="ตัวอย่าง : หมอก 10 อัน">
                            </div>
                        </div>

                        <!-- Slot 7 -->
                        <div class="mt-2">
                            <div>
                                <label for="Input_Text" class="form-label">รหัสส่วนลด</label>
                                <input type="Input_Room_Add" class="form-control" id="Input_Text6" name="cus_code" placeholder="ตัวอย่าง : GA0123 *ถ้าไม่มีก็ไม่ต้องใส่*" maxlength="5">
                            </div>
                        </div>
                        <!-- Slot 7 -->

                        <!-- Slot 8 -->
                        <div class="col-md-12 mt-3">
                            <div class="text-center">
                                <label for="formFile" class="form-label">รูปภาพใบเสร็จ</label>
                                <input class="form-control" type="file" name="image" id="image" required>
                                <div class="card mt-3">
                                    <div class="card-body" style="height: 375px;">
                                        <p class="card-title">ที่เเสดงรูปภาพ</p>
                                        <div id="preview">

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Slot 8 -->

                        <div class="col">
                            <div class="m-auto text-center">
                                <button type="submit" class="btn btn-primary mt-3 px-5" name="addcuswalkin" onclick="return confirm('คุณต้องการที่จะเพิ่มลูกค้าวอล์คอินใช่ใหม ?')">เพิ่มข้อมูล</button>
                            </div>
                        </div>

                    </form>

                    <div class="col-md m-auto w-75">
                        <button type="submit" class="btn btn-danger mt-3 ms-3" name="clean" onclick="ClearFields();">เคลียร์ข้อความ</button>
                        <a class="btn btn-primary mt-3" href="index_backend_manager.php" role="button" style="float:right">กลับหน้าหลัก</a>
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
            function ClearFields() {
                document.getElementById("birthday").value = "";
                document.getElementById("birthday2").value = "";
                document.getElementById("Input_Text").value = "";
                document.getElementById("Input_Text1").value = "";
                document.getElementById("Input_Text2").value = "";
                document.getElementById("Input_Text3").value = "";
                document.getElementById("Input_Text4").value = "";
                document.getElementById("Input_Text5").value = "";
                document.getElementById("Input_Text6").value = "";
                document.getElementById("image").value = "";
            }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        <!-- End Script-->
    <?php } ?>
    </body>

    </html>