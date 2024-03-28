<?php
$book_id = $_POST['book_id'];
$conn = mysqli_connect("localhost", "root", "", "beta");
$BookingQuery = mysqli_query($conn, "SELECT * FROM `list_order_booking` WHERE `book_id` = '$book_id'");
$dataBooking = mysqli_fetch_array($BookingQuery);

//! All Set to Show
{
    //*1 Room
    {
        if (($dataBooking['room_type']) == 'normal') {
            $show_room = "ห้องขนาดปกติ (Normal)";
            $show_room_p = "790";
        } else {
            $show_room = "ห้องขนาดพิเคษ (Deluxe)";
            $show_room_p = "990";
        }
    }
    //* Hotel_Where
    {
        if (($dataBooking['hotel_where']) == "faikham_boutique") {
            $show_hotel_where = "Faikham Boutique";
        } else {
            $show_hotel_where = "Faikham Hotel";
        }
    }
}
?>

<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="myModalLabel2"> รายละเอียดการจอง </h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="ipBookId" name="ipBookId">
                <div class="wow fadeInUp" data-wow-delay="0.1s">

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="input" id="ipName" name="ipName" value="<?= $show_hotel_where ?>" class="form-control" readonly>
                            <label for="ipName">โรงเเรมที่เข้าพัก </label>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="input" id="ipName" name="ipName" value="<?= $dataBooking['book_id'] ?>" class="form-control" readonly>
                                <label for="ipName">รหัสจอง </label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="input" id="ipName" name="ipName" value="<?= $dataBooking['receipt_no'] ?>" class="form-control" readonly>
                                <label for="ipName">รหัสใบเสร็จ </label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="input" id="ipName" name="ipName" value="<?= $dataBooking['cus_name'] ?>" class="form-control" readonly>
                                <label for="ipName">ชื่อผู้เข้าพัก </label>
                            </div>
                        </div>

                        <div class="col-md">
                            <div class="form-floating">
                                <input type="input" id="ipName" name="ipName" value="<?= $dataBooking['room_day_total'] . " วัน" ?>" class="form-control" readonly>
                                <label for="ipName">จำนวนวันที่จอง </label>
                            </div>
                        </div>

                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="input" id="ipName" name="ipName" value="<?= $dataBooking['checkintime'] ?>" class="form-control" readonly>
                                <label for="ipName">วันที่เช็คอิน </label>
                            </div>
                        </div>

                        <div class="col-md">
                            <div class="form-floating">
                                <input type="input" id="ipName" name="ipName" value="<?= $dataBooking['checkouttime'] ?>" class="form-control" readonly>
                                <label for="ipName">วันที่เช็คเอาท์ </label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="input" id="ipName" name="ipName" value="<?= $show_room ?>" class="form-control" readonly>
                                <label for="ipName">ประเภทห้อง </label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="input" id="ipName" name="ipName" value="<?= $show_room_p . " บาท" ?>" class="form-control" readonly>
                                <label for="ipName">ราคาห้องพัก </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-3">
                        <div class="form-floating">
                            <input type="input" id="ipName" name="ipName" value="<?= number_format($dataBooking['total_price'], 2) . " บาท" ?>" class="form-control" readonly>
                            <label for="ipName">ราคารวมทั้งสิ้น </label>
                        </div>
                    </div>

                    <hr>

                    <div class="col-md-12 mt-3">
                        <div class="form-floating">
                            <a class="btn btn-success" style="width: 100%; height: 100%;" href="/beta/img/<?= $dataBooking['slip_img'] ?>" target="_blank">เเสดงหลักฐานการโอนเงิน</i></a>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="input" id="ipName" name="ipName" value="<?= $dataBooking['receipt_who'] ?>" class="form-control" readonly>
                                <label for="ipName">ชื่อผู้โอนเงิน </label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> ปิด </button>
            </div>

        </div>


    </div>
</div>
</div>