<?php

require_once 'config/db.php';
include("./Template-backend/HeaderNonDOT.php");

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
    $ipRoomId = $_POST['ipRoomId'];
    $ipHotel = $_POST['ipHotel'];
    $ipType = $_POST['ipType'];
    $ipDetail = $_POST['ipDetail'];
    $ipEtc = $_POST['ipEtc'];
    $ipPrice = $_POST['ipPrice'];
    $qty_RoomData = " INSERT INTO `room_data` (`room_id`, `hotel_where`, `room_type`, `room_detail`, `room_etc`, `room_price`) 
                      VALUES ('$ipRoomId','$ipHotel','$ipType','$ipDetail','$ipEtc','$ipPrice');
                    ";
    $resRoom = mysqli_query($conn, $qty_RoomData);
    if ($resRoom) {
      echo "<script>alert('เพิ่มห้องพักสำเร็จ'); window.location.href='index_manager_room.php';</script>";
    }
  } else if (isset($_POST['editData'])) {
    $ipId = $_POST['ipId'];
    $ipHotel = $_POST['ipHotel'];
    $ipType = $_POST['ipType'];
    $ipDetail = $_POST['ipDetail'];
    $ipEtc = $_POST['ipEtc'];
    $ipPrice = $_POST['ipPrice'];
    $qty_RoomData = "UPDATE `room_data` SET `hotel_where`='$ipHotel',`room_type`='$ipType',`room_detail`='$ipDetail',`room_etc`='$ipEtc',`room_price`='$ipPrice' WHERE id='$ipId';";
    $resRoom = mysqli_query($conn, $qty_RoomData);
    if ($resRoom) {
      echo "<script>alert('แก้ไขข้อมูลห้องพักสำเร็จ'); window.location.href='index_manager_room.php';</script>";
    }
  } else if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'del') {
    $id = $_GET['id'];
    $result = mysqli_query($conn, "DELETE FROM `room_data` WHERE id ='$id'");
    echo "<script>alert('ลบห้องพักสำเร็จ'); window.location.href='index_manager_room.php';</script>";
  }

