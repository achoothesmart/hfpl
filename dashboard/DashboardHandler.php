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

	echo "<html>";
	echo "<form method='Get' action='login.php'>";
	echo "<p align='right'><b>Welcome:</b> ".$_SESSION['user_name'];
	echo "<br><input name='command' type='button' onClick='logout()' value='logout'/></p>";
	echo "<br>";
	echo "</form>";
	
	echo "<h1>DashBoard </h1>";
	echo "<ul>";
	echo "<li> <a href=\"../buyer/add.html\">Add Buyer</a> </li>";
	echo "<li> <a href=\"../seller/add.html\">Add Seller</a> </li>";
	echo "<li> <a href=\"../salesContract/create.html\">Create Sales Contract</a> </li>";
	echo "<li> <a href=\"../stockManagement/add.html\">Add Stock Details</a> </li>";
	echo "</ul>";
		
	echo "</html>";

?>