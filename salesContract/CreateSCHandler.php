<?php
	
	session_start();
	$con = mysqli_connect("localhost", "root", "", "hfpl_db");
	if(!$con){ die("Connction error"); }
	
	if(!isset($_SESSION['user_name']))
	{
		echo "<b>Warning:</b> Invalid login attempt!";
		exit(0);
	}

	else if($_GET['command']=='logout')
	{
		unset($_SESSION['user_name']);
		echo "<center>Successfully logged out!";
		echo "<br><a href='../'>click here to login</a></center>";
		mysqli_close($con);
		exit(0);
	}
	else if($_GET['command']=='load_credential')
	{
		
		echo "<p align='right'><b>Welcome:</b> ".$_SESSION['user_name'];
		echo "<br><input name='command' type='button' onClick='logout()' value='logout'/></p>";
		echo "<br>";
		
	}
	else if($_GET['command']=="create_sc")
	{
		//echo "begin";
		
		$buyer=$_GET['buyer'];
		$seller=$_GET['seller'];
		$order_number=$_GET['order_number'];
		$construction=$_GET['construction'];
		$order_qty=$_GET['order_qty'];
		$supplied_qty=$_GET['supplied_qty'];
		$rate=$_GET['rate'];
		$discount=$_GET['discount'];
		$order_status=$_GET['order_status'];
		
		
		$errors = "";
		$buyer_details = mysqli_query($con,"SELECT * FROM tbl_buyers where buyer_name='$buyer'");
		$seller_details = mysqli_query($con,"SELECT * FROM tbl_sellers where seller_name='$seller'");

		//------ Validation Starts ------------------------------------------
		if($buyer_details->num_rows == 0)
		{
			$errors = "$errors <br/> *Buyer not exists";
		}
		if($seller_details->num_rows == 0)
		{
			$errors = "$errors </br> *Seller not exists";
		}
		
		if(!is_numeric($order_qty))
		{
			$errors = "$errors </br> *Order Quantity is not in number format";
		}
		if(!is_numeric($supplied_qty))
		{
			$errors = "$errors </br> *Supplied Quantity is not in number format";
		}
		
		
		if($errors == "")
		{
			// No validation error
			echo " +Validation success!";
		}
		else
		{
			echo "<span style=\"color:red;\"><u><b>Validation Errors:</u></b>".$errors."</style>";
		}
		
		/*
		$inserted = mysqli_query($con,"INSERT INTO tbl_contacts (mobile_number, landline_number, fax, address, email, website) VALUES('$mobile','$landline','$fax','$address','$email','$website')");
		if($inserted)
		{
			$result = mysqli_query($con,"SELECT max(contact_id) from tbl_contacts");
			while($row = mysqli_fetch_array($result))
			{
			  $contact_id=$row['max(contact_id)'];
			}
			$inserted2 = mysqli_query($con,"INSERT INTO tbl_buyers (buyer_name, organization_contact_id) VALUES('$buyer_name', $contact_id)");
			if($inserted2)
			{
				echo "registered"; //dont change this text as it is a jquery token 
			}
			else
			{
				echo "failed to create buyer";
			// }
		}
		else
		{
			echo "failed to create contact";
		}*/
				
	}

	mysqli_close($con);
?>