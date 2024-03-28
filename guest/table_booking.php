<?php

include '../Template-front/F_HeaderNonDOT.php';

if (isset($_POST['addData'])) {
    $ipUserId = $_SESSION['id'];
    $ipRating = $_POST['rating'];
    $ipComment = $_POST['ipComment'];
    $ipBookId = $_POST['ipBookId'];
    $createDates = date('m/d/y h:i:sa');


    $qty_RoomData = "INSERT INTO `review_data`(`rating`, `comment`, `create_time`, `user_id`, `book_id`) VALUES ('$ipRating','$ipComment','$createDates','$ipUserId', '$ipBookId');";
    $resRoom = mysqli_query($conn, $qty_RoomData);
    if ($resRoom) {
        echo "<script>alert('ทำการรีวิวสำเร็จ'); window.location.href='table_booking.php';</script>";
    }
}

?>

<link rel="stylesheet" href=https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css>
<link rel="stylesheet" href="../assets/css/lineicons.css" />
<link rel="stylesheet" href="../assets/css/materialdesignicons.min.css" />
<link rel="stylesheet" href="../assets/css/fullcalendar.css" />

<!-- Header End -->


<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(../img/carousel-1.jpg);">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center m-0">
            <h1 class="display-3 text-white mb-0 animated slideInDown">ตารางการจอง</h1>
        </div>
    </div>
</div>
<!-- Page Header End -->

