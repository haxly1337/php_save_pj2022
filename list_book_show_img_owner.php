<?php

require_once "config/db.php";

if (isset($_POST['show_new_page_img'])) {

    $raw_img_time = $_POST['raw_img_time'];
    $raw_img_no = $_POST['raw_img_no'];
    $raw_img_who = $_POST['raw_img_who'];
    $raw_img = $_POST['raw_img'];
    $raw_bank_type = $_POST['raw_bank_type'];
    $raw_status_booking = $_POST['raw_status_booking'];
    $raw_cusname = $_POST['raw_cusname'];
    $raw_total_price = $_POST['raw_total_price'];
    $raw_room_day_total = $_POST['raw_room_day_total'];
    $raw_room_type = $_POST['raw_room_type'];

    $save_id_img = $_POST['raw_img'];

    //! Format //
    {
        $raw_img_time = date("d-m-Y H:i:s", strtotime($raw_img_time));

        if (($raw_bank_type) == "1") {
            $raw_bank_type = "ธนาคารกสิกรไทย";
        } else {
            $raw_bank_type = "ธนาคารกรุงเทพ";
        }

        if (($raw_status_booking) == "0") {
            $raw_status_booking = "ยังไม่ได้ชําระเงิน";
        } else {
            $raw_status_booking = "ชําระเงินเเล้ว";
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
    <title>Show Slip</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="css/cssmain.css">

</head>

<body>
    <div class="container">

        <div class="card m-auto w-75">
            <div class="card-body text-center">

                <div class="row">

                    <div class="col-md">
                        <div class="mt-2">
                            <div>
                                <label for="Input_Text" class="form-label" style="font-size: 20px;">เวลาที่ลูกค้าโอนเงิน</label>
                                <input type="Input_Room_Add" class="form-control" id="Input_Text" name="cus_code" placeholder="" value="<?php echo $raw_img_time ?>" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="col-md">
                        <div class="mt-2">
                            <div>
                                <label for="Input_Text" class="form-label" style="font-size: 20px;">รหัสการจอง</label>
                                <input type="Input_Room_Add" class="form-control" id="Input_Text" name="cus_code" placeholder="" value="<?php echo $raw_img_no ?>" disabled>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md">
                        <div class="mt-2">
                            <div>
                                <label for="Input_Text" class="form-label" style="font-size: 20px;">ชื่อผู้โอนเงิน</label>
                                <input type="Input_Room_Add" class="form-control" id="Input_Text" name="cus_code" placeholder="" value="<?php echo $raw_img_who ?>" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="col-md">
                        <div class="mt-2">
                            <div>
                                <label for="Input_Text" class="form-label" style="font-size: 20px;">ธนาคาร</label>
                                <input type="Input_Room_Add" class="form-control" id="Input_Text" name="cus_code" placeholder="" value="<?php echo $raw_bank_type ?>" disabled>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg m-auto w-50">
                    <label for="Input_Text" class="form-label mt-3" style="font-size: 20px;">สถานะยืนยัน</label>
                    <input type="Input_Room_Add" class="form-control" id="Input_Text" name="cus_code" placeholder="" value="<?php echo $raw_status_booking ?>" disabled>
                </div>

                <div class="row">

                    <div class="col-md">
                        <div class="mt-2">
                            <div>
                                <label for="Input_Text" class="form-label" style="font-size: 20px;">ชื่อลูกค้าผู้จอง</label>
                                <input type="Input_Room_Add" class="form-control" id="Input_Text" name="cus_code" placeholder="" value="<?php echo $raw_cusname ?>" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="col-md">
                        <div class="mt-2">
                            <div>
                                <label for="Input_Text" class="form-label" style="font-size: 20px;">ราคารวมทั้งหมด</label>
                                <input type="Input_Room_Add" class="form-control" id="Input_Text" name="cus_code" placeholder="" value="<?php echo $raw_total_price ?>" disabled>
                            </div>
                        </div>
                    </div>

                </div>

                <label for="Input_Text" class="form-label mt-3" style="font-size: 20px;">รูปภาพใบเสร็จ</label>
                <div class="col-lg">
                    <div class="card mt-2">
                        <div class="card-body">
                            <img src="<?php echo "img/Slip/" . $save_id_img ?>" alt="" width="350" height="auto">
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-body m-auto text-center">
                <a href="list_book_owner.php" class="btn btn-primary" target="">กลับ</a>
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