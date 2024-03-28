<?php

require_once 'config/db.php';
include("./Template-backend/HeaderNonDOT.php");

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

?>

  <title>เจ้าของกิจการ/แอดมิน <?php echo "คุณ : " . $_SESSION['first_name'] ?></title>
  <!-- ========== section start ========== -->
  <section class="section">
    <div class="container-fluid">
      <!-- ========== title-wrapper start ========== -->
      <div class="title-wrapper pt-30">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="title mb-30">
              <h2>การจัดการการจองห้องพัก</h2>
            </div>
          </div>
          <!--div class="col-md">
                <div class="title mb-30">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="float: right;">
                     เพิ่มห้อง
                  </button>
                </div>
              </div-->
          <!-- end col -->
        </div>
        <!-- end row -->
        <div class="row">
          <?php
          //! ROW 1 //
          {
            $query_list = "SELECT * FROM `list_order_booking`";
            $query_run = mysqli_query($conn, $query_list);
            $row = mysqli_fetch_assoc($query_run);
          }
          //! END ROW 1 //

          //! HIDDEN SELECTER //

          //! END HIDDEN SELECTER //

          if (isset($_POST['check_status_pay'])) {

            $save_book_id = $_POST['save_book_id'];

            $book_id_real = $_POST['insert_comm_1'];
            $code_member = $_POST['insert_comm_2'];
            $checkintime = $_POST['insert_comm_3'];
            $checkouttime = $_POST['insert_comm_4'];
            $cus_name = $_POST['insert_comm_5'];
            $tel_cus = '0';
            $email_cus = '0';
            $hotel_where = $_POST['insert_comm_8'];
            $room_type = $_POST['insert_comm_9'];
            $amount_room = $_POST['insert_comm_10'];
            $cus_detail = '';
            $image_cus = $_POST['insert_comm_12'];
            $promotion_code = '';

            $query_insert_data = "INSERT INTO `customer_data` (`id`,
        `book_id` ,
        `code_member` ,
        `checkintime`,
        `checkouttime`,
        `cus_name`,
        `tel_cus`,
        `email_cus`,
        `hotel_where`,
        `room_type`,
        `amount_room`,
        `cus_detail`,
        `image_cus`,
        `promotion_code`)
        VALUES (NULL, 
        '$book_id_real',  
        '$code_member',
        '$checkintime',
        '$checkouttime',
        '$cus_name',
        '$tel_cus',
        '$email_cus',
        '$hotel_where',
        '$room_type',
        '$amount_room',
        '$cus_detail',
        '$image_cus',
        '$promotion_code');";

            $result_insert = mysqli_query($conn, $query_insert_data);

            if ($result_insert) {

              $query_update =  "UPDATE `list_order_booking` SET `status_booking` = '1' WHERE `list_order_booking`.`id` = $save_book_id;";
              $query_update_run = mysqli_query($conn, $query_update);

              $_SESSION['success'] = "ทำการยันยืนการชำระเงินเสร็จสิ้น";
              $message_nointo =  $_SESSION['success'];
              echo "<script>alert('$message_nointo'); window.location.href='list_book_owner.php';</script>";
            } else {
              $_SESSION['error'] = "เกิดข้อผิดพลางบางอย่าง";
              $message_nointo = $_SESSION['error'];
              echo "<script>alert('$message_nointo'); window.location.href='list_book_owner.php';</script>";
            }
          }

          if (isset($_POST['cancel_booking'])) {

            $main_id = $_POST['insert_comm_0'];
            $hotel_where = $_POST['insert_comm_8'];
            $room_type = $_POST['insert_comm_9'];
            $amount_room = $_POST['insert_comm_10'];

            $row_update_room_amount_1 = $amount_room;

            $srm_conn = "SELECT * FROM `room_data` WHERE `hotel_where` = '$hotel_where' AND `room_type` = '$room_type'";
            $srm_run = mysqli_query($conn, $srm_conn);
            $srm_row = mysqli_fetch_assoc($srm_run);

            $room_amount_cus = $srm_row['room_amount'];

            $room_amount_cus_final = $room_amount_cus - $row_update_room_amount_1;

            $query_update = "UPDATE room_data SET   
    room_amount = '$room_amount_cus_final'
    WHERE `room_data`.`hotel_where` = '$hotel_where' AND `room_type` = '$room_type'";

            $query_update_run = mysqli_query($conn, $query_update);

            if ($query_update_run) {

              $query = "DELETE FROM list_order_booking WHERE id = $main_id";
              $result_table = mysqli_query($conn, $query);

              $_SESSION['success'] = "ทำการยกเลิกเสร็จสิ้น";
              $message_nointo =  $_SESSION['success'];
              echo "<script>alert('$message_nointo'); window.location.href='list_book_owner.php';</script>";
            } else {
              $_SESSION['error'] = "เกิดข้อผิดพลางบางอย่าง";
              $message_nointo = $_SESSION['error'];
              echo "<script>alert('$message_nointo'); window.location.href='list_book_owner.php';</script>";
            }
          }


          ?>

          <link rel="stylesheet" href="assets/css/main.css" />
          <link rel="stylesheet" href=https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css>
          <link rel="stylesheet" href="assets/css/lineicons.css" />
          <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" />
          <link rel="stylesheet" href="assets/css/fullcalendar.css" />

          <div class="col-lg m-auto booking" style="width: 100%;">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive mt-3">
                  <table id="example" class="table table-striped" style="width:100%">

                    <thead>
                      <tr>
                        <th scope="col">โรงแรม</th>
                        <th scope="col">ประเภท</th>
                        <th scope="col">ห้อง</th>
                        <th scope="col">เช็คอิน</th>
                        <th scope="col">เช็คเอาท์</th>
                        <th scope="col">ชื่อผู้จอง</th>
                        <th scope="col">ยอดทั้งหมด</th>
                        <th scope="col">สถานะ</th>
                        <th scope="col" class="text-center">เเสดงข้อมูล</th>
                        <th scope="col" class="text-center">ยืนยันข้อมูล</th>
                        <th scope="col" class="text-center">ยกเลิกการจอง</th>
                        <th scope="col" class="text-center">เช็คเอาท์</th>
                      </tr>
                      <tr>
                        <th scope="col">รหัสจอง</th>
                        <th scope="col">ประเภท</th>
                        <th colspan="11" class="text-center"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      $query_hotel =  " SELECT room_data.id as rdt_id, room_data.room_id as rdt_rid, room_data.hotel_where as rdt_htw, room_data.room_type as rdt_rt, room_data.status as rdt_st, list_order_booking.id as lob_id, list_order_booking.* FROM room_data 
                                                  LEFT JOIN list_order_booking ON room_data.room_id = list_order_booking.room_day AND room_data.hotel_where = list_order_booking.hotel_where AND room_data.room_type = list_order_booking.room_type AND room_data.status = list_order_booking.room_status
                                                  ORDER BY room_data.hotel_where, room_data.room_type DESC, room_data.room_id ASC;
                                                ";
                      $query_run_hotel = mysqli_query($conn, $query_hotel);

                      if (mysqli_num_rows($query_run_hotel) > 0) {
                        foreach ($query_run_hotel as $row) {
                      ?>
                          <tr>
                            <td> <?= $row['rdt_htw'] ?> </td>
                            <td> <?= $row['rdt_rt'] ?> </td>
                            <td> <?= $row['rdt_rid'] ?> </td>
                            <td> <?= $row['checkintime'] ?> </td>
                            <td> <?= $row['checkouttime'] ?> </td>
                            <td> <?= $row['cus_name'] ?> </td>
                            <td> <?= number_format($row['total_price'] , 2)  ?> </td>
                            <td>
                              <?php
                              if (($row['rdt_st']) == "0") {
                                echo "ห้องว่าง";
                              } else if (($row['rdt_st']) == "1") {
                                echo "เข้าพักแล้ว";
                              } else {
                                echo "จอง รอการยืนยัน";
                              }
                              ?>
                            </td>

                            <td class="text-center" style="width: 80px;">
                              <form action="list_book_show_img_owner.php" method="POST" enctype="multipart/form-data">
                                <div class="hide">

                                  <input type="hidden" class="form-control" id="Input_Text" name="raw_img_time" value="<?= $row['receipt_time'] ?>">
                                  <input type="hidden" class="form-control" id="Input_Text" name="raw_img_no" value="<?= $row['receipt_no'] ?>">
                                  <input type="hidden" class="form-control" id="Input_Text" name="raw_img_who" value="<?= $row['receipt_who'] ?>">
                                  <input type="hidden" class="form-control" id="Input_Text" name="raw_img" value="<?= $row['slip_img'] ?>">
                                  <input type="hidden" class="form-control" id="Input_Text" name="raw_bank_type" value="<?= $row['bank_type'] ?>">
                                  <input type="hidden" class="form-control" id="Input_Text" name="raw_status_booking" value="<?= $row['status_booking'] ?>">
                                  <input type="hidden" class="form-control" id="Input_Text" name="raw_cusname" value="<?= $row['cus_name'] ?>">
                                  <input type="hidden" class="form-control" id="Input_Text" name="raw_total_price" value="<?= $row['total_price'] ?>">
                                  <input type="hidden" class="form-control" id="Input_Text" name="raw_room_day_total" value="<?= $row['room_day_total'] ?>">
                                  <input type="hidden" class="form-control" id="Input_Text" name="raw_room_type" value="<?= $row['room_type'] ?>">

                                </div>
                              </form>

                              <?php 
                              if (($row['rdt_st']) != '2'){
                                $set_dis = "disabled";
                              }else{

                              }
                              // echo '<a class="btn btn-lg btn-primary m-0" style="padding-left: 10px; padding-right: 10px; padding-top: 4px; padding-bottom: 4px;" onclick="loadAndShowModal(\''.$row['book_id'].'\');"><i class="lni lni-library"></i></a>'
                              echo '<a class="btn btn-lg btn-primary '.(($row['rdt_st'] == '0' || $row['rdt_st'] == '0') ? 'disabled' : '').' m-0" style="padding-left: 10px; padding-right: 10px; padding-top: 4px; padding-bottom: 4px;" onclick="loadAndShowModal(\''.$row['book_id'].'\');"><i class="lni lni-library"></i></a>';
                              ?>
                            </td>

                            </td>

                            <td class="text-center" style="width: 80px;">
                              <a class="btn btn-success"  <?= ($row['rdt_st'] != '2') ? $disabled : '' ?> href="index_backend_owner_NEW.php?book_id=<?= $row['book_id']; ?>&receipt_no=<?= $row['receipt_no']; ?>&Stats=cf" onclick="return confirm('คุณต้องการยืนยันการจองใช่ใหม?')"><i class="lni lni-wallet"></i></a>
                            </td>

                            <td class="text-center" style="width: 80px;">
                              <a class="btn btn-warning" <?= ($row['rdt_st'] != '2') ? $disabled : '' ?> href="index_backend_owner_NEW.php?book_id=<?= $row['book_id']; ?>&receipt_no=<?= $row['receipt_no']; ?>&Stats=ucf" onclick="return confirm('คุณต้องการยกเลิกการจองใช่ใหม?')"><i class="lni lni-close"></i></a>
                            </td>

                            <td class="text-center" style="width: 80px;">
                              <a class="btn btn-info" <?= ($row['rdt_st'] != '1') ? $disabled : '' ?> href="index_backend_owner_NEW.php?book_id=<?= $row['book_id']; ?>&receipt_no=<?= $row['receipt_no']; ?>&Stats=co" onclick="return confirm('คุณต้องการเช็คเอาท์ใช่ใหม ?')"><i class="lni lni-exit"></i></a>
                            </td>

                          </tr>
                      <?php
                        }
                      }
                      ?>

                    </tbody>

                  </table>
                </div>
              </div>
            </div>
          </div>

          <div id="contianer_modals"></div>

          <script>
            function check_receipt() {
              var date_test_1 = "<?php echo $row['id'] ?>"
              var show_test_here = "100"
              document.getElementById("show_test_username").value = date_test_1;
            }
          </script>



          <?php mysqli_close($conn); ?>

          <!-- ? ---------------------------------- End Script ---------------------------------- -->
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

          <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
          <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
          <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

          <script>
            $(document).ready(function() {
              $('#example').DataTable({
                iDisplayLength: 50,
                lengthMenu: [
                  [10, 25, 50, -1],
                  [10, 25, 50, "All"]
                ],
                orderCellsTop: true,
                initComplete: function() {
                  this.api().columns(0).every(function() {
                    var column = this;
                    var select = $('<select class="form-select form-select-sm"></select>')
                      .appendTo($("#example thead tr:eq(1) th").eq(column.index()).empty())
                      .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex(
                          $(this).val()
                        );

                        column
                          .search(val ? '^' + val + '$' : '', true, false)
                          .draw();
                      });

                    column.data().unique().sort().each(function(d, j) {
                      select.append('<option value="' + d + '">' + d + '</option>');
                    });
                  });
                  this.api().columns(1).every(function() {
                    var column = this;
                    var select = $('<select class="form-select form-select-sm mx-3"></select>')
                      .appendTo($("#example thead tr:eq(1) th").eq(column.index()).empty())
                      .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex(
                          $(this).val()
                        );

                        column
                          .search(val ? '^' + val + '$' : '', true, false)
                          .draw();
                      });

                    column.data().unique().sort().each(function(d, j) {
                      select.append('<option value="' + d + '">' + d + '</option>');
                    });
                  });
                }
              });
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

          <!-- ? ---------------------------------- End Script ---------------------------------- -->

        </div>
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

      <script>
        function loadAndShowModal(book_id) {
          // ตัวแปรที่ต้องการส่งไปที่ modal
          var post = new Object();
          post.book_id = book_id

          // โหลดข้อมูลไฟล์ modals.php มาที่ contianer_modals และส่งตัวแปรแบบ post ไปให้ด้วย หลังจากโหลดเสร็จ ค่อยสั่งให้ modal แสดงผล
          $('#contianer_modals').load('modal_index_new.php', post, function() {
            $("#modal").modal('show');
          });
        }
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