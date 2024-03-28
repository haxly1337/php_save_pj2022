<?php

session_start();

//! Role Transform //
{
    $save_role = $_SESSION['role'];
    // IF ROLE //
    {
        if (($save_role) == "owner") {
            $save_role = "เจ้าของกิจการ";
        }
    }
    // END IF ROLE //
}
//* End Role Transform //


if (!isset($_SESSION['userid'])) {
    header('location: logintoblackend.php');
} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>พนักงาน <?php echo "คุณ : " . $_SESSION['first_name'] ?></title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <link rel="stylesheet" href="css/cssmain.css">

    </head>

    <body>

        <div class="row">
            <div class="col-lg text-center">
                <div class="card w-75 m-auto">
                    <div class="card-body">
                        <h3 class="mt-4"> ยินดีต้อนรับคุณ : <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name'] ?> สถานะ : <?php echo $save_role; ?> </h3>

                        <div class="no-class">
                            <p><a href="info_me.php" target="_blank">ข้อมูลของฉัน</a></p>
                            <p><a href="list_book.php" target="_blank">รายการจองห้องพัก</a></p>
                            <p><a href="show_all_book.php" target="_blank">เเสดงรายชื่อผู้ที่มาพัก</a></p>
                            <p><a href="show_all_emp.php" target="_blank">เเสดงชื่อพนักงานทั้งหมด</a></p>
                            <p><a href="addwalkin.php" target="_blank">เพิ่มลูกค้าเเบบวอล์คอิน</a></p>

                            <div class="mt-2">
                                <p><a href="logout.php">ออกจากระบบ</a></p>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>



    <?php } ?>
    </body>

    </html>