<?php

 require_once 'config/db.php';

    $id = $_GET['id'];
    
    $query = "DELETE FROM news_report_data WHERE id = $id";
    $result_table = mysqli_query($conn, $query);

    if($result_table) {
        echo "<script>";
        echo "alert('ทำการลบข้อมูลเเล้ว');";
        echo "window.location.href='news_emp.php';";
        echo "</script>";
    }else {
        echo "<script>alert('เกิดข้อผิดพลาดขึ้น'); window.location.href='news_emp.php';</script>";
    }

    

?>