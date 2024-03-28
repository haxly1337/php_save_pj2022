<?php

include '../Template-front/F_HeaderNonDOT.php';

?>
<!-- Header End -->

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(../imge/faikham_hotel.png);">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center pb-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">โปรโมชั่น</h1>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Promotion Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="section-title text-center text-primary text-uppercase">โปรโมชั่น</h1>
            <h6 class="mb-5">โปรโมชั่น<span class="text-primary text-uppercase">สุดคุ้มที่ทำให้การพักผ่อนของคุณประหยัดยิ่งขึ้น</span></h6>
        </div>
        <div class="row g-4">

            <?php
            $sql = "SELECT * FROM promotion_data";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {

                $id = $row['id'];
                $pomotio_name = $row['promotion_name'];
                $pomotio_detail = $row['promotion_detail'];
                $pomotio_img = $row['promotion_img'];

                echo
                '
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">  
                        <div class="room-item shadow rounded overflow-hidden">
                            <div class="position-relative text-center">
                                <img class="img-fluid mt-5" src="../img/promotion/' . $pomotio_img . '" width="50%" alt="">
                            </div>
                            <div class="p-4 mt-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0">' . $pomotio_name . '</h5>
                                </div>
                                <p class="text-body mb-3">' . $pomotio_detail . '</p>
                                <form action="1_select_room.php" method="post" enctype="multipart/form-data">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <a href="promotion_detail.php?id=' . $id . '" class="btn btn-primary">ดูรายละเอียดเพิ่มเติม</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        </div>
                        ';
            }

            ?>

        </div>
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
                        <h5 class="card-title">Promotion</h5>
                        <p class="card-text">โปรโมชั่นสุดคุ้มสำหรับลูกค้าที่มาช่วงเวลาที่กำหนดา</p>
                    </div>
                    <div class="col-md-12">
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="../imge/promotion/promotion-1.jpg" class="d-block w-100" alt="..." height="50%">
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