<?php

require_once 'config/db.php';
session_start();

//! Sumbit_Promotion //
{

    if (isset($_POST['sumbit_promotion'])) {

        $check_id = "SELECT * FROM news_report_data ORDER BY id DESC LIMIT 1";
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

        $promo_name = $_POST['news_name'];
        $promo_detail = $_POST['news_detail'];

        $promo_img = $_FILES['news_img']['name'];
        $temp_image = $_FILES['news_img']['tmp_name'];
        $targetinto = "img/news/" . $promo_img;

        $query_register = "INSERT INTO `news_report_data` 
            (
            `id`,
            `news_id`,
            `news_name`, 
            `new_detail`, 
            `new_img`) 
        VALUES 
            (
             NULL,
            '$code_member_id_real', 
            '$promo_name', 
            '$promo_detail',
            '$promo_img');";

        $query_run = mysqli_query($conn, $query_register);
        move_uploaded_file($temp_image, $targetinto);

        if ($query_run) {
            $_SESSION['success'] = "ทำการเพิ่มข้อมูลสำเร็จ";
            $message_nointo =  $_SESSION['success'];
            echo "<script>alert('$message_nointo'); window.location.href='news_emp.php';</script>";
        } else {
            $_SESSION['error'] = "เกิดข้อผิดพลางบางอย่าง";
            $message_nointo = $_SESSION['error'];
            echo "<script>alert('$message_nointo'); window.location.href='news_emp.php';</script>";
        }
    }
}

//! END Sumbit_Promotion //

