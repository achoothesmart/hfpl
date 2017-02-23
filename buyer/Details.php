<?php
	session_start();

	$user_name=$_SESSION['user_name'];

	if($_GET['command']=='logout')
	{
		unset($_SESSION['user_name']);
		echo "<center>Successfully logged out!";
		echo "<br><a href='../'>click here to login</a></center>";
		exit(0);
	}
	// elseif($_POST['command']=='Change')
	// {
		// if ($_FILES["file"]["error"] > 0) {
		  // echo "Error: " . $_FILES["file"]["error"] . "<br>";
		// } 
		// else
		// {
			// echo "Upload: " . $_FILES["file"]["name"] . "<br>";
			// echo "Type: " . $_FILES["file"]["type"] . "<br>";
			// echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			
			// move_uploaded_file($_FILES["file"]["tmp_name"],"profile/" . $user_name .".jpg");
			// echo "<center>Profile Picture Changed Successfully!";
		// }
		// echo "<br><a href='/Premier/user.html'>click here to go Home Page</a></center>";
		// exit(0);
	// }

	if(!isset($_SESSION['user_name']))
	{
		echo "<b>Warning:</b> Invalid login attempt!";
		exit(0);
	}

	// $con = mysqli_connect("localhost", "root", "", "hfpl_db");
	$con = mysqli_connect("sql300.ultimatefreehost.in", "ltm_19353243", "ashok007", "ltm_19353243_hfpl_1");
	if(!$con){ die("Connction error"); }

	$result = mysqli_query($con,"SELECT * FROM tbl_users where user_name='$user_name'");
	while($row = mysqli_fetch_array($result))
	{
	  $user_name=$row['user_name'];
	}
	echo "<html>";
	echo "<form method='Get' action='login.php'>";
	echo "<p align='right'><b>Welcome:</b> ".$user_name;
	echo "<br><input name='command' type='button' onClick='logout()' value='logout'/></p>";
	echo "<br>";
	echo "</form>";
	
	echo "<h2>Buyers</h2>";
	echo "<a href=\"add.html\">Add a Buyer</a>";	
	echo "<form method='Post' action='login.php' enctype='multipart/form-data'>";
	echo "<table border=1>";
	$result = mysqli_query($con,"SELECT * FROM tbl_buyers b inner join tbl_contacts c on b.organization_contact_id=c.contact_id");
	echo "<tr>";
	echo "<th>buyer_name</th>";
	echo "<th>mobile_number</th>";
	echo "<th>landline_number</th>";
	echo "<th>fax</th>";
	echo "<th>address</th>";
	echo "<th>email</th>";
	echo "<th>website</th>";
	echo "</tr>";
	while($row = mysqli_fetch_array($result))
	{
		// buyer_name 	
		// mobile_number 	
		// landline_number 	
		// fax 	
		// address 	
		// email 	
		// website
		echo "<tr>";
		echo "<td>".$row['buyer_name']."</td>";
		echo "<td>".$row['mobile_number']."</td>";
		echo "<td>".$row['landline_number']."</td>";
		echo "<td>".$row['fax']."</td>";
		echo "<td>".$row['address']."</td>";
		echo "<td>".$row['email']."</td>";
		echo "<td>".$row['website']."</td>";
		echo "</tr>";
	}
	echo "</table></form>";	
	echo "</html>";

?>