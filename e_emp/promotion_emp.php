<?php

require_once 'config/db.php';
session_start();

//! Sumbit_Promotion //
{

    if (isset($_POST['sumbit_promotion'])) {

        $promo_name = $_POST['promo_name'];
        $promo_detail = $_POST['promo_detail'];
        $promo_text = $_POST['promo_text'];
        $promo_value = $_POST['promo_value'];

        $promo_img = $_FILES['promo_img']['name'];
        $temp_image = $_FILES['promo_img']['tmp_name'];
        $targetinto = "img/promotion/" . $promo_img;

        $query_register = "INSERT INTO `promotion_data` 
            (
            `id`,
            `promotion_name`, 
            `promotion_detail`, 
            `promotion_img`,
            `promotion_code`, 
            `promotion_value`) 
        VALUES 
            (
            NULL, 
            '$promo_name', 
            '$promo_detail',
            '$promo_img',
            '$promo_text', 
            '$promo_value');";

        $query_run = mysqli_query($conn, $query_register);
        move_uploaded_file($temp_image, $targetinto);

        if ($query_run) {
            $_SESSION['success'] = "ทำการเเก้ไขข้อมูลสำเร็จ";
            $message_nointo =  $_SESSION['success'];
            echo "<script>alert('$message_nointo'); window.location.href='promotion_emp.php';</script>";
        } else {
            $_SESSION['error'] = "เกิดข้อผิดพลางบางอย่าง";
            $message_nointo = $_SESSION['error'];
            echo "<script>alert('$message_nointo'); window.location.href='promotion_emp.php';</script>";
        }
    }
}

//! END Sumbit_Promotion //

