<?php

    session_start();
    
    if (isset($_POST["addcuswalkin"])){
        include('config/db.php');

        $number_member = $_SESSION['number_member'];
        $checkintime = $_POST['checkintime'];
        $checkouttime = $_POST['checkouttime'];
        $frist_name = $_POST['frist_name'];
        $last_name = $_POST['last_name'];
        $tel_cus = $_POST['tel_cus'];
        $email_cus = $_POST['email_cus'];
        $hotel_where = $_POST['hotel_where'];
        $room_where = $_POST['room_where'];
        $amount_room = $_POST['amount_room'];

        $image_cus2 = $_FILES['image']['name'];
        $temp_image = $_FILES['image']['tmp_name'];
        $targetinto = "img/".$image;
 
    }
    
    echo "<pre>";
    echo $image_cus2;
    echo $temp_image;
    echo "</pre>";

?>