<div class="container-xxl py-5">
    <div class="container">
        <div class="table-responsive mt-3">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">ลำดับ</th>
                        <th scope="col" class="text-center">รหัสจอง</th>
                        <th scope="col" class="text-center">วันที่เข้าพัก</th>
                        <th scope="col" class="text-center">วันที่ออก</th>
                        <th scope="col" class="text-center">รวมเป็นเงิน</th>
                        <th scope="col" class="text-center">รายละเอียดการจอง</th>
                        <th scope="col" class="text-center">สถานะ</th> <!-- -999 Unsuccess / 1 Confirm / 2 Wait Confirm / 777 Checkout -->
                        <th scope="col" class="text-center">ออกใบเสร็จ</th> <!-- 1 Confirm -->
                        <th scope="col" class="text-center">รีวิว</th> <!-- 777 Checkout -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query_hotel =  "SELECT * FROM `list_order_booking` WHERE user_id = '$save_id' ORDER BY book_id DESC;";
                    $query_run_hotel = mysqli_query($conn, $query_hotel);

                    if (mysqli_num_rows($query_run_hotel) > 0) {
                        $i = 1;
                        foreach ($query_run_hotel as $row) {
                            $status = '<td> </td>';
                            $bill = '<td> </td>';
                            $review = '<td> </td>';

                            $modal_detail = $row['book_id'];

                            if ($row['room_status'] == '-999') {
                                $status = '<td class="text-danger pt-3 text-center"> ถูกยกเลิกการชำระเงิน </td>';
                            } else if ($row['room_status'] == '1') {
                                $status = '<td class="text-success pt-4 text-center"> ยืนยันการชำระเงิน </td>';
                                $bill = '<td class="text-center"> <a href="table_booking_pdf.php?keyword=' . $row['id'] . '" class="btn btn-lg btn-primary"> <i class="lni lni-empty-file"></i> </td>';
                            } else if ($row['room_status'] == '2') {
                                $status = '<td class="text-info pt-4 text-center"> รอยืนยันการชำระเงิน </td>';
                            } else if ($row['room_status'] == '777') {
                                $status = '<td class="text-success text-center pt-4"> ยืนยันการชำระเงิน </td>';
                                $bill = '<td class="text-center"> <a href="table_booking_pdf.php?keyword=' . $row['id'] . '" class="btn btn-lg btn-primary"> <i class="lni lni-empty-file"></i> </td>';
                                $review = '<td class="text-center pt-3"> <button type="button" id="modelAdd" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalAdd" data-bs-bookid="' . $row["book_id"] . '"> <i class="fa fa-comments"></i> </button> </td>';
                            }
    
                            /*
                            printf('  <tr>
                                                    <td class="pt-3"> %s </td>
                                                    <td class="pt-3"> %s </td>
                                                    <td class="pt-3"> %s </td>
                                                    <td class="pt-3"> %s </td>
                                                    <td class="pt-3"> %s </td>
                                                    <td > %s </td>
                                                    %s
                                                    %s
                                                    %s
                                                </tr>
                                            ', $i++, $row['book_id'], $row['checkintime'], $row['checkouttime'], $row['total_price'], '<a href="#" class="btn btn-lg btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal_' . $modal_detail . '"><i class="lni lni-license"></i></a>', $status, $bill, $review);
                            */
                           printf('  <tr>
                                        <td class="pt-4 text-center"> %s </td>
                                        <td class="pt-4 text-center"> %s </td>
                                        <td class="pt-4 text-center"> %s </td>
                                        <td class="pt-4 text-center"> %s </td>
                                        <td class="pt-4 text-center"> %s </td>
                                        <td class="text-center"> %s </td>
                                        %s
                                        %s
                                        %s
                                    </tr>
                                ', $i++, $row['book_id'], $row['checkintime'], $row['checkouttime'], number_format($row['total_price'],2), '<a class="btn btn-lg btn-primary" onclick="loadAndShowModal(\''.$row['book_id'].'\');"><i class="lni lni-license"></i></a>', $status, $bill, $review);
                
                        } 
                    } else {
                        echo '  <tr>
                                                <td colspan="9" class="text-primary text-center h3"> ไม่มีข้อมูลการจองห้องพัก </td>
                                            </tr>
                                        ';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Newsletter Start -->
<div class="container newsletter mt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="row justify-content-center">
        <div class="col-lg-10 border rounded p-1">
            <div class="border rounded text-center p-1">
                <div class="bg-white rounded text-center p-5">
                    <h4 class="mb-4">Designed By<span class="text-primary text-uppercase"> FAIKHAM</span></h4>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Newsletter Start -->


<!-- Footer Start -->
<div class="container-fluid bg-dark text-light footer wow fadeIn">
    <div class="container">
        <div class="copyright">

        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top" style="font-size: 16px;"><i class="bi bi-arrow-up"></i></a>
</div>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../lib/wow/wow.min.js"></script>
<script src="..//easing/easing.min.js"></script>
<script src="../lib/waypoints/waypoints.min.js"></script>
<script src="../lib/counterup/counterup.min.js"></script>
<script src="../lib/owlcarousel/owl.carousel.min.js"></script>
<script src="../lib/tempusdominus/js/moment.min.js"></script>
<script src="..ib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Template Javascript -->
<script src="../js/main.js"></script>
</body>

</html>

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

<div id="contianer_modals"></div>

<div class="modal fade" id="ModalAdd" tabindex="-1" aria-labelledby="ModalAddLabel" aria-hidden="true">
    <form name="frmSearch" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="ModalAddLabel"> รีวิวโรงแรม </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="ipBookId" name="ipBookId">
                    <div class="wow fadeInUp" data-wow-delay="0.1s">
                        <div class="row g-3">

                            <div class="col-md-12">
                                <legend> ให้คะแนนทางโรงเเรม</legend>
                            </div>
                            <div class="col-md-12 mt-0">
                                <div class="form-floating">
                                    <div class="rating">
                                        <input type="radio" name="rating" value="5" id="5"> <label for="5"> ☆ </label>
                                        <input type="radio" name="rating" value="4" id="4"> <label for="4"> ☆ </label>
                                        <input type="radio" name="rating" value="3" id="3"> <label for="3"> ☆ </label>
                                        <input type="radio" name="rating" value="2" id="2"> <label for="2"> ☆ </label>
                                        <input type="radio" name="rating" value="1" id="1"> <label for="1"> ☆ </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea type="text" class="form-control" id="ipComment" placeholder="สิ่งอำนวยความสะดวก" name="ipComment" style="height: 150px"></textarea>
                                    <label for="ipComment">คำอธิบาย</label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> ยกเลิก </button>
                    <button type="submit" class="btn btn-success" name="addData"> ยืนยันการรีวิว </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    var exampleModal = document.getElementById('ModalAdd')
    exampleModal.addEventListener('show.bs.modal', function(event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var BookId = button.getAttribute('data-bs-bookid')
        var mdBookId = exampleModal.querySelector('.modal-body input#ipBookId')
        mdBookId.value = BookId
    });

    function loadAndShowModal(book_id) {
        // ตัวแปรที่ต้องการส่งไปที่ modal
        var post = new Object();
        post.book_id = book_id

        // โหลดข้อมูลไฟล์ modals.php มาที่ contianer_modals และส่งตัวแปรแบบ post ไปให้ด้วย หลังจากโหลดเสร็จ ค่อยสั่งให้ modal แสดงผล
        $('#contianer_modals').load('modals.php', post, function() {
            $("#modal").modal('show');
        });
    }
</script>

<style>
    .rating {
        display: flex;
        flex-direction: row-reverse;
        margin-left: 10px;
        float: left
    }

    .rating>input {
        display: none
    }

    .rating>label {
        position: relative;
        width: 1em;
        font-size: 200%;
        color: #ff0000;
        cursor: pointer
    }

    .rating>label::before {
        content: "\2605";
        position: absolute;
        opacity: 0
    }

    .rating>label:hover:before,
    .rating>label:hover~label:before {
        opacity: 1 !important
    }

    .rating>input:checked~label:before {
        opacity: 1
    }

    .rating:hover>input:checked~label:before {
        opacity: 0.2
    }
</style>