?>

  <title>เจ้าของกิจการ/แอดมิน <?php echo "คุณ : " . $_SESSION['first_name'] ?></title>

  <link rel="stylesheet" href=https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css>

  <!-- ========== section start ========== -->
  <section class="section">
    <div class="container-fluid">
      <!-- ========== title-wrapper start ========== -->
      <div class="title-wrapper pt-30">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="title mb-30">
              <h2>ข้อมูลห้องพัก</h2>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="col-lg-12 col-md-12 text-end m-0 p-0">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="float: right;">
                  เพิ่มห้องพัก
                </button>
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
            <div class="row">

              <div class="col-lg m-auto booking" style="width: 100%;">
                <div class="table-responsive mt-3">
                  <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                      <tr>
                        <th scope="col">โรงแรม</th>
                        <th scope="col">ประเภท</th>
                        <th scope="col">ห้อง</th>
                        <th scope="col">รายละเอียด</th>
                        <th scope="col">สิ่งอำนวยความสะดวก</th>
                        <th scope="col">ราคา</th>
                        <th scope="col" class="text-center">Action</th>
                      </tr>
                      <tr>
                        <th scope="col">รหัสจอง</th>
                        <th scope="col">ประเภท</th>
                        <th colspan="5" class="text-center"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      $query_hotel =  " SELECT `room_data`.*, `list_order_booking`.book_id FROM `room_data` 
                                                  LEFT JOIN list_order_booking ON room_data.room_id = list_order_booking.room_day AND room_data.hotel_where = list_order_booking.hotel_where AND room_data.room_type = list_order_booking.room_type AND room_data.status = list_order_booking.room_status
                                                  ORDER BY room_data.hotel_where, room_data.room_type DESC, room_data.room_id ASC;
                                                ";
                      $query_run_hotel = mysqli_query($conn, $query_hotel);
                      if (mysqli_num_rows($query_run_hotel) > 0) {
                        foreach ($query_run_hotel as $row) {
                      ?>
                          <tr>
                            <td> <?= $row['hotel_where'] ?> </td>
                            <td> <?= $row['room_type'] ?> </td>
                            <td> <?= $row['room_id'] ?> </td>
                            <td> <?= $row['room_detail'] ?> </td>
                            <td> <?= $row['room_etc'] ?> </td>
                            <td> <?= $row['room_price'] ?> </td>
                            <td class="text-center">
                              <button type="button" id="modelData" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalEdit" data-bs-id="<?= $row['id']; ?>" data-bs-room_id="<?= $row['room_id']; ?>" data-bs-hotel="<?= $row['hotel_where']; ?>" data-bs-type="<?= $row['room_type']; ?>" data-bs-detail="<?= $row['room_detail']; ?>" data-bs-etc="<?= $row['room_etc']; ?>" data-bs-price="<?= $row['room_price']; ?>"><i class="lni lni-cut"></i></button>
                              <a class="btn btn-danger" <?= ($row['book_id'] != NULL) ? $disabled : '' ?> href="index_manager_room.php?action=del&id=<?php echo $row['id']; ?>" onclick="return confirm('คุณต้องการลบห้องพักใช่ใหม ?')"><i class="lni lni-trash-can"></i></a>
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

                  <div class="col-md-6">
                    <div class="form-floating">
                      <select class="form-select" id="ipHotel" name="ipHotel">
                        <option value="faikham_hotel"> Faikham Hotel </option>
                        <option value="faikham_boutique"> Faikham Boutique </option>
                      </select>
                      <label for="ipHotel">เลือกโรงแรม</label>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-floating">
                      <select class="form-select" id="ipType" name="ipType">
                        <option value="normal"> ห้องพักขนาดปกติ </option>
                        <option value="deluxe_room"> ห้องพักขนาดพิเศษ </option>
                      </select>
                      <label for="ipType">เลือกประเภทห้อง</label>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-floating">
                      <input type="text" class="form-control" id="ipRoomId" placeholder="ห้องพัก" name="ipRoomId">
                      <label for="ipRoomId">ห้องพัก</label>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-floating">
                      <input type="text" class="form-control" id="ipDetail" placeholder="รายละเอียด" name="ipDetail">
                      <label for="ipDetail">รายละเอียด</label>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-floating">
                      <input type="text" class="form-control" id="ipEtc" placeholder="สิ่งอำนวยความสะดวก" name="ipEtc">
                      <label for="ipEtc">สิ่งอำนวยความสะดวก</label>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-floating">
                      <input type="text" class="form-control" id="ipPrice" placeholder="ราคา" name="ipPrice">
                      <label for="ipPrice">ราคา</label>
                    </div>
                  </div>

                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> ยกเลิก </button>
              <button type="submit" class="btn btn-success" name="addData"> เพิ่มห้องพัก </button>
            </div>
          </div>
        </div>
      </form>
    </div>

    <div class="modal fade" id="ModalEdit" tabindex="-1" aria-labelledby="ModalEditLabel" aria-hidden="true">
      <form name="frmSearch" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h2 class="modal-title" id="ModalEditLabel"> เพิ่มห้องพัก </h2>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" class="form-control" id="ipId" name="ipId">
              <div class="wow fadeInUp" data-wow-delay="0.2s">
                <div class="row g-3">

                  <div class="col-md-6">
                    <div class="form-floating">
                      <select class="form-select" id="ipHotel" name="ipHotel">
                        <option value="faikham_hotel"> Faikham Hotel </option>
                        <option value="faikham_boutique"> Faikham Boutique </option>
                      </select>
                      <label for="ipHotel">เลือกโรงแรม</label>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-floating">
                      <select class="form-select" id="ipType" name="ipType">
                        <option value="normal"> ห้องพักขนาดปกติ </option>
                        <option value="deluxe_room"> ห้องพักขนาดพิเศษ </option>
                      </select>
                      <label for="ipType">เลือกประเภทห้อง</label>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-floating">
                      <input type="text" class="form-control" id="ipDetail" placeholder="รายละเอียด" name="ipDetail">
                      <label for="ipDetail">รายละเอียด</label>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-floating">
                      <input type="text" class="form-control" id="ipEtc" placeholder="สิ่งอำนวยความสะดวก" name="ipEtc">
                      <label for="ipEtc">สิ่งอำนวยความสะดวก</label>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-floating">
                      <input type="text" class="form-control" id="ipPrice" placeholder="ราคา" name="ipPrice">
                      <label for="ipPrice">ราคา</label>
                    </div>
                  </div>

                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> ยกเลิก </button>
              <button type="submit" class="btn btn-success" name="editData"> บันทึกการแก้ไข </button>
            </div>
          </div>
        </div>
      </form>
    </div>

    <script>
      var exampleModal = document.getElementById('ModalEdit')
      exampleModal.addEventListener('show.bs.modal', function(event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var id = button.getAttribute('data-bs-id')
        var room_id = button.getAttribute('data-bs-room_id')
        var hotel = button.getAttribute('data-bs-hotel')
        var type = button.getAttribute('data-bs-type')
        var detail = button.getAttribute('data-bs-detail')
        var etc = button.getAttribute('data-bs-etc')
        var price = button.getAttribute('data-bs-price')

        var mdTitle = exampleModal.querySelector('.modal-title')
        var mdId = exampleModal.querySelector('.modal-body input#ipId')
        var mdHotel = exampleModal.querySelector('.modal-body select#ipHotel')
        var mdType = exampleModal.querySelector('.modal-body select#ipType')
        var mdDetail = exampleModal.querySelector('.modal-body input#ipDetail')
        var mdEtc = exampleModal.querySelector('.modal-body input#ipEtc')
        var mdPrice = exampleModal.querySelector('.modal-body input#ipPrice')

        mdTitle.textContent = 'ห้องพัก ' + room_id
        mdId.value = id
        mdHotel.value = hotel
        mdType.value = type
        mdDetail.value = detail
        mdEtc.value = etc
        mdPrice.value = price

      });
    </script>