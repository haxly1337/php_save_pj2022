<?php  

    session_start();
    session_destroy();
    $message_logout = "ออกจากระบบ";
    echo "<script type='text/javascript'>alert('$message_logout');</script>";
    header("location: logintoblackend.php");

?>