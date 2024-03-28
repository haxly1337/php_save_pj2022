<?php

    session_start();
    
    //! Role Transform //
    {
        $save_role = $_SESSION['role'];
        // IF ROLE //
        {   
            if (($save_role) == "emp" ){
                $save_role = "พนักงาน";
            }
        }
        // END IF ROLE //
    }
    //* End Role Transform //


    if (!isset($_SESSION['userid'])) {
            header('location: logintoblackend.php');
    } else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>พนักงาน <?php echo "คุณ : ".$_SESSION['first_name'] ?></title>
</head>
<body>

    <div class="container">

        <h3 class="mt-4"> ยินดีต้อนรับคุณ : <?php echo $_SESSION['first_name'] ." ". $_SESSION['last_name'] ?> สถานะ : <?php echo $save_role; ?> </h3>
        
        <p><a href="addwalkin.php">เพิ่มลูกค้าเเบบ Walkin</a></p>
        <p><a href="list_book.php">รายการจองห้องพัก</a></p>  
        
        <p><a href="logout.php">ออกจากระบบ</a></p>
    </div>
    
<?php } ?>
</body>
</html>