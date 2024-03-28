<?php

include './Template-front/F_Header.php';

?>

<!-- Carousel Start -->
<div class="container-fluid p-0 mb-5">
    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="imge/faikham-1.png" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">Luxury Living</h6>
                        <h1 class="display-3 text-white mb-4 animated slideInDown">Welcome to Faikham Hotel</h1>
                    </div>

                    <br><br><br><br>

                    <!-- Booking Start -->
                    <div class="container-fluid booking pb-5 wow fadeIn w-75" data-wow-delay="0.1s">
                        <div class="container">
                            <div class="bg-white shadow" style="padding: 35px;">

                                <form action="1_select_room.php" method="get" enctype="multipart/form-data">

                                    <div class="row g-2">
                                        <div class="col-md-10">
                                            <div class="row g-2">

                                                <div class="col-md">
                                                    <div class="date" id="date1" data-target-input="nearest">
                                                        <input type="date" name="test_1" class="form-control datetimepicker-input" placeholder="วันเข้าพัก" min="<?php echo date('Y-m-d') ?>" />
                                                    </div>
                                                </div>

                                                <div class="col-md">
                                                    <div class="date" id="date2" data-target-input="nearest">
                                                        <input type="date" name="test_2" class="form-control datetimepicker-input" placeholder="วันที่ออก" min="<?php echo date('Y-m-d') ?>" />
                                                    </div>
                                                </div>

                                                <div class="col-md">
                                                    <select class="form-select" name="test_3">
                                                        <option selected>โรงเเรม</option>
                                                        <option value="1">Faikham Hotel</option>
                                                        <option value="2">Faikham Boutique</option>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>

                                        <?php
                                        if (($show_something_1) == 0) {
                                            echo
                                            '
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#exampleModal_200">
                                                        จองหัองพัก
                                                    </button>
                                                </div>
                                                ';
                                        } else {
                                            echo
                                            '
                                                <div class="col-md-2">
                                                    <button class="btn btn-primary w-100">จองหัองพัก</button>
                                                </div>
                                                ';
                                        }
                                        ?>

                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- Booking End -->

                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- เเจ้งเตือนว่าคุณสมัครสมาชิกเเล้วหรือยัง -->

    <div class="modal fade" id="exampleModal_200" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">กรุณาสมัครสมาชิกเพื่อทำการจอง</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <a href="../beta/login/login.php" class="btn btn-primary">ลงชื่อเข้าใช้ / ลงทะเบียน</a>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <?php
    mysqli_close($conn);
    ?>

    <!-- เเจ้งเตือนว่าคุณสมัครสมาชิกเเล้วหรือยัง -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <h6 class="section-title text-start text-primary text-uppercase"><a name="about">About Us</a></h6>
                    <h1 class="mb-4">Welcome to <span class="text-primary text-uppercase">FAIKHAM</span></h1>
                    <p class="mb-4">โรงแรมฝ้ายคำเชียงใหม่ให้บริการจองห้องพักได้ทั้ง 2 สาขา
                        สาขา 1 ตั้งอยู่ที่ 19/1-4 ถนนสันนาลุง ตำบลวัดเกต อำเภอเมือง จังหวัดเชียงใหม่ 50000
                        สาขา 2 ตั้งอยู่ที่ หมู่ 3 เลขที่ 18 ตำบลสันกลาง อำเภอสันกำแพง จังหวัดเชียงใหม่ 50130
                        ซึ่งทั้ง 2 สาขามีห้องพักที่เปิดให้บริการ จำนวนสาขาละ 50 ห้อง ประกอบด้วยห้องปกติ(Normal) 40 ห้อง และห้องพิเศษ(Deluxe) 10 ห้อง</p>
                    <div class="row g-3 pb-4">
                        <div class="col-sm-4 wow fadeIn" data-wow-delay="0.1s">
                            <div class="border rounded p-1">
                                <div class="border rounded text-center p-4">
                                    <i class="fa fa-hotel fa-2x text-primary mb-2"></i>
                                    <h2 class="mb-1" data-toggle="counter-up">40</h2>
                                    <p class="mb-0">Normal Rooms</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 wow fadeIn" data-wow-delay="0.1s">
                            <div class="border rounded p-1">
                                <div class="border rounded text-center p-4">
                                    <i class="fa fa-hotel fa-2x text-primary mb-2"></i>
                                    <h2 class="mb-1" data-toggle="counter-up">10</h2>
                                    <p class="mb-0">Deluxe Rooms</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <a class="btn btn-primary py-2 px-5 mt-2"></a>
                </div>
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-6 text-end">
                            <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="imge/faikham_hotel/h-4.jpg" style="margin-top: 25%;">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s" src="imge/faikham-2.jpg">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid rounded w-50 wow zoomIn" data-wow-delay="0.5s" src="imge/faikham_hotel/h-3.jpg">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s" src="imge/faikham_hotel/hotel-14.jpg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Newsletter Start -->
    <div class="container newsletter mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="row justify-content-center">
            <div class="col-lg-10 border rounded p-1">
                <div class="border rounded text-center p-1">
                    <div class="bg-white rounded text-center p-5">
                        <h4 class="mb-4">Designed By<span class="text-primary text-uppercase">FAIKHAM</span></h4>
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
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/counterup/counterup.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>

</html>