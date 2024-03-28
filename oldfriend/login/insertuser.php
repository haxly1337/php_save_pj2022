<?php
	require("../config/db.php");
    $con = connect_db(0);

	mysqli_query($con,"INSERT INTO all_user(code_member,first_name,last_name,username,
	passwrd,email,tel,addres,address_county,address_district1,address_district2,address_zipcode,roles,salary) 
    VALUES ('$_POST[codee]','$_POST[cus_name]','$_POST[cus_lastname]','$_POST[cus_username]',
	'$_POST[cus_password]','$_POST[cus_email]','$_POST[cus_tel]','$_POST[cus_address]','$_POST[cus_address_county]',
	 '$_POST[cus_address_district]','$_POST[cus_address_district_2]','$_POST[cus_address_zipcode]','$_POST[cus_role]','$_POST[cus_sala]')")
    or die(mysqli_error($con));

	mysqli_close($con);
	header("Location:../login/login.php");
?>