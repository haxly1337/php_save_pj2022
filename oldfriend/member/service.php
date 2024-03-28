<?php
   session_start();
   require("../config/db.php");
    $con = connect_db(0);

   /*
    if(empty($_SESSION['user_Position']) or $_SESSION['user_Position']!='mem'  ){
        echo "<script>alert('กรุณาเข้าสู่ระบบ เพื่อเข้าถึงสิทธิ์การใช้งาน')</script>";
        echo "<script>window.location='../index.html'</script>";
    } */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Hotelier - Hotel HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="../img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">  

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

         <!-- Header Start -->
         <div class="container-fluid bg-dark px-0">
            <div class="row gx-0">
                <div class="col-lg-3 bg-dark d-none d-lg-block">
                    <a href="indexmember.php" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                        <h1 class="m-0 text-primary text-uppercase">FAIKHAM</h1>
                    </a>
                </div>
                <div class="col-lg-9">
                    <div class="row gx-0 bg-white d-none d-lg-flex">
                        <div class="col-lg-7 px-5 text-start">
                            <div class="h-100 d-inline-flex align-items-center py-2 me-4">
                                <i class="fa fa-envelope text-primary me-2"></i>
                                <p class="mb-0">Faikham</p>
                            </div>
                            <div class="h-100 d-inline-flex align-items-center py-2">
                                <i class="fa fa-phone-alt text-primary me-2"></i>
                                <p class="mb-0">+012 345 6789</p>
                            </div>
                        </div>
                  
                    </div>
                    <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0">
                        <a href="index.html" class="navbar-brand d-block d-lg-none">
                            <h1 class="m-0 text-primary text-uppercase">FAIKHAM</h1>
                        </a>
                        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                                <div class="navbar-nav mr-auto py-0">
                                    <a href="indexmember.php" class="nav-item nav-link active">Home</a>
                                    <a href="aboutmember.php" class="nav-item nav-link">About</a>
                                    <a href="roommember.php" class="nav-item nav-link">Rooms</a>
                                    <div class="nav-item dropdown">
                                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">News</a>
                                        <div class="dropdown-menu rounded-0 m-0">
                                            <a href="newsmember.php" class="dropdown-item">News</a>
                                            <a href="promotionmember.php" class="dropdown-item">Promotions</a>
                                        </div>
                                    </div>
                                    <a href="service.php" class="nav-item nav-link">Review</a>
                                    <a href="booking.php" class="nav-item nav-link">Booking status</a>
                                    <div class="nav-item dropdown pull-right position-right rh-5 ">
                                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="mr-2  d-lg-inline text-gray-600 small"><?php echo $_SESSION['user_Name'] ;?> </span>
                                                <img class="img-profile rounded-circle small KingSize"
                                                    src="../imge/profile.png">
                                        </a></a>
                                        <div class="dropdown-menu rounded-0 m-0">
                                       <a href='indexmember.php?id'class='dropdown-item' data-bs-toggle='modal' data-bs-target='#exampleModal'>Edit profile</a>
                                            
                                                <a class="dropdown-item" href="../login/logout.php"  data-toggle="modal" data-target="#logoutModal">
                                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                                    Logout
                                                </a>
                                        </div>
                                    </div>
                                </div>
                        
                    </nav>
                </div>
            </div>
        </div>
        <!-- Header End -->

        <!-- register star -->
  <?php
  $code_members=$_SESSION['user_id'];

  $detail=mysqli_query($con,"SELECT * FROM all_user WHERE code_member ='$code_members'") or die(mysqli_error($con));
  list($code_member,$first_name,$last_name,$username,$passwrd,$email,$tel,$address,$address_county,$address_district1,$address_district2,$address_zipcode,$roles,$salary)=mysqli_fetch_row($detail);
 ?>
<form action="updateuse.php" method="POST" enctype="multipart/form-data">

