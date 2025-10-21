<?php  

	$conn = mysqli_connect("localhost","root","","db_asbao");
	if (mysqli_connect_errno()){
		echo "Failed to connect to database ".mysqli_connect_error();
	}
?>