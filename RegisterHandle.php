<?php

	// $con = mysqli_connect("localhost", "root", "", "hfpl_db");
	$con = mysqli_connect("sql300.ultimatefreehost.in", "ltm_19353243", "ashok007", "ltm_19353243_hfpl_1");
	if(!$con){ die("Connction error"); }
	
	if($_GET['command']=="is_user_name_exists")
	{
		$new_user_name = $_GET['new_user'];
		$result = mysqli_query($con,"SELECT user_name FROM tbl_users where user_name='$new_user_name'");
		if($result->num_rows >= 1)
			echo "reserved";	
		else
			echo "available";
	}
	else if($_GET['command']=="register")
	{
		$user_name=$_GET['user_name'];
		$pwd=$_GET['pwd'];
		mysqli_query($con,"INSERT INTO tbl_users (user_name, pwd) VALUES('$user_name','$pwd')");
		echo "registered";
	}
	
	mysqli_close($con);

?>