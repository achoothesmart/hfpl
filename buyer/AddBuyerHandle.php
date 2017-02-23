<?php
	
	session_start();
	// $con = mysqli_connect("localhost", "root", "", "hfpl_db");
	$con = mysqli_connect("sql300.ultimatefreehost.in", "ltm_19353243", "ashok007", "ltm_19353243_hfpl_1");
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
	else if($_GET['command']=="add_buyer")
	{
		$buyer_name=$_GET['buyer_name'];
		$mobile=$_GET['mobile'];
		$landline=$_GET['landline'];
		$fax=$_GET['fax'];
		$address=$_GET['address'];
		$email=$_GET['email'];
		$website=$_GET['website'];
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
			}
		}
		else
		{
			echo "failed to create contact";
		}
		
			
	}

	
	mysqli_close($con);
?>