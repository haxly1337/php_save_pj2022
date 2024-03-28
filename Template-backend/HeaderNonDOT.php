<?php

session_start();
//require_once '../config/db.php';
$disabled = "style='opacity: .65; pointer-events: none; cursor: not-allowed;'";

//! Role Transform //
{
  $save_role = $_SESSION['role'];
  // IF ROLE //
  {

    if (($save_role) == "owner") {
      $save_role_show = "เจ้าของกิจการ";
    }
    if (($save_role) == "mana") {
      $save_role_show = "ผู้จัดการ";
    }
    if (($save_role) == "emp") {
      $save_role_show = "พนักงาน";
    }
  }
  // END IF ROLE //
}
//* End Role Transform //

// CHECK USER ID //
{
  $check_user_id =  $_SESSION['code_member'];

  $query_info = "SELECT * FROM all_user WHERE code_member = $check_user_id";
  $query_run_info = mysqli_query($conn, $query_info);
  $row = mysqli_fetch_assoc($query_run_info);

  $save_user_id = $row['id'];
  $save_code_member_id = $row['code_member'];
  $save_username = $row['username'];
  $save_password = $row['password'];
  $save_img = $row['img'];
  $save_role = $row['role'];
}
//END CHECK USER ID //

// CHECK IMG //
{
  $check_user_img = $row['img'];

  if (($check_user_img) == "no-img") {
    $check_user_img = "download (1).jpg";
  } else {
    $check_user_id = $row['img'];
  }
}
// END CHECK IMG
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />

  <!-- ========== All CSS files linkup ========= -->
  <link rel="stylesheet" href=https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css>
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="./assets/css/lineicons.css" />
  <link rel="stylesheet" href="./assets/css/materialdesignicons.min.css" />
  <link rel="stylesheet" href="./assets/css/fullcalendar.css" />
  <link rel="stylesheet" href="./assets/css/main.css" />

  <!-- <link href="../css/sb-admin-2.min.css" rel="stylesheet"> -->

</head>

