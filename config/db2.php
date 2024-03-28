<?php
function connect_db($type=0){

	$con  = mysqli_connect("localhost","root","","beta");#CONNECTบน PC

	mysqli_set_charset($con,"utf8"); #กำหนดชุดถอดรหัสตัวอักษรเพื่อให้รองรับภาษาไทย
	return $con; 


}
?>