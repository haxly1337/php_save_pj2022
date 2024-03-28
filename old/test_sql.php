<?php
    require_once 'config/db.php';
    
    
    $qty_EmptyRoom = "SELECT count(room_id) as count FROM `room_data` WHERE status = 0;";
    $res_EmptyRoom = mysqli_query($conn, $qty_EmptyRoom);
    $countRoom = mysqli_fetch_assoc($res_EmptyRoom);

    echo $countRoom['count'];

?>


