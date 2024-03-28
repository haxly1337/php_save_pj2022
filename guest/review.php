<?php

include '../Template-front/F_HeaderNonDOT.php';

//! Format Zone //

$ratingData = [0, 0, 0, 0, 0];

$query = mysqli_query($conn, "SELECT AVG(rating) AS AVG_Raiting FROM `review_data`");
$row = mysqli_fetch_array($query);
$Avg_Raiting = $row['AVG_Raiting'];

$query = mysqli_query($conn, "SELECT count(id) AS count_Review FROM  `review_data`");
$row = mysqli_fetch_array($query);
$count_Review = $row['count_Review'];

$rating = mysqli_query($conn, "SELECT rating, count(rating) AS Total FROM review_data GROUP BY rating ORDER BY rating DESC");
while ($row = mysqli_fetch_assoc($rating)) {
    $ratingData[$row['rating'] - 1] = $row['Total'];
}

$comment = mysqli_query($conn, "SELECT `review_data`.*, CONCAT(first_name,' ',last_name) as fullname, `all_user`.`img` FROM `review_data` INNER JOIN `all_user` ON `review_data`.`user_id`=`all_user`.`id` ORDER BY create_time DESC");

?>

<!-- Header End -->



<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(../img/carousel-1.jpg);">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center pb-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">รีวิว</h1>
        </div>
    </div>
</div>
<!-- Page Header End -->
<!-- Service Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title text-center text-primary text-uppercase">รีวิวการใช้บริการโรงแรมจากลูกค้า</h6>
            <h1 class="mb-5">Customer Service <span class="text-primary text-uppercase">Review</span></h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <a class="service-item rounded">
                    <div class="service-icon bg-transparent border rounded p-1">
                        <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                            <i class="fa fa-hotel fa-2x text-primary"></i>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="rating-block">
                            <h5> คะแนนการรีวิว </h5>
                            <h1 class="bold padding-bottom-7"> <?= round($Avg_Raiting, 1); ?> <small>/ 5 </small></h1>
                            <?php
                            $limit = floor($Avg_Raiting);
                            for ($i = 0; $i < $limit; $i++) {
                                echo '  <button type="button" class="btn btn-warning btn-sm" aria-label="justify-content-center">
                                                        <span class="fa fa-star" aria-hidden="true"></span>
                                                    </button>
                                                 ';
                            }

                            for ($i; $i < 5; $i++) {
                                echo '  <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="justify-content-center">
                                                        <span class="fa fa-star" aria-hidden="true"></span>
                                                    </button>
                                                 ';
                            }
                            ?>
                            <h6 class='mt-4'> <?= $count_Review; ?> รีวิว </h6>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-8 col-md-6 w-50" style="margin-top: 9.2rem !important;">
                <h5>Rating breakdown</h5>
                <?php
                for ($i = 4; $i >= 0; $i--) {
                    echo '  <div class="row">
                                            <span class="col-2 text-end" style="margin-top:0.9px;"> <b class="pe-1">' . ($i + 1) . ' </b> <i class="fas fa-star text-warning"> </i> </span>
                                            <div class="progress col mt-1 p-0">
                                                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: ' . (($ratingData[$i] / $count_Review) * 100) . '%"> </div>
                                            </div>
                                            <span class="col-3 mb-0"> ' . $ratingData[$i] . ' </span>
                                        </div>
                                     ';
                }
                ?>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                </div>

                <div class="col-lg-8 col-md-6">
                    <?php
                    while ($row = mysqli_fetch_array($comment)) {
                        if (!file_exists('../img/' . $row['img'])) {
                            $row['img'] = 'no-ing.png';
                        }
                        $star = '';
                        for ($i = 0; $i < $row['rating']; $i++) {
                            $star .= '<i class="fa fa-star"> </i>';
                        }
                        echo '  <div class="row"> 
                                                <div class="col-1">
                                                    <img src="../img/' . $row['img'] . '" class="avatar">
                                                </div>

                                                <div class="col-11">
                                                    <h5> ' . $row['fullname'] . ' </h5>
                                                    <span class="mt-0"> <span style="font-size:16px; color:red;"> ' . $star . ' </span> | <span class="text-muted" style="font-size:10px;"> ' . $row['create_time'] . ' </span>
                                                    <div class="mt-3 ps-3"> ' . $row['comment'] . ' </div>
                                                </div>
                                            </div>
                                            <hr style="margin:0; margin-top: 0.5em; margin-bottom: 1.5em;">
                                        ';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->

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

<style>
    .avatar {
        vertical-align: middle;
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }
</style>