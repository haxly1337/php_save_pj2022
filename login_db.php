<?php

require_once('config/db.php');
session_start();

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username)) {
        $_SESSION['error'] = 'กรุณากรอบชื่อผู้ใช้';
        header("location: logintoblackend.php");
    } else if (empty($password)) {
        $_SESSION['error'] = 'กรุณากรอบรหัสผ่าน';
        header("location: logintoblackend.php");
    } else {
        try {

            $query = "SELECT * FROM all_user WHERE username ='$username' AND password = '$password'";
            // echo '      '.$username.'      '.$password;
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result);

                $_SESSION['userid'] = $row['id'];
                $_SESSION['code_member'] = $row['code_member'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['last_name'] = $row['last_name'];
                $_SESSION['role'] = $row['role'];

                if ($_SESSION['role'] == 'admin') {
                    header("location: index_test_showing.php");
                } else if ($_SESSION['role'] == 'emp') {
                    header("location: index_backend_emp.php");
                } else if ($_SESSION['role'] == 'mana') {
                    header("location: index_backend_manager.php");
                } else if ($_SESSION['role'] == 'owner') {
                    header("location: index_backend_owner_NEW.php");
                } else {
                    $message_nointo = "ผู้ใช้ไม่สามารถเข้าสู่ระบบหลังบ้านได้";
                    echo "<script type='text/javascript'>alert('$message_nointo ');</script>";
                    header("location: logintoblackend.php");
                }
            } else {
                $message_wronguserorpassword = "User หรือ Password ไม่ถูกต้อง";
                echo "<script type='text/javascript'>alert('$message_wronguserorpassword ');</script>";
                header("location: logintoblackend.php");
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

    }
}
