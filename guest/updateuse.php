<?php

    require_once '../config/db.php';

	mysqli_query($conn,"UPDATE all_user SET
    code_member='$_POST[codee]',
    first_name='$_POST[cus_name]' ,
    last_name='$_POST[cus_lastname]',
    username='$_POST[cus_username]',
    password='$_POST[cus_password]',
    email='$_POST[cus_email]',
    tel='$_POST[cus_tel]',
    img='$_POST[member_img]',
    address='$_POST[cus_address]',
    address_county='$_POST[cus_address_county]',
    address_district='$_POST[cus_address_district]',
    address_district2='$_POST[cus_address_district_2]',
    address_zipcode='$_POST[cus_address_zipcode]',
    role='$_POST[cus_role]',
    salary='$_POST[cus_sala]'
    WHERE id='$_POST[member_id]'")or die(mysqli_error($conn));
	
    mysqli_close($conn);
    
	header("location: ../index.php");
    $message_wronguserorpassword = "เเก้ไขข้อมูลส่วนตัวสำเร็จ";
    echo "<script type='text/javascript'>alert('$message_wronguserorpassword ');</script>";

?>