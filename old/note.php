<tbody id="">
                    <?php 
                    foreach ($result_table as $row) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td>
                                <?php
                                $strDate = $row['checkintime'];
                                echo DateThai($strDate);
                                ?>
                            </td>
                            <td>
                                <?php
                                $strDate = $row['checkouttime'];
                                echo DateThai($strDate);
                                ?>
                            </td>
                            <td><?php echo $row['frist_name']; ?></td>
                            <td><?php echo $row['last_name']; ?></td>
                            <td>
                                <?php
                                if (($row['room_where']) == "normal") {
                                    $save_room = 'ห้องปกติ';
                                    echo $save_room;
                                } else if (($row['room_where']) == "deluxe_room") {
                                    $save_room = 'ห้องพิเศษ';
                                    echo $save_room;
                                } else {
                                    echo 'เกิดข้อผิดพลาด';
                                }
                                ?>
                            </td>
                            <td><a href="addwalkin_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">เเก้ไขข้อมูล</a></td>
                            <td><a href="addwalkin_del.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบข้อมูลใช่ใหม ?')">ลบข้อมูล</a></td>
                        </tr>
                    <?php
                } 
                ?>
                </tbody>






                <tbody>
                            
                            <?php 
                                if(isset($_GET['dateFirst']) && isset($_GET['dateSecond']))
                                {
                                    require_once 'config/db.php';
                                    $from_date = $_GET['dateFirst'];
                                    $to_date = $_GET['dateSecond'];

                                    $query = "SELECT * FROM users WHERE created_at BETWEEN '$from_date' AND '$to_date' ";
                                    $query_run = mysqli_query($conn, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $row)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $row['id']; ?></td>
                                                <td><?= $row['frist_name']; ?></td>
                                                <td><?= $row['last_name']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "No Record Found";
                                    }
                                }
                            ?>
                            </tbody>

            