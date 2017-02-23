<?php
session_start();

$user_name=$_SESSION['user_name'];

if($_GET['command']=='logout')
{
	unset($_SESSION['user_name']);
	echo "<center>Successfully logged out!";
	echo "<br><a href='/index.html'>click here to login</a></center>";
	exit(0);
}
elseif($_POST['command']=='Change')
{
	if ($_FILES["file"]["error"] > 0) {
	  echo "Error: " . $_FILES["file"]["error"] . "<br>";
	} 
	else
	{
		echo "Upload: " . $_FILES["file"]["name"] . "<br>";
		echo "Type: " . $_FILES["file"]["type"] . "<br>";
		echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
		
		move_uploaded_file($_FILES["file"]["tmp_name"],"profile/" . $user_name .".jpg");
		echo "<center>Profile Picture Changed Successfully!";
	}
	echo "<br><a href='/Premier/user.html'>click here to go Home Page</a></center>";
	exit(0);
}

if(!isset($_SESSION['user_name']))
{
	echo "<b>Warning:</b> Invalid login attempt!";
	exit(0);
}


$con = mysqli_connect("localhost", "root", "", "premier");
	if(!$con){ die("Connction error"); }

	$result = mysqli_query($con,"SELECT * FROM emptable where user_name='$user_name'");
	while($row = mysqli_fetch_array($result))
	{
	  $ename=$row['ename'];
	}
	echo "<html>";
	echo "<form method='Get' action='login.php'>";
	echo "<p align='right'><b>Welcome:</b> ".$ename;
	echo "<br><input name='command' type='button' onClick='logout()' value='logout'/></p>";
	echo "<br>";
	echo "</form>";
	
	echo "<form method='Post' action='login.php' enctype='multipart/form-data'>";
	echo "<table><tr>";
	if (file_exists("profile/" . $user_name . ".jpg"))
	{
		echo "<td><img src='/Premier/profile/".$user_name.".jpg' width='100px'/></td>";
		echo "<td>You can change your Profile Picture";
	}
	else	
	{
		echo "<td><img class='profilepic' src='/Premier/profile/avatar.jpg' width='100px'/><td>";
		echo "<td>You have no Profile Picture. <br> Upload your Profile Picture";
	}
	echo "<br><input name='file' id='file' type='file' />";
	echo "<input type='submit' name='command' value='Change'> </td></tr></table>";
	
	echo "</form>";
	
	echo "<table border='1' cellspacing='1' cellpadding='2'>";
	echo "<tr><th>Date(yyyy-mm-dd)</th> <th>Presence</th></tr>";
	
	echo "<h3>Attendance Sheet</h3>";
	$result = mysqli_query($con,"SELECT * FROM attable where user_name='$user_name'");
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr><td>".$row['dat']."</td>";
	  
	  if($row['presence']=='p')
	  {
		echo "<td class='present'>Present</td></tr>";
	  }
	  else
	  {
		echo "<td class='absent'>Absent</td></tr>";
	  }
	 
	  
	}
	 echo "</table>";
	
	echo "</html>";

?>