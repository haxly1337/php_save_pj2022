<?php
    require_once 'config/db.php';
    
    $id=$_GET['id'];
    mysqli_query($conn,"delete from `user` where userid='$id'");
    header('location:index_backend_owner_NEW.php');
?>