<body>
  <!-- ======== sidebar-nav start =========== -->
  <aside class="sidebar-nav-wrapper">
    <div class="navbar-logo">
      <a href="index_backend_owner_NEW.php">
        <img src="./img/img_website_3.png" alt="logo" />
      </a>
    </div>
    <nav class="sidebar-nav">

      <ul>

        <!-- ปุ่มจัดการผู้ใช้ -->
        <?php if ($_SESSION['Menu_1'] == 1) { ?>
          <li class="nav-item nav-item-has-children">
            <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_3" aria-controls="ddmenu_3" aria-expanded="false" aria-label="Toggle navigation">
              <span class="icon">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12.9067 14.2908L15.2808 11.9167H6.41667V10.0833H15.2808L12.9067 7.70917L14.2083 6.41667L18.7917 11L14.2083 15.5833L12.9067 14.2908ZM17.4167 2.75C17.9029 2.75 18.3692 2.94315 18.713 3.28697C19.0568 3.63079 19.25 4.0971 19.25 4.58333V8.86417L17.4167 7.03083V4.58333H4.58333V17.4167H17.4167V14.9692L19.25 13.1358V17.4167C19.25 17.9029 19.0568 18.3692 18.713 18.713C18.3692 19.0568 17.9029 19.25 17.4167 19.25H4.58333C3.56583 19.25 2.75 18.425 2.75 17.4167V4.58333C2.75 3.56583 3.56583 2.75 4.58333 2.75H17.4167Z" />
                </svg>
              </span>
              <span class="text">จัดการผู้ใช้</span>
            </a>
            <ul id="ddmenu_3" class="collapse dropdown-nav">
              <li>
                <a href="./e_owner/show_all_emp.php"> ข้อมูลพนักงาน </a>
              </li>
              <li>
                <a href="./e_owner/show_all_emp.php"> ข้อมูลสมาชิก</a>
              </li>
            </ul>
          </li>
        <?php } ?>

        <!-- ปุ่มจัดการห้องพัก -->
        <?php if ($_SESSION['Menu_2'] == 1) { ?>
          <li class="nav-item nav-item-has-children">
            <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_2" aria-controls="ddmenu_2" aria-expanded="false" aria-label="Toggle navigation">
              <span class="icon">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12.8334 1.83325H5.50008C5.01385 1.83325 4.54754 2.02641 4.20372 2.37022C3.8599 2.71404 3.66675 3.18036 3.66675 3.66659V18.3333C3.66675 18.8195 3.8599 19.2858 4.20372 19.6296C4.54754 19.9734 5.01385 20.1666 5.50008 20.1666H16.5001C16.9863 20.1666 17.4526 19.9734 17.7964 19.6296C18.1403 19.2858 18.3334 18.8195 18.3334 18.3333V7.33325L12.8334 1.83325ZM16.5001 18.3333H5.50008V3.66659H11.9167V8.24992H16.5001V18.3333Z" />
                </svg>
              </span>
              <span class="text"> จัดการห้องพัก </a></span>
            </a>
            <ul id="ddmenu_2" class="collapse dropdown-nav">
              <li>
                <a href="./index_manager_room.php"> ข้อมูลห้องพัก </a>
              </li>
              <li>
                <a href="./e_owner/data_review.php"> ข้อมูลการรีวิว </a>
              </li>
              <li>
                <a href="promotion_owner.php"> โปรโมชั่น </a>
              </li>
              <li>
                <a href="./e_owner/data_new.php"> ข่าวประชาสัมพันธ์ </a>
              </li>
            </ul>
          </li>
        <?php } ?>

        <!-- ปุ่มจองห้องพัก !-->

        <?php if ($_SESSION['Menu_3'] == 1) { ?>
          <li class="nav-item">
            <a href="index_backend_owner_NEW.php">
              <span class="icon">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M4.58333 3.66675H17.4167C17.9029 3.66675 18.3692 3.8599 18.713 4.20372C19.0568 4.54754 19.25 5.01385 19.25 5.50008V16.5001C19.25 16.9863 19.0568 17.4526 18.713 17.7964C18.3692 18.1403 17.9029 18.3334 17.4167 18.3334H4.58333C4.0971 18.3334 3.63079 18.1403 3.28697 17.7964C2.94315 17.4526 2.75 16.9863 2.75 16.5001V5.50008C2.75 5.01385 2.94315 4.54754 3.28697 4.20372C3.63079 3.8599 4.0971 3.66675 4.58333 3.66675ZM4.58333 7.33341V11.0001H10.0833V7.33341H4.58333ZM11.9167 7.33341V11.0001H17.4167V7.33341H11.9167ZM4.58333 12.8334V16.5001H10.0833V12.8334H4.58333ZM11.9167 12.8334V16.5001H17.4167V12.8334H11.9167Z" />
                </svg>
              </span>
              <span class="text">จัดการการจองห้องพัก</span>
            </a>
          </li>
        <?php } ?>

        <!-- หลักฐานการชำระเงิน !-->
        <!-- <li class="nav-item">
            <a href="list_book_owner.php">
              <span class="icon">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M4.58333 3.66675H17.4167C17.9029 3.66675 18.3692 3.8599 18.713 4.20372C19.0568 4.54754 19.25 5.01385 19.25 5.50008V16.5001C19.25 16.9863 19.0568 17.4526 18.713 17.7964C18.3692 18.1403 17.9029 18.3334 17.4167 18.3334H4.58333C4.0971 18.3334 3.63079 18.1403 3.28697 17.7964C2.94315 17.4526 2.75 16.9863 2.75 16.5001V5.50008C2.75 5.01385 2.94315 4.54754 3.28697 4.20372C3.63079 3.8599 4.0971 3.66675 4.58333 3.66675ZM4.58333 7.33341V11.0001H10.0833V7.33341H4.58333ZM11.9167 7.33341V11.0001H17.4167V7.33341H11.9167ZM4.58333 12.8334V16.5001H10.0833V12.8334H4.58333ZM11.9167 12.8334V16.5001H17.4167V12.8334H11.9167Z" />
                </svg>
              </span>
              <span class="text">จัดการการชำระเงิน</span>
            </a>
          </li> -->

        <?php if ($_SESSION['Menu_4'] == 1) { ?>
          <li class="nav-item nav-item-has-children">
            <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_4" aria-controls="ddmenu_4" aria-expanded="false" aria-label="Toggle navigation">
              <span class="icon">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M3.66675 4.58325V16.4999H19.2501V4.58325H3.66675ZM5.50008 14.6666V6.41659H8.25008V14.6666H5.50008ZM10.0834 14.6666V11.4583H12.8334V14.6666H10.0834ZM17.4167 14.6666H14.6667V11.4583H17.4167V14.6666ZM10.0834 9.62492V6.41659H17.4167V9.62492H10.0834Z" />
                </svg>
              </span>
              <span class="text"> รายงาน </span>
            </a>
            <ul id="ddmenu_4" class="collapse dropdown-nav">
              <li>
                <a href="./e_owner/report_owner_1.php"> รายงานข้อมูลพนักงาน </a>
              </li>
              <li>
                <a href="./e_owner/report_owner_2.php"> รายงานข้อมูลการจองห้องพัก </a>
              </li>
              <li>
                <a href="./e_owner/report_owner_3.php"> รายงานข้อมูลรีวิวการใช้บริการ </a>
              </li>
            </ul>
          </li>
        <?php } ?>

        <!-- Add Walking !-->
        <?php if ($_SESSION['Menu_5'] == 1) { ?>
          <li class="nav-item">
            <a href="./e_owner/addwalkin_new.php">
              <span class="icon">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M4.58333 3.66675H17.4167C17.9029 3.66675 18.3692 3.8599 18.713 4.20372C19.0568 4.54754 19.25 5.01385 19.25 5.50008V16.5001C19.25 16.9863 19.0568 17.4526 18.713 17.7964C18.3692 18.1403 17.9029 18.3334 17.4167 18.3334H4.58333C4.0971 18.3334 3.63079 18.1403 3.28697 17.7964C2.94315 17.4526 2.75 16.9863 2.75 16.5001V5.50008C2.75 5.01385 2.94315 4.54754 3.28697 4.20372C3.63079 3.8599 4.0971 3.66675 4.58333 3.66675ZM4.58333 7.33341V11.0001H10.0833V7.33341H4.58333ZM11.9167 7.33341V11.0001H17.4167V7.33341H11.9167ZM4.58333 12.8334V16.5001H10.0833V12.8334H4.58333ZM11.9167 12.8334V16.5001H17.4167V12.8334H11.9167Z" />
                </svg>
              </span>
              <span class="text">จัดการการจองห้องพักลูกค้าวอล์คอิน</span>
            </a>
          </li>
        <?php } ?>

      </ul>
    </nav>
  </aside>

  <div class="overlay"></div>
  <!-- ======== sidebar-nav end =========== -->

  <!-- ======== main-wrapper start =========== -->
  <main class="main-wrapper">
    <!-- ========== header start ========== -->
    <header class="header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-5 col-md-5 col-6">
            <div class="header-left d-flex align-items-center">
              <div class="menu-toggle-btn mr-20">
                <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                  <i class="lni lni-chevron-left me-2"></i> Menu
                </button>
              </div>
            </div>
          </div>
          <div class="col-lg-7 col-md-7 col-6">
            <div class="header-right">
              <!-- profile start -->
              <div class="profile-box ml-15">
                <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile" data-bs-toggle="dropdown" aria-expanded="false">
                  <div class="profile-info">
                    <div class="info">
                      <h6> คุณ : <?php echo $_SESSION['first_name'] . " " . "($save_role_show)" ?></h6>
                      <div class="image">
                        <img src="<?php echo "./img/" . $check_user_img ?>" alt="" width="45" height="45" />
                        <span class="status"></span>
                      </div>
                    </div>
                  </div>
                  <i class="lni lni-chevron-down"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                  <li>
                  <li>
                    <a href="info_me_owner.php">
                      <i class="lni lni-user"></i> แก้ไขข้อมูลส่วนตัว
                    </a>
                  </li>
                  <li>
                    <a href="logout.php" onclick="return confirm('คุณต้องออกจากระบบใช่ใหม ?')"> <i class="lni lni-exit"></i> ออกจากระบบ </a>
                  </li>
                </ul>
              </div>
              <!-- profile end -->
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- ========== header end ========== -->
