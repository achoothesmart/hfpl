<?php
session_start();

$eid=$_SESSION['eid'];

if($_GET['command']=='logout')
{
	unset($_SESSION['eid']);
	echo "<center>Successfully logged out!";
	echo "<br><a href='/index.html'>click here to login</a></center>";
	exit(0);
}


$con = mysqli_connect("localhost", "root", "", "premier");
	if(!$con){ die("Connction error"); }

	$result = mysqli_query($con,"SELECT * FROM emptable where eid='$eid'");
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
	
	
	echo "<h3>Employees Details</h3>";
	$result = mysqli_query($con,"SELECT * FROM emptable");
	echo "<table border='1' cellspacing='1' cellpadding='2'><tr> <th>Profile Image</th> <th>Employee ID</th> <th>Name</th> </tr>";
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
		if (file_exists("profile/" . $row['eid'] . ".jpg"))
		{
			echo "<td><img src='/Premier/profile/".$row['eid'].".jpg' height='50' width='50'/></td>";
		}
		else	
		{
			echo "<td><img src='/Premier/profile/avatar.jpg' height='50px' width='50'/></td>";
		}
		
		echo "<td id='".$row['eid']."' ondblclick='show_pwd(id)'>".$row['eid']." <input type='hidden' id='". $row['eid'] ."_pwd' value='". $row['pwd'] ."'/> </td>";
		echo "<td>".$row['ename']."</td>";
		
		echo "</tr>";
	}
	
	echo "</table>";

?>