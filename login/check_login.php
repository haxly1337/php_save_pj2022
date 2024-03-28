<?php
session_start();
	require("../config/db2.php");
	$con = connect_db(0);

	$user_form=$_POST['username'];
	$pwd_form=$_POST['passwd'];

	$user=mysqli_query($con,"SELECT * FROM all_user WHERE username='$user_form' AND password='$pwd_form'" );
	list($id,$code_member,$first_name,$last_name,$username,$passwrd,$email,$tel,$address,$address_county,$address_district1,$address_district2,$address_zipcode,$roles,$salary)=mysqli_fetch_row($user);

	if ($user_form==$username and $pwd_form==$passwrd) {
		//echo "LOGIN OK เก่งมากเลย ";
		$_SESSION['id']=$id;
		$_SESSION['user_id']=$code_member;
		$_SESSION['user_Name']=$first_name;
		$_SESSION['valid_user']=$username;
		$_SESSION['profile_pic']='c1_1937552_200619122619.jpg';
		$_SESSION['user_Position']=$roles; 
		$_SESSION['code_member']=$code_member;
		$_SESSION['first_name']=$first_name;
		$_SESSION['last_name']=$last_name;

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
             echo "<script>window.location ='../index.php'</script>";
		}
		
	}
	else{
		//echo "LOGIN FAIL";
		$_SESSION['valid_user']="";
		echo "SELECT * FROM all_user WHERE username='$user_form' AND passwrd='$pwd_form'<br><br><br><br><br><br>";
		echo $username;
		echo "<script>alert('คุณกรอก username หรือ password ไม่ถูกต้อง')</script>";
		echo "<script>window.location='login.php'</script>";
	}
	 mysqli_free_result($user);
	 mysqli_close($con);

?>