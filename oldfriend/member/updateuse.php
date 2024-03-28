<?php
		require("../config/db.php");
	$con=connect_db(0);

	mysqli_query($con,"UPDATE all_user SET 
    first_name='$_POST[cus_name]' ,last_name='$_POST[cus_lastname]',username='$_POST[cus_username]',passwrd='$_POST[cus_password]',
    email='$_POST[cus_email]',tel='$_POST[cus_tel]',addres='$_POST[cus_address]',address_county='$_POST[cus_address_county]',
    address_district1='$_POST[cus_address_district]',address_district2='$_POST[cus_address_district_2]',address_zipcode='$_POST[cus_address_zipcode]',roles='$_POST[cus_role]',
    salary='$_POST[cus_sala]'
     WHERE code_member='$_POST[codee]'")or die(mysqli_error($con));
	mysqli_close($con);
	header("Location:indexmember.php")
	
?>