//! Update_Promotion //
{

    if (isset($_POST['sumbit_update_promotion'])) {

        $promo_id = $_POST['news_id'];
        $news_sec_id = $_POST['news_sec_id'];
        $promo_name = $_POST['news_name'];
        $promo_detail = $_POST['news_detail'];

        $promo_img = $_FILES['news_img']['name'];
        $temp_image = $_FILES['news_img']['tmp_name'];
        $targetinto = "img/news/" . $promo_img;

        $query_update = "UPDATE news_report_data SET
        news_id = $news_sec_id,
        news_name = '$promo_name' ,
        new_detail = '$promo_detail' , 
        new_img = '$promo_img'
        WHERE id ='$promo_id'";

        $query_update_run = mysqli_query($conn, $query_update);
        move_uploaded_file($temp_image, $targetinto);

        if ($query_update_run) {
            $_SESSION['success'] = "ทำการเพิ่มข้อมูลสำเร็จ";
            $message_nointo =  $_SESSION['success'];
            echo "<script>alert('$message_nointo'); window.location.href='news_emp.php';</script>";
        } else {
            $_SESSION['error'] = "เกิดข้อผิดพลางบางอย่าง";
            $message_nointo = $_SESSION['error'];
            echo "<script>alert('$message_nointo'); window.location.href='news_emp.php';</script>";
        }
    }
}
//! END Update_Promotion //

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> การจัดการข่าวสาร </title>

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
            background-color: #f0efb3 !important;
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="col-lg">
            <div class="card m-auto mt-3 w-75">
                <div class="card-body">
                    <h5 class="card-title text-center">การจัดการข่าวสาร</h5>
                    <div class="col-lg">

                        <div class="row">

                            <div class="col">
                                <!-- <button type="submit" class="btn btn-success mt-3" name="search">เพิ่มโปรโมชั่น</button> -->
                                <button type="เพิ่มโปรโมชั่น" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    เพิ่มข่าวสาร
                                </button>
                            </div>

                            <div class="col">
                                <a class="btn btn-primary" href="index_backend_emp.php" style="float: right;" role="button">กลับหน้าหลัก</a>
                            </div>
                        </div>


                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">เพิ่มข่าวสาร</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="col-md-12 mt-2">
                                                <div class="text-center">
                                                    <label for="formFile" class="form-label">รูปภาพข่าวสาร</label>
                                                    <input class="form-control" type="file" name="news_img" id="image" value="" />
                                                </div>
                                            </div>

                                            <div class="col-sm">
                                                <div class="mt-2">
                                                    <div>
                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ชื่อข่าวสาร</label>
                                                        <input type="text" class="form-control" id="Input_Text" name="news_name" placeholder="ตัวอย่าง : มีคนต่อยกัน" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm">
                                                <div class="mt-2">
                                                    <div>
                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">รายละเอียด</label>
                                                        <input type="text" class="form-control" id="Input_Text" name="news_detail" placeholder="ตัวอย่าง : มีคนต่อยกัน" required>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                            <button type="sumbit" class="btn btn-primary" name="sumbit_promotion">เพิ่มข่าวสาร</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>



                    </div>

                    <div class="table-responsive mt-3">
                        <table id="example" class="table table-striped" style="width:100%">

                            <thead>
                                <tr>
                                    <th scope="col">ลำดับ</th>
                                    <th scope="col">ชื่อข่าวสาร</th>
                                    <th scope="col">รายละเอียด</th>
                                    <th scope="col">รูปภาพ</th>
                                    <th scope="col">เเก้ไข</th>
                                    <th scope="col">ลบ</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                $pro_conn = "SELECT * FROM `news_report_data`";
                                $pro_query = mysqli_query($conn, $pro_conn);

                                while ($row = mysqli_fetch_assoc($pro_query)) {
                                ?>

                                    <tr>
                                        <td class="px-3 p-0">
                                            <?php
                                            echo $row['id']
                                            ?>
                                        </td>
                                        <td class="px-3 p-0">
                                            <?php
                                            echo $row['news_name']
                                            ?>
                                        </td>
                                        <td class="px-3 p-0">
                                            <?php
                                            echo $row['new_detail']
                                            ?>
                                        </td>
                                        <td class="px-3 p-0">
                                            <img src="img/news/<?php echo $row['new_img'] ?>" alt="Girl in a jacket" width="75" height="75">
                                        </td>
                                        <td class="px-3 p-0">
                                            <button type="submit" class="btn btn-warning" name="cancel_booking" data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo $row['id'] ?>"><i class="lni lni-cut"></i></button>

                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                                                <div class="modal fade" id="exampleModal_<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">เเก้ไขข่าวสาร</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <div class="col-md-12 mt-2">
                                                                    <div class="text-center">
                                                                        <label for="formFile" class="form-label">รูปภาพข่าวสาร</label>
                                                                        <input class="form-control" type="file" name="news_img" id="image" value="" />
                                                                    </div>
                                                                </div>

                                                                <div class="hidden">
                                                                    <input type="hidden" class="forom-control" id="Input_Text" name="news_id" value="<?php echo $row['id'] ?>">
                                                                    <input type="hidden" class="forom-control" id="Input_Text" name="news_sec_id" value="<?php echo $row['news_id'] ?>">
                                                                </div>

                                                                <div class="col-sm">
                                                                    <div class="mt-2">
                                                                        <div>
                                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ชื่อข่าวสาร</label>
                                                                            <input type="text" class="form-control" id="Input_Text" name="news_name" placeholder="ตัวอย่าง : ลด 200 บาทต่อห้อง" required>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm">
                                                                    <div class="mt-2">
                                                                        <div>
                                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">รายละเอียด</label>
                                                                            <input type="text" class="form-control" id="Input_Text" name="news_detail" placeholder="ตัวอย่าง : ต้องจองมากว่า 5 ห้องขึ้นไป" required>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                                                <button type="sumbit" class="btn btn-primary" name="sumbit_update_promotion">เเก้ไขข่าวสาร</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                        </td>
                                        <td class="px-3 p-0">
                                            <a href="del_news_emp.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการยกเลิกการโปรโมชั่นใช่ใหม ?')"><i class="lni lni-trash-can"></i></a>
                                        </td>


                                    </tr>

                                <?php
                                }
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