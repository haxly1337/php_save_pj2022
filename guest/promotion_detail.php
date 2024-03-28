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

<!-- Room Start -->

<div class="container-xxl py-5">
    <div class="container">

        <?php
        $id = $_GET['id'];
        $sql = "SELECT * FROM promotion_data WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $pomotio_name = $row['promotion_name'];
            $pomotio_detail = $row['promotion_detail'];
            $pomotio_img = $row['promotion_img'];
            echo
            '
                    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                        <h1 class="mb-3">Faikham<span class="text-primary text-uppercase">Hotel</span></h1>
                        <h5 class="section-title text-center text-primary text-uppercase">' . $pomotio_name . '"</h6>
                    </div>

                    <div class="col-md text-center">
                        <img src="../img/promotion/' . $pomotio_img . '" class="rounded mb-3" width="500" alt="...">
                        <div class="card mx-auto w-50">
                            <div class="card-body">
                            ' . $pomotio_detail . '
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