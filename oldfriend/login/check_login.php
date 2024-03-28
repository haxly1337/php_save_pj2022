<?php
session_start();
	require("../config/db.php");
$con = connect_db(0);

	$user_form=$_POST['username'];
	$pwd_form=$_POST['passwd'];

	$user=mysqli_query($con,"SELECT * FROM 	all_user WHERE username='$user_form' AND passwrd='$pwd_form'" )or die(mysqli_error());
	list($code_member,$first_name,$last_name,$username,$passwrd,$email,$tel,$address,$address_county,$address_district1,$address_district2,$address_zipcode,$roles,$salary)=mysqli_fetch_row($user);

	if ($user_form==$username and $pwd_form==$passwrd) {
		//echo "LOGIN OK เก่งมากเลย ";
		$_SESSION['user_id']=$code_member;
		$_SESSION['user_Name']=$first_name;
		$_SESSION['valid_user']=$username;
		$_SESSION['user_Position']=$roles; 


		//echo "<script>alert('ยินดีต้อนรับเข้าสู่ระบบ')</script>";
		if ($_SESSION['user_Position']=="owner") {
			echo "<script>window.location ='../owner/indexmember.html'</script>";
		}
		else if($_SESSION['user_Position']=="mana"){
			echo "<script>window.location ='../menager/checkin.php'</script>";
		}
		else if($_SESSION['user_Position']=="emp"){
			echo "<script>window.location ='../employee/checkin.php'</script>";
		}
		else {
             echo "<script>window.location ='../member/indexmember.php'</script>";
		}
		
	}
	else{
		//echo "LOGIN FAIL";
		$_SESSION['valid_user']="";
		echo "<script>alert('คุณกรอก username หรือ password ไม่ถูกต้อง')</script>";
		echo "<script>window.location='login.php'</script>";
	}
	 mysqli_free_result($user);
	 mysqli_close($con);

?>