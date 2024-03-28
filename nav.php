<!--! ---------------------------------- Head Bar Start ---------------------------------- -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="m-auto d-sm-flex d-block flex-sm-nowrap p-auto">
            <a class="navbar-brand" href="index.php">Faikham Hotel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample11" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="room_information.php">ข้อมูลห้องพัก</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="promotion.php">โปรโมชั่น</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="news_report_data.php">ข่าวสาร</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">รีวิว</a>
                    </li>
                    <li class="nav-item">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary m-auto mt-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Book Now
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Book Now</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <form action="booknow_guest.php" method="get" enctype="multipart/form-data">
                                        <div class="modal-body">

                                            <!--* Slot 1 -->
                                            <div class="mt-2">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="birthday" class="form-label">วันที่เข้าพัก</label>
                                                        <input type="date" class="form-control datepicker" id="birthday" name="checkintime_guest" autocomplete="off" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="birthday" class="form-label">วันที่ออกที่พัก</label>
                                                        <input type="date" class="form-control datepicker" id="birthday" name="checkouttime_guset" autocomplete="off" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--* Slot 1 -->
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" type="submit" name="submit" value="submit">Next</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                    </li>
                    
                    <?php
                    if (!isset($_SESSION['userid'])) { ?>

                        <li class="nav-item">
                            <a class="btn btn-primary mt-1 ms-2" href="login_and_register.php">Login</a>
                        </li>

                    <?php
                    } else { ?>


                        <div class="dropdown">
                            <a class="btn text-dark dropdown-toggle mt-1" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                คุณ : <?php echo $save_user_first_name . " " . $save_user_last_name ?>
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="info_me_mem.php">ข้อมูลส่วนตัว</a></li>
                                <li><a class="dropdown-item" href="index_logout.php">ออกจากระบบ</a></li>
                            </ul>
                        </div>



                    <?php
                    }
                    ?>

                </ul>
            </div>
        </div>
    </nav>

    <!--! ---------------------------------- Head Bar End ----------------------------------  -->