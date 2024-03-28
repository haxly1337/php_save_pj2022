<?php
	require("../config/db2.php");
    $conn = connect_db(0);

    $cus_username = $_POST['cus_username'];
    $cus_password = $_POST['cus_password'];
    $cus_name = $_POST['cus_name'];
    $cus_lastname = $_POST['cus_lastname'];
    $cus_email = $_POST['cus_email'];
    $cus_tel = $_POST['cus_tel'];
    $cus_address = $_POST['cus_address'];
    $cus_address_county = $_POST['cus_address_county'];
    $cus_address_district = $_POST['cus_address_district'];
    $cus_address_district_2 = $_POST['cus_address_district_2'];
    $cus_address_zipcode = $_POST['cus_address_zipcode'];

    $check_id = "SELECT * FROM all_user ORDER BY id DESC LIMIT 1";
    $check_result = mysqli_query($conn, $check_id);

    if (mysqli_num_rows($check_result) > 0) {
        if ($row = mysqli_fetch_assoc($check_result)) { {

                $code_member_id = $row['id'];
                $get_number = str_replace("", "", $code_member_id);
                $id_inc = $get_number + 1;
                $get_string = str_pad($id_inc, 5, 0, STR_PAD_LEFT);
                $code_member_id_real = $get_string;
            }
        }
    }

    $sql_u = "SELECT * FROM all_user WHERE username='$cus_username'";
    $sql_e = "SELECT * FROM all_user WHERE email='$cus_email'";

    $res_u = mysqli_query($conn, $sql_u);
    $res_e = mysqli_query($conn, $sql_e);

    if (mysqli_num_rows($res_u) > 0) {
      $name_error = "ชื่อผู้ใช้งานนี้มีผู้อื่นใช้ไปเเล้ว"; 	
      echo "<script>alert('$name_error'); window.location.href='login.php';</script>";
    }else if(mysqli_num_rows($res_e) > 0){
      $email_error = "อีเมลนี้มีผู้อื่นใช้ไปเเล้ว"; 	
      echo "<script>alert('$email_error'); window.location.href='login.php';</script>";
    }else{
        $query_register = "INSERT INTO `all_user` (`id`, `code_member`, `first_name`, `last_name`, `username`, `password`, `email`, `tel`, `img`, `address`, `address_county`, `address_district`, `address_district2`, `address_zipcode`, `role`, `salary`) 
        VALUES (NULL, '$code_member_id_real', '$cus_name', '$cus_lastname', '$cus_username', '$cus_password', '$cus_email', '$cus_tel', 'no-ing.png', '$cus_address', '$cus_address_county', '$cus_address_district', '$cus_address_district_2', '$cus_address_zipcode', 'mem', '0');";
        $query_run = mysqli_query($conn, $query_register);
        if ($query_run) {
            $_SESSION['success'] = "สมัครเข้าใช้งานเสร็จสิ้น";
            $message_nointo =  $_SESSION['success'];
            echo "<script>alert('$message_nointo'); window.location.href='../index.php';</script>";
        } else {
            $_SESSION['error'] = "มีบางอย่างผิดพลาด";
            $message_nointo = $_SESSION['error'];
            echo "<script>alert('$message_nointo'); window.location.href='login.php';</script>";
        }
    }

	// mysqli_query($con,"INSERT INTO all_user(code_member,first_name,last_name,username,
	// passwrd,email,tel,addres,address_county,address_district1,address_district2,address_zipcode,roles,salary) 
    // VALUES ('$_POST[codee]','$_POST[cus_name]','$_POST[cus_lastname]','$_POST[cus_username]',
	// '$_POST[cus_password]','$_POST[cus_email]','$_POST[cus_tel]','$_POST[cus_address]','$_POST[cus_address_county]',
	//  '$_POST[cus_address_district]','$_POST[cus_address_district_2]','$_POST[cus_address_zipcode]','$_POST[cus_role]','$_POST[cus_sala]')")
    // or die(mysqli_error($con));
	
	mysqli_close($con);
