<?php
	
	session_start();
	$con = mysqli_connect("localhost", "root", "", "hfpl_db");
	// $con = mysqli_connect("sql300.ultimatefreehost.in", "ltm_19353243", "ashok007", "ltm_19353243_hfpl_1");
	if(!$con){ die("Connction error"); }
	
	$user_name = $_GET['user_name'];
	$pwd = $_GET['pwd'];
		
		$result = mysqli_query($con,"SELECT * FROM tbl_users where pwd='$pwd' and user_name='$user_name'");

		if($result->num_rows >= 1)
		{
			echo "login";
			//setcookie('user_name', $user_name, time() + 14400, '/');
			$_SESSION['user_name']=$user_name;
		}	
		else
		{
			echo "fail";
			unset($_SESSION['user_name']);
		}

	
	mysqli_close($con);
?>