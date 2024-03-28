<?php

session_start();
require_once 'config/db.php';

//! Login Zone //
{
  if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM all_user WHERE username ='$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
      $row = mysqli_fetch_array($result);

      $_SESSION['userid'] = $row['id'];
      $_SESSION['code_member'] = $row['code_member'];
      $_SESSION['first_name'] = $row['first_name'];
      $_SESSION['last_name'] = $row['last_name'];
      $_SESSION['role'] = $row['role'];
      
      $_SESSION['Menu_1'] = 1; //User
      $_SESSION['Menu_2'] = 1; //Room
      $_SESSION['Menu_3'] = 1; //Booking
      $_SESSION['Menu_4'] = 1; //Report
      $_SESSION['Menu_5'] = 1; //Walkin

      if($row['role'] == 'owner'){
        $_SESSION['Menu_5'] = 0;
      }

      if($row['role'] == 'mana') {
        $_SESSION['Menu_4'] = 0;
      }

      if($row['role'] == 'emp') {
        $_SESSION['Menu_1'] = 0;
        $_SESSION['Menu_4'] = 0;
      }

      /*
      ** SET Default **
      $st_page_menu_1 = 1;
      $st_page_menu_2 = 0; 
      $st_page_menu_3 = 0;
      $st_page_menu_4 = 0;
      $st_page_menu_5 = 0;


      Role
        - 1 	1 - 5
        - 2		1, 3 - 5
        - 3		1, 5
        - 4		1 - 2
        - 5		1, 3 , 4

        ** CHECK ROLE **
      if(role == 1 || role == 4)	
        $st_page_menu_2 = 1;
      if(role == 1 || role == 2)
        $st_page_menu_3 = 1;

        ** MENU ACCCPT **
      if($st_page_menu_2){
        //show menu;
      }

      if($st_page_menu_3){
        //show
      }
      */

      if ($_SESSION['role'] == 'admin') {
        header("location: index_test_showing.php");
      } else if ($_SESSION['role'] == 'emp') {
        header("location: index_backend_owner_NEW.php");
      } else if ($_SESSION['role'] == 'mana') {
        header("location: index_backend_owner_NEW.php");
      } else if ($_SESSION['role'] == 'owner') {
        header("location: index_backend_owner_NEW.php");
      } else {
        $message_nointo = "ผู้ใช้ไม่สามารถเข้าสู่ระบบหลังบ้านได้";
        echo "<script type='text/javascript'>alert('$message_nointo ');</script>";
        header("Refresh:0");
      }
    } else {
      $message_wronguserorpassword = "User หรือ Password ไม่ถูกต้อง";
      echo "<script type='text/javascript'>alert('$message_wronguserorpassword ');</script>";
      header("Refresh:0");
    }
  }
}
//! End Login Zone //

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="stylesheet" href="css/cssmainend.css">

  <title>Fai Kham System</title>
</head>

<body>

  <!-- Head Bar -->

  <!-- End Head Bar -->


  <div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->

      <!-- Icon -->
      <div class="fadeIn first">
        <img src="img/5.png" id="icon" alt="User Icon" style="margin: 20px;" />
      </div>

      <!-- Login Form -->
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <input type="text" id="text_pre_1" class="fadeIn second" name="username" placeholder="ชื่อผู้ใช้งาน">
        <input type="password" id="text_pre_2" class="fadeIn third" name="password" placeholder="รหัสผ่าน">
        <input type="submit" class="fadeIn fourth" name="login" value="login">
      </form>

      <!-- Remind Passowrd -->
      <div id="formFooter">
        <a class="underlineHover" href="#">ลืมรหัสผู้ใช้ติดต่อแอดมิน</a>
      </div>

    </div>
  </div>


  <!-- End Script-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  <!-- End Script-->
</body>

</html>