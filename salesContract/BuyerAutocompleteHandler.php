<?php
	
	session_start();
	$con = mysqli_connect("localhost", "root", "", "hfpl_db");
	if(!$con){ die("Connction error"); }
	
	if(!isset($_SESSION['user_name']))
	{
		echo "<b>Warning:</b> Invalid login attempt!";
		exit(0);
	}
	
	if (isset($_GET['term']))
	{
		$return_arr = array();
		try 
		{
			$term = $_GET['term'];
			if($term == "*")
			{
				$result = mysqli_query($con,"SELECT distinct(buyer_name) FROM tbl_buyers");
			}
			else
			{
				$result = mysqli_query($con,"SELECT distinct(buyer_name) FROM tbl_buyers WHERE buyer_name LIKE '%$term%'");
			}
			
			while($row = mysqli_fetch_array($result))
			{
			  $return_arr[]=$row['buyer_name'];
			}
		} catch(PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
		}


		/* Toss back results as json encoded array. */
		echo json_encode($return_arr);
	}
	
	mysqli_close($con);
?>