//! Update_Promotion //
{

    if (isset($_POST['sumbit_update_promotion'])) {


        $promo_id = $_POST['promo_id'];
        $promo_name = $_POST['promo_name'];
        $promo_detail = $_POST['promo_detail'];
        $promo_text = $_POST['promo_text'];
        $promo_value = $_POST['promo_value'];

        $promo_img = $_FILES['promo_img']['name'];
        $temp_image = $_FILES['promo_img']['tmp_name'];
        $targetinto = "img/promotion/" . $promo_img;

        $query_update = "UPDATE promotion_data SET
        promotion_name = '$promo_name',
        promotion_detail = '$promo_detail' ,
        promotion_img = '$promo_img' , 
        promotion_code = '$promo_text' ,
        promotion_value	 = '$promo_value'
        WHERE id ='$promo_id' ";

        $query_update_run = mysqli_query($conn, $query_update);
        move_uploaded_file($temp_image, $targetinto);

        if ($query_update_run) {
            $_SESSION['success'] = "ทำการเเก้ไขข้อมูลสำเร็จ";
            $message_nointo =  $_SESSION['success'];
            echo "<script>alert('$message_nointo'); window.location.href='promotion_emp.php';</script>";
        } else {
            $_SESSION['error'] = "เกิดข้อผิดพลางบางอย่าง";
            $message_nointo = $_SESSION['error'];
            echo "<script>alert('$message_nointo'); window.location.href='promotion_emp.php';</script>";
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
    <title> การจัดการโปรโมชั่น </title>

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
                    <h5 class="card-title text-center">การจัดการโปรโมชั่น</h5>
                    <div class="col-lg">

                        <div class="row">

                            <div class="col">
                                <!-- <button type="submit" class="btn btn-success mt-3" name="search">เพิ่มโปรโมชั่น</button> -->
                                <button type="เพิ่มโปรโมชั่น" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    เพิ่มโปรโมชั่น
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
                                            <h5 class="modal-title" id="exampleModalLabel">เพิ่มโปรโมชั่น</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="col-md-12 mt-2">
                                                <div class="text-center">
                                                    <label for="formFile" class="form-label">รูปภาพเพิ่มโปรโมชั่น</label>
                                                    <input class="form-control" type="file" name="promo_img" id="image" value="" />
                                                </div>
                                            </div>

                                            <div class="col-sm">
                                                <div class="mt-2">
                                                    <div>
                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ชื่อโปรโมชั่น</label>
                                                        <input type="text" class="form-control" id="Input_Text" name="promo_name" placeholder="ตัวอย่าง : ลด 200 บาทต่อห้อง" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm">
                                                <div class="mt-2">
                                                    <div>
                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">รายละเอียด</label>
                                                        <input type="text" class="form-control" id="Input_Text" name="promo_detail" placeholder="ตัวอย่าง : ต้องจองมากว่า 5 ห้องขึ้นไป" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm">
                                                <div class="mt-2">
                                                    <div>
                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">โค้ด ( ตัวหนังสือภาษาอังกฤษ )</label>
                                                        <input type="text" class="form-control" id="Input_Text" name="promo_text" placeholder="ตัวอย่าง : GHASZ1" maxlength="5" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm">
                                                <div class="mt-2">
                                                    <div>
                                                        <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">มูลค่าของโค้ด</label>
                                                        <input type="text" class="form-control" id="Input_Text" name="promo_value" placeholder="ตัวอย่าง : 200 " required>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                            <button type="sumbit" class="btn btn-primary" name="sumbit_promotion">เพิ่มโปรโมชั่น</button>
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
                                    <th scope="col">ชื่อโปรโมชั่น</th>
                                    <th scope="col">รายละเอียด</th>
                                    <th scope="col">รูปภาพ</th>
                                    <th scope="col">โค้ด</th>
                                    <th scope="col">มูลค่า</th>
                                    <th scope="col">เเก้ไข</th>
                                    <th scope="col">ลบ</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                $pro_conn = "SELECT * FROM `promotion_data`";
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
                                            echo $row['promotion_name']
                                            ?>
                                        </td>
                                        <td class="px-3 p-0">
                                            <?php
                                            echo $row['promotion_detail']
                                            ?>
                                        </td>
                                        <td class="px-3 p-0">
                                            <img src="img/promotion/<?php echo $row['promotion_img'] ?>" alt="Girl in a jacket" width="75" height="75">
                                        </td>
                                        <td class="px-3 p-0">
                                            <?php
                                            echo $row['promotion_code']
                                            ?>
                                        </td>
                                        <td class="px-3 p-0">
                                            <?php
                                            echo $row['promotion_value'] . " บาท"
                                            ?>
                                        </td>
                                        <td class="px-3 p-0">
                                            <button type="submit" class="btn btn-warning" name="cancel_booking" data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo $row['id'] ?>"><i class="lni lni-cut"></i></button>

                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                                                <div class="modal fade" id="exampleModal_<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">เเก้ไขโปรโมชั่น</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <div class="col-md-12 mt-2">
                                                                    <div class="text-center">
                                                                        <label for="formFile" class="form-label">รูปภาพเพิ่มโปรโมชั่น</label>
                                                                        <input class="form-control" type="file" name="promo_img" id="image" value="" />
                                                                    </div>
                                                                </div>

                                                                <div class="hidden">
                                                                    <input type="hidden" class="forom-control" id="Input_Text" name="promo_id" value="<?php echo $row['id'] ?>">
                                                                </div>

                                                                <div class="col-sm">
                                                                    <div class="mt-2">
                                                                        <div>
                                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ชื่อโปรโมชั่น</label>
                                                                            <input type="text" class="form-control" id="Input_Text" name="promo_name" placeholder="ตัวอย่าง : ลด 200 บาทต่อห้อง" required>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm">
                                                                    <div class="mt-2">
                                                                        <div>
                                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">รายละเอียด</label>
                                                                            <input type="text" class="form-control" id="Input_Text" name="promo_detail" placeholder="ตัวอย่าง : ต้องจองมากว่า 5 ห้องขึ้นไป" required>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm">
                                                                    <div class="mt-2">
                                                                        <div>
                                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">โค้ด ( ตัวหนังสือภาษาอังกฤษ )</label>
                                                                            <input type="text" class="form-control" id="Input_Text" name="promo_text" placeholder="ตัวอย่าง : GHASZ1" maxlength="5" required>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm">
                                                                    <div class="mt-2">
                                                                        <div>
                                                                            <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">มูลค่าของโค้ด</label>
                                                                            <input type="text" class="form-control" id="Input_Text" name="promo_value" placeholder="ตัวอย่าง : 200 " required>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                                                <button type="sumbit" class="btn btn-primary" name="sumbit_update_promotion">เเก้ไขโปรโมชั่น</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                        </td>
                                        <td class="px-3 p-0">
                                            <a href="del_promotion_emp.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการยกเลิกการโปรโมชั่นใช่ใหม ?')"><i class="lni lni-trash-can"></i></a>
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