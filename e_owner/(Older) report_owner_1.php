<?php

session_start();
require_once '../config/db.php';

$disabled = "style='opacity: .65; pointer-events: none; cursor: not-allowed;'";

//! Role Transform //
{
  $save_role = $_SESSION['role'];
  // IF ROLE //
  {
    if (($save_role) == "owner") {
      $save_role_show = "เจ้าของกิจการ";
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

if (!isset($_SESSION['userid'])) {
  header('location: logintoblackend.php');
} else {
  if (isset($_POST['addData'])) {
    $ip_Room = $_POST['ip_Room'];
    $ip_Hotel = $_POST['ip_Hotel'];
    $ip_TypeRoom = $_POST['ip_TypeRoom'];

    $qty_RoomData = "INSERT INTO room_data (room_id, room_amount, hotel_where, room_type) VALUES ('$ip_Room','','$ip_Hotel','$ip_TypeRoom');";
    $resRoom = mysqli_query($conn, $qty_RoomData);
    if ($resRoom) {
      echo "<script>alert('เพิ่มห้องพักสำเร็จ'); window.location.href='index_backend_owner_NEW.php';</script>";
    }
  } else if (isset($_GET['book_id']) && isset($_GET['receipt_no']) && isset($_GET['Stats'])) {
    $book_id = $_GET['book_id'];
    $receipt_no = $_GET['receipt_no'];
    $member_id = $_SESSION['code_member'];
    if ($_GET['Stats'] == 'ucf')
      $qty = "UPDATE `list_order_booking` JOIN `room_data` ON `room_data`.room_id = `list_order_booking`.room_day AND `room_data`.hotel_where = `list_order_booking`.hotel_where AND `room_data`.room_type = `list_order_booking`.room_type AND `room_data`.`status` = `list_order_booking`.`room_status` SET `list_order_booking`.`room_status`='-999', `room_data`.`status`='0',`list_order_booking`.`code_member`='$member_id'  WHERE `book_id`='$book_id' AND `receipt_no`='$receipt_no'"; //-999 ยกเลิกการจอง
    else if ($_GET['Stats'] == 'cf')
      $qty = "UPDATE `list_order_booking` JOIN `room_data` ON `room_data`.room_id = `list_order_booking`.room_day AND `room_data`.hotel_where = `list_order_booking`.hotel_where AND `room_data`.room_type = `list_order_booking`.room_type AND `room_data`.`status` = `list_order_booking`.`room_status` SET `list_order_booking`.`status_booking`='1',`list_order_booking`.`code_member`='$member_id',`list_order_booking`.`room_status`='1',`room_data`.`status`='1' WHERE `book_id`='$book_id' AND `receipt_no`='$receipt_no'";
    else if ($_GET['Stats'] == 'co')
      $qty = "UPDATE `list_order_booking` JOIN `room_data` ON `room_data`.room_id = `list_order_booking`.room_day AND `room_data`.hotel_where = `list_order_booking`.hotel_where AND `room_data`.room_type = `list_order_booking`.room_type AND `room_data`.`status` = `list_order_booking`.`room_status` SET `list_order_booking`.`status_booking`='1',`list_order_booking`.`code_member`='$member_id',`list_order_booking`.`room_status`='777',`room_data`.`status`='0' WHERE `book_id`='$book_id' AND `receipt_no`='$receipt_no'";
    $result = mysqli_query($conn, $qty);
    header('location:index_backend_owner_NEW.php');
  } else if (isset($_GET['room_id'])) {
    $room_id = $_GET['room_id'];
    $result = mysqli_query($conn, "DELETE FROM `room_data` WHERE id ='$room_id'"); //ยกเลิกการจอง
    header('location:index_backend_owner_NEW.php');
  }

  $result_emp = mysqli_query($conn, "SELECT * FROM `all_user`");

  if (isset($_GET['keyword'])) {

    $keyword = $_GET['keyword'];

    $result = mysqli_query($conn, "SELECT * FROM all_user WHERE role ='$keyword' ") or die(mysqli_error($con));
  } else {

    $result = mysqli_query($conn, "SELECT * FROM all_user  ") or die(mysqli_error($con));
  }

?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />

    <title>เจ้าของกิจการ/แอดมิน <?php echo "คุณ : " . $_SESSION['first_name'] ?></title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/lineicons.css" />
    <link rel="stylesheet" href="../assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="../assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="../assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />

    <!-- <link href="../css/sb-admin-2.min.css" rel="stylesheet"> -->

  </head>

  <body>
    <!-- ======== sidebar-nav start =========== -->
    <aside class="sidebar-nav-wrapper">
      <div class="navbar-logo">
        <a href="index.html">
          <img src="../img/img_website_3.png" alt="logo" />
        </a>
      </div>
      <nav class="sidebar-nav">

        <ul>

          <!-- ปุ่มจัดการผู้ใช้ -->
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
                <a href="show_all_emp_owner.php"> ข้อมูลพนักงาน </a>
              </li>
              <li>
                <a href="show_all_mem_owner.php"> ข้อมูลสมาชิก</a>
              </li>
            </ul>
          </li>

          <!-- ปุ่มจัดการห้องพัก -->
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
                <a href="0"> ข้อมูลห้องพัก </a>
              </li>
              <li>
                <a href="list_book.php"> ข้อมูลการรีวิว </a>
              </li>
              <li>
                <a href="promotion_owner.php"> โปรโมชั่น </a>
              </li>
              <li>
                <a href="news_owner.php"> ข่าวประชาสัมพันธ์ </a>
              </li>
            </ul>
          </li>

          <!-- ปุ่มจองห้องพัก !-->
          <li class="nav-item">
            <a href="list_book_owner.php">
              <span class="icon">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M4.58333 3.66675H17.4167C17.9029 3.66675 18.3692 3.8599 18.713 4.20372C19.0568 4.54754 19.25 5.01385 19.25 5.50008V16.5001C19.25 16.9863 19.0568 17.4526 18.713 17.7964C18.3692 18.1403 17.9029 18.3334 17.4167 18.3334H4.58333C4.0971 18.3334 3.63079 18.1403 3.28697 17.7964C2.94315 17.4526 2.75 16.9863 2.75 16.5001V5.50008C2.75 5.01385 2.94315 4.54754 3.28697 4.20372C3.63079 3.8599 4.0971 3.66675 4.58333 3.66675ZM4.58333 7.33341V11.0001H10.0833V7.33341H4.58333ZM11.9167 7.33341V11.0001H17.4167V7.33341H11.9167ZM4.58333 12.8334V16.5001H10.0833V12.8334H4.58333ZM11.9167 12.8334V16.5001H17.4167V12.8334H11.9167Z" />
                </svg>
              </span>
              <span class="text">จัดการการจองห้องพัก</span>
            </a>
          </li>

          <!-- หลักฐานการชำระเงิน !-->
          <li class="nav-item">
            <a href="list_book_owner.php">
              <span class="icon">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M4.58333 3.66675H17.4167C17.9029 3.66675 18.3692 3.8599 18.713 4.20372C19.0568 4.54754 19.25 5.01385 19.25 5.50008V16.5001C19.25 16.9863 19.0568 17.4526 18.713 17.7964C18.3692 18.1403 17.9029 18.3334 17.4167 18.3334H4.58333C4.0971 18.3334 3.63079 18.1403 3.28697 17.7964C2.94315 17.4526 2.75 16.9863 2.75 16.5001V5.50008C2.75 5.01385 2.94315 4.54754 3.28697 4.20372C3.63079 3.8599 4.0971 3.66675 4.58333 3.66675ZM4.58333 7.33341V11.0001H10.0833V7.33341H4.58333ZM11.9167 7.33341V11.0001H17.4167V7.33341H11.9167ZM4.58333 12.8334V16.5001H10.0833V12.8334H4.58333ZM11.9167 12.8334V16.5001H17.4167V12.8334H11.9167Z" />
                </svg>
              </span>
              <span class="text">จัดการการชำระเงิน</span>
            </a>
          </li>

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
                <a href="alerts.html"> รายงานข้อมูลพนักงาน </a>
              </li>
              <li>
                <a href="buttons.html"> รายงานข้อมูลการจองห้องพัก </a>
              </li>
              <li>
                <a href="cards.html"> รายงานข้อมูลรีวิวการใช้บริการ </a>
              </li>
            </ul>
          </li>

          <!-- ปุ่มแจ้งเตือน -->
          <span class="divider">
            <hr />
          </span>

          <li class="nav-item">
            <a href="notification.html">
              <span class="icon">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M9.16667 19.25H12.8333C12.8333 20.2584 12.0083 21.0834 11 21.0834C9.99167 21.0834 9.16667 20.2584 9.16667 19.25ZM19.25 17.4167V18.3334H2.75V17.4167L4.58333 15.5834V10.0834C4.58333 7.24171 6.41667 4.76671 9.16667 3.94171V3.66671C9.16667 2.65837 9.99167 1.83337 11 1.83337C12.0083 1.83337 12.8333 2.65837 12.8333 3.66671V3.94171C15.5833 4.76671 17.4167 7.24171 17.4167 10.0834V15.5834L19.25 17.4167ZM15.5833 10.0834C15.5833 7.51671 13.5667 5.50004 11 5.50004C8.43333 5.50004 6.41667 7.51671 6.41667 10.0834V16.5H15.5833V10.0834Z" />
                </svg>
              </span>
              <span class="text">การแจ้งเตือน</span>
            </a>
          </li>
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
                <div class="header-search d-none d-md-flex">
                  <form action="#">
                    <input type="text" placeholder="Search..." />
                    <button><i class="lni lni-search-alt"></i></button>
                  </form>
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
                          <img src="<?php echo "../img/" . $check_user_img ?>" alt="" width="45" height="45" />
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
                      <a href="#0">
                        <i class="lni lni-alarm"></i> แจ้งเตือน
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

      <!-- ========== section start ========== -->
      <section class="section">
        <div class="container-fluid">
          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title mb-30">
                  <h2>ภาพรวมโรงเเรม</h2>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="card">

                    <h5 class="card-header fa fa-file"> รายงานข้อมูลสมาชิก</h5>

                    <div class="card-body">

                      <form action="report_owner_1.php" method="GET">
                        <div class="row">
                          <div class="col-2 mt-2">

                            <select class='form-control custom-select' name='keyword'>

                              <option value='admin'>owner</option>
                              <option value='mana'>mana</option>
                              <option value='emp'>emp</option>
                              <option value='mem'>mem</option>

                            </select>

                          </div>
                          <div class="col-10">
                            <button type="submit" class="btn btn-success  ml-2">ตกลง</button>

                            <a href="report_owner_1.php" class="btn btn-danger  ml-2">ดูทั้งหมด</a>

                            <?php
                            if (empty($_GET['keyword'])) {
                              echo '<a href="print-member.php" type="submit" class="btn btn-primary btn-lg ml-2  te btn-circle" target="_blank"><i class="fas fa-print"></i> 
                            </a>';
                            } else {
                              echo " <a href='print-member.php?keyword=$keyword' type='submit' class='btn btn-primary btn-lg ml-2  te btn-circle' target='_blank'><i class='fas fa-print'></i> 
                              </a>";
                            }

                            ?>

                          </div>
                        </div>
                      </form>


                    </div>

                    <hr>

                    <!-- DataTales Example -->


                    <div class="card">

                      <div class="card-body">
                          
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>รหัสสมาชิก</th>
                              <th>ชื่อสมาชิก</th>
                              <th width="13%">อีเมล</th>
                              <th>ที่อยู่</th>
                              <th>ตำแหน่ง</th>
                              <th>เบอร์โทร</th>
                              <th>Username</th>
                              <th>Password</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            while (list(
                              $memberID,
                              $member_code_member,
                              $member_first_name,
                              $member_last_name,
                              $member_username,
                              $member_password,
                              $member_email,
                              $member_tel,
                              $member_img,
                              $member_address,
                              $member_address_county,
                              $member_address_district,
                              $member_address_district_2,
                              $member_address_zipcode,
                              $member_role,
                              $member_salary
                            ) = mysqli_fetch_row($result_emp)) {
                              echo "<tr>";
                              echo "<td>$member_code_member</td>";
                              echo "<td>$member_first_name" . "$member_last_name" . " </td>";
                              echo "<td>$member_email </td>";
                              echo "<td>$member_address_county</td>";
                              echo "<td>$member_role</td>";
                              echo "<td>$member_tel</td>";
                              echo "<td>$member_username</td>";
                              echo "<td>$member_username</td>";
                              echo "</tr>";
                            };
                            ?>
                          </tbody>
                        </table>
                      </div>

                      </div>
                    </div>
                  </div>


                </div>
                <!-- /.container-fluid -->

              </div>

            </div>
            <!-- end row -->
          </div>

          <!-- ========== title-wrapper end ========== -->
          <!-- ========== section end ========== -->

          <!-- ========== footer start =========== -->
          <footer class="footer">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6 order-last order-md-first">
                  <div class="copyright text-center text-md-start">
                    <p class="text-sm">
                      Designed and Developed by
                      <a href="https://plainadmin.com" rel="nofollow" target="_blank">
                        Faikham
                      </a>
                    </p>
                  </div>
                </div>
                <!-- end col-->
                <div class="col-md-6">
                  <div class="
                  terms
                  d-flex
                  justify-content-center justify-content-md-end
                ">
                    <!-- <a href="#0" class="text-sm">Term & Conditions</a>
                <a href="#0" class="text-sm ml-15">Privacy & Policy</a> -->
                  </div>
                </div>
              </div>
              <!-- end row -->
            </div>
            <!-- end container -->
          </footer>
          <!-- ========== footer end =========== -->
    </main>
    <!-- ======== main-wrapper end =========== -->

    <!-- ========= All Javascript files linkup ======== -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/Chart.min.js"></script>
    <script src="assets/js/dynamic-pie-chart.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/fullcalendar.js"></script>
    <script src="assets/js/jvectormap.min.js"></script>
    <script src="assets/js/world-merc.js"></script>
    <script src="assets/js/polyfill.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
      // ======== jvectormap activation
      var markers = [{
          name: "Egypt",
          coords: [26.8206, 30.8025]
        },
        {
          name: "Russia",
          coords: [61.524, 105.3188]
        },
        {
          name: "Canada",
          coords: [56.1304, -106.3468]
        },
        {
          name: "Greenland",
          coords: [71.7069, -42.6043]
        },
        {
          name: "Brazil",
          coords: [-14.235, -51.9253]
        },
      ];

      var jvm = new jsVectorMap({
        map: "world_merc",
        selector: "#map",
        zoomButtons: true,

        regionStyle: {
          initial: {
            fill: "#d1d5db",
          },
        },

        labels: {
          markers: {
            render: (marker) => marker.name,
          },
        },

        markersSelectable: true,
        selectedMarkers: markers.map((marker, index) => {
          var name = marker.name;

          if (name === "Russia" || name === "Brazil") {
            return index;
          }
        }),
        markers: markers,
        markerStyle: {
          initial: {
            fill: "#4A6CF7"
          },
          selected: {
            fill: "#ff5050"
          },
        },
        markerLabelStyle: {
          initial: {
            fontWeight: 400,
            fontSize: 14,
          },
        },
      });
      // ====== calendar activation
      document.addEventListener("DOMContentLoaded", function() {
        var calendarMiniEl = document.getElementById("calendar-mini");
        var calendarMini = new FullCalendar.Calendar(calendarMiniEl, {
          initialView: "dayGridMonth",
          headerToolbar: {
            end: "today prev,next",
          },
        });
        calendarMini.render();
      });

      // =========== chart one start
      const ctx1 = document.getElementById("Chart1").getContext("2d");
      const chart1 = new Chart(ctx1, {
        // The type of chart we want to create
        type: "line", // also try bar or other graph types

        // The data for our dataset
        data: {
          labels: [
            "Jan",
            "Fab",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
          ],
          // Information about the dataset
          datasets: [{
            label: "",
            backgroundColor: "transparent",
            borderColor: "#4A6CF7",
            data: [
              600, 800, 750, 880, 940, 880, 900, 770, 920, 890, 976, 1100,
            ],
            pointBackgroundColor: "transparent",
            pointHoverBackgroundColor: "#4A6CF7",
            pointBorderColor: "transparent",
            pointHoverBorderColor: "#fff",
            pointHoverBorderWidth: 5,
            pointBorderWidth: 5,
            pointRadius: 8,
            pointHoverRadius: 8,
          }, ],
        },

        // Configuration options
        defaultFontFamily: "Inter",
        options: {
          tooltips: {
            callbacks: {
              labelColor: function(tooltipItem, chart) {
                return {
                  backgroundColor: "#ffffff",
                };
              },
            },
            intersect: false,
            backgroundColor: "#f9f9f9",
            titleFontFamily: "Inter",
            titleFontColor: "#8F92A1",
            titleFontColor: "#8F92A1",
            titleFontSize: 12,
            bodyFontFamily: "Inter",
            bodyFontColor: "#171717",
            bodyFontStyle: "bold",
            bodyFontSize: 16,
            multiKeyBackground: "transparent",
            displayColors: false,
            xPadding: 30,
            yPadding: 10,
            bodyAlign: "center",
            titleAlign: "center",
          },

          title: {
            display: false,
          },
          legend: {
            display: false,
          },

          scales: {
            yAxes: [{
              gridLines: {
                display: false,
                drawTicks: false,
                drawBorder: false,
              },
              ticks: {
                padding: 35,
                max: 1200,
                min: 500,
              },
            }, ],
            xAxes: [{
              gridLines: {
                drawBorder: false,
                color: "rgba(143, 146, 161, .1)",
                zeroLineColor: "rgba(143, 146, 161, .1)",
              },
              ticks: {
                padding: 20,
              },
            }, ],
          },
        },
      });

      // =========== chart one end

      // =========== chart two start
      const ctx2 = document.getElementById("Chart2").getContext("2d");
      const chart2 = new Chart(ctx2, {
        // The type of chart we want to create
        type: "bar", // also try bar or other graph types
        // The data for our dataset
        data: {
          labels: [
            "Jan",
            "Fab",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
          ],
          // Information about the dataset
          datasets: [{
            label: "",
            backgroundColor: "#4A6CF7",
            barThickness: 6,
            maxBarThickness: 8,
            data: [
              600, 700, 1000, 700, 650, 800, 690, 740, 720, 1120, 876, 900,
            ],
          }, ],
        },
        // Configuration options
        options: {
          borderColor: "#F3F6F8",
          borderWidth: 15,
          backgroundColor: "#F3F6F8",
          tooltips: {
            callbacks: {
              labelColor: function(tooltipItem, chart) {
                return {
                  backgroundColor: "rgba(104, 110, 255, .0)",
                };
              },
            },
            backgroundColor: "#F3F6F8",
            titleFontColor: "#8F92A1",
            titleFontSize: 12,
            bodyFontColor: "#171717",
            bodyFontStyle: "bold",
            bodyFontSize: 16,
            multiKeyBackground: "transparent",
            displayColors: false,
            xPadding: 30,
            yPadding: 10,
            bodyAlign: "center",
            titleAlign: "center",
          },

          title: {
            display: false,
          },
          legend: {
            display: false,
          },

          scales: {
            yAxes: [{
              gridLines: {
                display: false,
                drawTicks: false,
                drawBorder: false,
              },
              ticks: {
                padding: 35,
                max: 1200,
                min: 0,
              },
            }, ],
            xAxes: [{
              gridLines: {
                display: false,
                drawBorder: false,
                color: "rgba(143, 146, 161, .1)",
                zeroLineColor: "rgba(143, 146, 161, .1)",
              },
              ticks: {
                padding: 20,
              },
            }, ],
          },
        },
      });
      // =========== chart two end

      // =========== chart three start
      const ctx3 = document.getElementById("Chart3").getContext("2d");
      const chart3 = new Chart(ctx3, {
        // The type of chart we want to create
        type: "line", // also try bar or other graph types

        // The data for our dataset
        data: {
          labels: [
            "Jan",
            "Fab",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
          ],
          // Information about the dataset
          datasets: [{
              label: "Revenue",
              backgroundColor: "transparent",
              borderColor: "#4a6cf7",
              data: [80, 120, 110, 100, 130, 150, 115, 145, 140, 130, 160, 210],
              pointBackgroundColor: "transparent",
              pointHoverBackgroundColor: "#4a6cf7",
              pointBorderColor: "transparent",
              pointHoverBorderColor: "#fff",
              pointHoverBorderWidth: 3,
              pointBorderWidth: 5,
              pointRadius: 5,
              pointHoverRadius: 8,
            },
            {
              label: "Profit",
              backgroundColor: "transparent",
              borderColor: "#9b51e0",
              data: [
                120, 160, 150, 140, 165, 210, 135, 155, 170, 140, 130, 200,
              ],
              pointBackgroundColor: "transparent",
              pointHoverBackgroundColor: "#9b51e0",
              pointBorderColor: "transparent",
              pointHoverBorderColor: "#fff",
              pointHoverBorderWidth: 3,
              pointBorderWidth: 5,
              pointRadius: 5,
              pointHoverRadius: 8,
            },
            {
              label: "Order",
              backgroundColor: "transparent",
              borderColor: "#f2994a",
              data: [180, 110, 140, 135, 100, 90, 145, 115, 100, 110, 115, 150],
              pointBackgroundColor: "transparent",
              pointHoverBackgroundColor: "#f2994a",
              pointBorderColor: "transparent",
              pointHoverBorderColor: "#fff",
              pointHoverBorderWidth: 3,
              pointBorderWidth: 5,
              pointRadius: 5,
              pointHoverRadius: 8,
            },
          ],
        },

        // Configuration options
        options: {
          tooltips: {
            intersect: false,
            backgroundColor: "#fbfbfb",
            titleFontColor: "#8F92A1",
            titleFontSize: 16,
            titleFontFamily: "Inter",
            titleFontStyle: "400",
            bodyFontFamily: "Inter",
            bodyFontColor: "#171717",
            bodyFontSize: 16,
            multiKeyBackground: "transparent",
            displayColors: false,
            xPadding: 30,
            yPadding: 15,
            borderColor: "rgba(143, 146, 161, .1)",
            borderWidth: 1,
            title: false,
          },

          title: {
            display: false,
          },

          layout: {
            padding: {
              top: 0,
            },
          },

          legend: false,

          scales: {
            yAxes: [{
              gridLines: {
                display: false,
                drawTicks: false,
                drawBorder: false,
              },
              ticks: {
                padding: 35,
                max: 300,
                min: 50,
              },
            }, ],
            xAxes: [{
              gridLines: {
                drawBorder: false,
                color: "rgba(143, 146, 161, .1)",
                zeroLineColor: "rgba(143, 146, 161, .1)",
              },
              ticks: {
                padding: 20,
              },
            }, ],
          },
        },
      });
      // =========== chart three end

      // ================== chart four start
      const ctx4 = document.getElementById("Chart4").getContext("2d");
      const chart4 = new Chart(ctx4, {
        // The type of chart we want to create
        type: "bar", // also try bar or other graph types
        // The data for our dataset
        data: {
          labels: ["Jan", "Fab", "Mar", "Apr", "May", "Jun"],
          // Information about the dataset
          datasets: [{
              label: "",
              backgroundColor: "#4A6CF7",
              barThickness: "flex",
              maxBarThickness: 8,
              data: [600, 700, 1000, 700, 650, 800],
            },
            {
              label: "",
              backgroundColor: "#d50100",
              barThickness: "flex",
              maxBarThickness: 8,
              data: [690, 740, 720, 1120, 876, 900],
            },
          ],
        },
        // Configuration options
        options: {
          borderColor: "#F3F6F8",
          borderWidth: 15,
          backgroundColor: "#F3F6F8",
          tooltips: {
            callbacks: {
              labelColor: function(tooltipItem, chart) {
                return {
                  backgroundColor: "rgba(104, 110, 255, .0)",
                };
              },
            },
            backgroundColor: "#F3F6F8",
            titleFontColor: "#8F92A1",
            titleFontSize: 12,
            bodyFontColor: "#171717",
            bodyFontStyle: "bold",
            bodyFontSize: 16,
            multiKeyBackground: "transparent",
            displayColors: false,
            xPadding: 30,
            yPadding: 10,
            bodyAlign: "center",
            titleAlign: "center",
          },

          title: {
            display: false,
          },
          legend: {
            display: false,
          },

          scales: {
            yAxes: [{
              gridLines: {
                display: false,
                drawTicks: false,
                drawBorder: false,
              },
              ticks: {
                padding: 35,
                max: 1200,
                min: 0,
              },
            }, ],
            xAxes: [{
              gridLines: {
                display: false,
                drawBorder: false,
                color: "rgba(143, 146, 161, .1)",
                zeroLineColor: "rgba(143, 146, 161, .1)",
              },
              ticks: {
                padding: 20,
              },
            }, ],
          },
        },
      });
      // =========== chart four end
    </script>

  <?php } ?>
  </body>

  </html>


  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form name="frmSearch" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title" id="exampleModalLabel"> เพิ่มห้องพัก </h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="wow fadeInUp" data-wow-delay="0.2s">
              <div class="row g-3">

                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="ip_Room" placeholder="ห้องพัก" name="ip_Room">
                    <label for="ip_Room">ห้องพัก</label>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-floating">
                    <select class="form-select" id="ip_Hotel" name="ip_Hotel">
                      <option value="faikham_hotel"> Faikham Hotel </option>
                      <option value="faikham_boutique"> Faikham Boutique </option>
                    </select>
                    <label for="ip_Hotel">เลือกโรงแรม</label>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-floating">
                    <select class="form-select" id="ip_TypeRoom" name="ip_TypeRoom">
                      <option value="normal"> ห้องพักขนาดปกติ </option>
                      <option value="deluxe_room"> ห้องพักขนาดพิเศษ </option>
                    </select>
                    <label for="ip_TypeRoom">เลือกประเภทห้อง</label>
                  </div>
                </div>

              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> ปิด </button>
            <button type="submit" class="btn btn-success" name="addData"> เพิ่มห้องพัก </button>
          </div>
        </div>
      </div>
    </form>
  </div>