<div class="col-lg">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">ข้อมูลส่วนตัว</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">

             <div class="row">


                         <div>
                             
                             <input type="hidden" class="form-control" id="Input_Text" name="codee" value="<?php   echo $code_member ;?>"  required>
                         </div>
                    
                 

                 <div class="col-sm">
                     <div class="mt-2">
                         <div>
                             <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ชื่อผู้ใช้งาน</label>
                             <input type="text" class="form-control" id="Input_Text" name="cus_username"value="<?php   echo $username ;?>" readonly >
                         </div>
                     </div>
                 </div>

                 <div class="col-sm">
                     <div class="mt-2">
                         <div>
                             <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">รหัสผ่าน</label>
                             <input type="text" class="form-control" id="Input_Text" name="cus_password" value="<?php   echo $passwrd;?>"  maxlength="16" required>
                         </div>
                     </div>
                 </div>

             </div>

             <div class="row">

                 <div class="col-sm">
                     <div class="mt-2">
                         <div>
                             <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ชื่อ</label>
                             <input type="text" class="form-control" id="Input_Text" name="cus_name" value="<?php   echo $first_name ;?>"  required>
                         </div>
                     </div>
                 </div>

                 <div class="col-sm">
                     <div class="mt-2">
                         <div>
                             <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">นามสกุล</label>
                             <input type="text" class="form-control" id="Input_Text" name="cus_lastname"value="<?php   echo $last_name ;?>"  required>
                         </div>
                     </div>
                 </div>

             </div>

             <div class="row">

                 <div class="col-sm">
                     <div class="mt-2">
                         <div>
                             <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">อีเมล์</label>
                             <input type="text" class="form-control" id="Input_Text" name="cus_email" value="<?php   echo $email ;?>" >
                         </div>
                     </div>
                 </div>

                 <div class="col-sm">
                     <div class="mt-2">
                         <div>
                             <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">เบอร์มือถือ</label>
                             <input type="text" class="form-control" id="Input_Text" name="cus_tel" value="<?php   echo $tel ;?>"  required maxlength="10">
                         </div>
                     </div>
                 </div>

             </div>

             <div class="row">

                 <div class="col-sm">
                     <div class="mt-2">
                         <div>
                             <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ที่อยู่</label>
                             <input type="text" class="form-control" id="Input_Text" name="cus_address"value="<?php   echo $address ;?>"  required>
                         </div>
                     </div>
                 </div>

                 <div class="col-sm">
                     <div class="mt-2">
                         <div>
                             <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">ตำบล</label>
                             <input type="text" class="form-control" id="Input_Text" name="cus_address_county" value="<?php   echo $address_county ;?>"  required>
                         </div>
                     </div>
                 </div>

             </div>

             <div class="row">

                 <div class="col-sm">
                     <div class="mt-2">
                         <div>
                             <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">อำเภอ</label>
                             <input type="text" class="form-control" id="Input_Text" name="cus_address_district" value="<?php   echo $address_district1 ;?>"  required>
                         </div>
                     </div>
                 </div>

                 <div class="col-sm">
                     <div class="mt-2">
                         <div>
                             <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">จังหวัด</label>
                             <input type="text" class="form-control" id="Input_Text" name="cus_address_district_2"value="<?php   echo $address_district2 ;?>"  required>
                         </div>
                     </div>
                 </div>

             </div>

             <div class="col-sm">
                 <div class="mt-2">
                     <div>
                         <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;">รหัสไปรษณีย์</label>
                         <input type="text" class="form-control" id="Input_Text" name="cus_address_zipcode" value="<?php   echo $address_zipcode ;?>"  required maxlength="5" >
                     </div>
                 </div>
             </div>
             <div class="col-sm">
                 <div class="mt-2">
                     <div>
                         <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;"></label>
                         <input type="hidden" class="form-control" id="Input_Text" name="cus_role" value="mem" required>
                     </div>
                 </div>
             </div>
             <div class="col-sm">
                 <div class="mt-2">
                     <div>
                         <label for="Input_Text" class="form-label" style="float: left; font-size: 18px;"></label>
                         <input type="hidden" class="form-control" id="Input_Text" name="cus_sala" value="0" required>
                     </div>
                 </div>
             </div>

         </div>
         <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
             <button type="sumbit" class="btn btn-primary" name="sumbit_register">แก้ไขข้อมูล</button>
         </div>
     </div>
 </div>
