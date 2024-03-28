<?php

include '../Template-front/F_HeaderNonDOT.php';

?>
        <!-- Header End -->

        <!-- Page Header Start -->
        <div class="container-fluid page-header mb-5 p-0" style="background-image: url(../imge/faikham_hotel.png);">
            <div class="container-fluid page-header-inner py-5">
                <div class="container text-center pb-5">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">ห้องพัก</h1>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Room Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">Our Rooms</h6>
                    <h1 class="mb-5">Explore Our <span class="text-primary text-uppercase">Rooms</span></h1>
                </div>

                <div class="row g-4">

                    <div class="col-lg-6 col-md-6  wow fadeInUp" data-wow-delay="0.1s">
                        <div class="room-item shadow rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="../imge/rh-3.jpg" alt="">
                                <small class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">$790/Night</small>
                            </div>
                            <div class="p-4 mt-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0">ห้องพักปกติ(Normal)</h5>
                                </div>
                                <div class="d-flex mb-3">
                                    <!-- <small class="border-end me-3 pe-3"><i class="fa fa-bed text-primary me-2"></i>1 Bed</small>
                                    <small class="border-end me-3 pe-3"><i class="fa fa-bath text-primary me-2"></i>1 Bath</small>
                                    <small class="border-end me-3 pe-3"><i class="fa fa-wifi text-primary me-2"></i>Wifi</small> -->
                                    <img class="img" src="../img/room_detail_img/11.png" alt="" height="100%">
                                    <!-- <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small> -->
                                </div>
                                <p class="text-body mb-3">ห้องพักปกติ(Normal) เหมาะสำหรับผู้ใหญ่พัก 2 คน เด็ก 1 คน มีสิ่งอำนวยความสะดวกครบครัน</p>

                                <div class="d-flex justify-content-between">
                                    <div class="col-lg-4">
                                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                                            <form action="1_select_room.php" method="post" enctype="multipart/form-data">
                                                <div class="row g-3">
                                                    <div class="col-md">
                                                        <button type="button" class="btn btn-primary py-2 px-4" data-bs-toggle="modal" data-bs-target="#exampleModal_1">
                                                            รายละเอียดห้อง
                                                        </button>
                                                    </div>
                                                    <!-- <div class="col-md-6">
                                                        <button type="button" class="btn btn-sm btn-dark rounded py-2 px-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                            Book Now
                                                        </button>
                                                    </div> -->
                                                </div>
                                            </form>
                                            <div class="modal fade" id="exampleModal_1" tabindex="-1" aria-labelledby="exampleModalLabel_1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel_1">รายละเอียดห้องพักปกติ(Normal)</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <p class="card-text">รูปภาพรายละเอียดภายในห้องพักแบบปกติ(Normal)</p>
                                                                    <p class="card-text"><small class="text-muted">สิ่งอำนวยความสะดวก : เตียงเดี่ยวขนาดมาตราฐาน,ตู้เย็น,ทีวี,เครื่องปรับอากาศ,อุปรกรณ์อาบน้ำ,เครื่องน้ำอุ่น,WIFIฟรี</small></p>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div id="carouselExampleControls_1" class="carousel slide" data-bs-ride="carousel">
                                                                        <div class="carousel-inner">
                                                                            <div class="carousel-item active">
                                                                                <img src="../imge/faikham_hotel/hotel-4.jpg" class="d-block w-100" alt="..." height="50%">
                                                                            </div>
                                                                            <div class="carousel-item">
                                                                                <img src="../imge/faikham_hotel/hotel-13.jpg" class="d-block w-100" alt="..." height="50%">
                                                                            </div>
                                                                            <div class="carousel-item">
                                                                                <img src="../imge/faikham_hotel/hotel-12.jpg" class="d-block w-100" alt="..." height="50%">
                                                                            </div>
                                                                            <div class="carousel-item">
                                                                                <img src="../imge/faikham_hotel/nom_3.png" class="d-block w-100" alt="..." height="50%">
                                                                            </div>
                                                                        </div>
                                                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls_1" data-bs-slide="prev">
                                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                            <span class="visually-hidden">Previous</span>
                                                                        </button>
                                                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls_1" data-bs-slide="next">
                                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                            <span class="visually-hidden">Next</span>
                                                                        </button>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Room End -->

                    <!-- Room Start -->
                    <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="room-item shadow rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="../imge/rh-4.jpg" alt="">
                                <small class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">$990/Night</small>
                            </div>
                            <div class="p-4 mt-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0">ห้องพักขนาดใหญ่(Deluxe)</h5>
                                </div>
                                <div class="d-flex mb-3">
                                    <!-- <small class="border-end me-3 pe-3"><i class="fa fa-bed text-primary me-2"></i>1 Bed</small>
                                    <small class="border-end me-3 pe-3"><i class="fa fa-bath text-primary me-2"></i>1 Bath</small>
                                    <small class="border-end me-3 pe-3"><i class="fa fa-wifi text-primary me-2"></i>Wifi</small> -->
                                    <img class="img" src="../img/room_detail_img/22.png" alt="" height="100%">
                                    <!-- <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small> -->
                                </div>
                                <p class="text-body mb-3">ห้องพักขนาดใหญ่(Deluxe) เหมาะสำหรับผู้ใหญ่พัก 2 คน เด็ก 2 คน มีสิ่งอำนวยความสะดวกครบครัน</p>

                                <div class="d-flex justify-content-between">
                                    <div class="col-lg-4">
                                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                                            <form action="1_select_room.php" method="post" enctype="multipart/form-data">
                                                <div class="row g-3">
                                                    <div class="col-md">
                                                        <button type="button" class="btn btn-primary py-2 px-4" data-bs-toggle="modal" data-bs-target="#exampleModal_2">
                                                            รายละเอียดห้อง
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="modal fade" id="exampleModal_2" tabindex="-1" aria-labelledby="exampleModalLabel_2" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel_2">รายละเอียดห้อง ห้องพักขนาดใหญ่(Deluxe)</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <p class="card-text">รูปภาพรายละเอียดภายในห้องพักแบบขนาดใหญ่(Deluxe)</p>
                                                                    <p class="card-text"><small class="text-muted">สิ่งอำนวยความสะดวก : เตียงเดี่ยว KingSize,ตู้เย็น,ทีวี,เครื่องปรับอากาศ,อุปรกรณ์อาบน้ำ,เครื่องน้ำอุ่น,WIFIฟรี</small></p>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div id="carouselExampleControls_2" class="carousel slide" data-bs-ride="carousel">
                                                                        <div class="carousel-inner">
                                                                            <div class="carousel-item active">
                                                                                <img src="../imge/faikham_bq/dx_2.png" class="d-block w-100" alt="..." height="50%">
                                                                            </div>
                                                                            <div class="carousel-item">
                                                                                <img src="../imge/faikham_bq/dx_3.png" class="d-block w-100" alt="..." height="50%">
                                                                            </div>
                                                                            <div class="carousel-item">
                                                                                <img src="../imge/faikham_bq/dx_4.png" class="d-block w-100" alt="..." height="50%">
                                                                            </div>
                                                                            <div class="carousel-item">
                                                                                <img src="../imge/faikham_bq/nom_5.png" class="d-block w-100" alt="..." height="50%">
                                                                            </div>
                                                                        </div>

                                                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls_2" data-bs-slide="prev">
                                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                            <span class="visually-hidden">Previous</span>
                                                                        </button>
                                                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls_2" data-bs-slide="next">
                                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                            <span class="visually-hidden">Next</span>
                                                                        </button>

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