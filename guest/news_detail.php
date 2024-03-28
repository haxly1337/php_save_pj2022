<?php

include '../Template-front/F_HeaderNonDOT.php';

?>
<!-- Header End -->

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(../imge/faikham_hotel.png);">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center pb-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">ข่าวประชาสัมพันธ์</h1>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Room Start -->
<div class="container-xxl py-5">
    <div class="container">

        <?php
        $id = $_GET['id'];
        $sql = "SELECT * FROM news_report_data WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $newname = $row['news_name'];
            $new_detail = $row['new_detail'];
            $new_img = $row['new_img'];
            echo
            '
                    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                        <h1 class="mb-3">Faikham<span class="text-primary text-uppercase">Hotel</span></h1>
                        <h5 class="section-title text-center text-primary text-uppercase">' . $newname . '"</h6>
                    </div>

                    <div class="col-md text-center">
                        <img src="../img/news/' . $new_img . '" class="rounded mb-3" width="500" alt="...">
                        <div class="card mx-auto w-50">
                            <div class="card-body">
                            ' . $new_detail . '
                            </div>
                        </div>
                    </div>

                    <div class="col-md">
                        <div class="mt-5 text-center">
                            <a href="../index.php" class="btn btn-primary">กลับหน้าหลัก</a>
                        </div>
                    </div>
                    ';
        }
        ?>

    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Details News Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">News Post</h5>
                        <p class="card-text">รูปภาพรายละเอียดภายในห้องพักแบบปกติ(Normal)</p>
                        <p class="card-text"><small class="text-muted">สิ่งอำนวยความสะดวก : เตียงเดี่ยวขนาดมาตราฐาน,ตู้เย็น,ทีวี,เครื่องปรับอากาศ,อุปรกรณ์อาบน้ำ,เครื่องน้ำอุ่น,WIFIฟรี</small></p>
                    </div>
                    <div class="col-md-12">
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="imge/promotion/promotion-1.jpg" class="d-block w-100" alt="..." height="50%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Room End -->


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