</div>
</div>
</form>
<!-- Register end -->

        <!-- Page Header Start -->
        <div class="container-fluid page-header mb-5 p-0" style="background-image: url(../img/carousel-1.jpg);">
            <div class="container-fluid page-header-inner py-5">
                <div class="container text-center pb-5">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Review</h1>
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
                <div class="row g-4 bg-dark">
                    <div class="col-lg-5 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <a class="service-item rounded" href="">
                            <div class="service-icon bg-transparent border rounded p-1">
                                <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                    <i class="fa fa-hotel fa-2x text-primary"></i>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="rating-block">
                                    <h5>Average Review rating</h5>
                                    <h1 class="bold padding-bottom-7">4.3 <small>/ 5</small></h1>
                                    <button type="button" class="btn btn-warning btn-sm" aria-label="justify-content-center">
                                      <span class="fa fa-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sm" aria-label="justify-content-center">
                                      <span class="fa fa-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sm" aria-label="justify-content-center">
                                      <span class="fa fa-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="justify-content-center">
                                      <span class="fa fa-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-grey" aria-label="justify-content-center">
                                      <span class="fa fa-star" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-7 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                        <a class="service-item rounded" href="">
                            <div class="col-sm-12">
                                <h5>Rating breakdown</h5>
                                <div class="pull-left">
                                    <div class="pull-right" style="width:35px; line-height:1;">
                                        <div style="height:9px; margin:5px 0;">5 <span class="fa fa-star"></span></div>
                                    </div>
                                    <div class="pull-right" style="width:300px;">
                                        <div class="progress" style="height:9px; margin:8px 0;">
                                          <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: 1000%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="pull-right" style="margin-left:10px;">1</div>
                                </div>
                                <div class="pull-left">
                                    <div class="pull-left" style="width:35px; line-height:1;">
                                        <div style="height:9px; margin:5px 0;">4 <span class="fa fa-star"></span></div>
                                    </div>
                                    <div class="pull-left" style="width:180px;">
                                        <div class="progress" style="height:9px; margin:8px 0;">
                                          <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="pull-right" style="margin-left:10px;">1</div>
                                </div>
                                <div class="pull-left">
                                    <div class="pull-left" style="width:35px; line-height:1;">
                                        <div style="height:9px; margin:5px 0;">3 <span class="fa fa-star"></span></div>
                                    </div>
                                    <div class="pull-left" style="width:180px;">
                                        <div class="progress" style="height:9px; margin:8px 0;">
                                          <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width: 60%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="pull-right" style="margin-left:10px;">0</div>
                                </div>
                                <div class="pull-left">
                                    <div class="pull-left" style="width:35px; line-height:1;">
                                        <div style="height:9px; margin:5px 0;">2 <span class="fa fa-star"></span></div>
                                    </div>
                                    <div class="pull-left" style="width:180px;">
                                        <div class="progress" style="height:9px; margin:8px 0;">
                                          <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width: 40%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="pull-right" style="margin-left:10px;">0</div>
                                </div>
                                <div class="pull-left">
                                    <div class="pull-left" style="width:35px; line-height:1;">
                                        <div style="height:9px; margin:5px 0;">1 <span class="fa fa-star"></span></div>
                                    </div>
                                    <div class="pull-left" style="width:180px;">
                                        <div class="progress" style="height:9px; margin:8px 0;">
                                          <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width: 20%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="pull-right" style="margin-left:10px;">0</div>
                                </div>
                            </div>		
                        </a>
                    </div>
                    <div class="col-lg-12 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <a class="service-item rounded" href="">
                            <div class="service-icon bg-transparent border rounded p-1">
                                <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                    <i class="fa fa-spa fa-2x text-primary"></i>
                                </div>
                            </div>
                            <h5 class="mb-3">Spa & Fitness</h5>
                            <p class="text-body mb-0">Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem sed diam stet diam sed stet lorem.</p>
                        </a>
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
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/counterup/counterup.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
</body>

</html>