<?php

 require_once 'config/db.php';

    $id = $_GET['id'];
    
    $query = "DELETE FROM customer_data WHERE id = $id";
    $result_table = mysqli_query($conn, $query);

    if($result_table) {
        echo "<script>";
        echo "alert('ทำการลบข้อมูลเเล้ว');";
        echo "window.location.href='show_all_book_mana.php';";
        echo "</script>";
    }else {
        echo "<script>alert('เกิดข้อผิดพลาดขึ้น'); window.location.href='show_all_book_mana.php';</script>";
    }

    

?>