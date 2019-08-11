<link rel="stylesheet" type="text/css" href="CSS/main.css">
<?php 

echo "<b><span style='font-family: Comfortaa'>";
session_start();

if(isset($_SESSION['ecode']))
{

	require("CONNECTION.php");
	
	$descr = $_POST['descr'];
	$acecode = $_POST['acecode'];
	$acename = $_POST['acename'];
	$acemail = $_POST['acemail'];
	$status = $_POST['status'];
	$comments = $_POST['comments'];
	date_default_timezone_set('Asia/Kolkata');
	$regdate = date("Y-m-d");
	$regtime = date("h:i:sa");
		
	
	if($status == "Open")
	{
		$closedate = NULL;
		$closetime = NULL;
	}
	else if($status = "Closed")
	{
		$closedate = date("Y-m-d");
		$closetime = date("h:i:sa");
	}
		
	require ("checkacinput.php");
	
		
	if($flag != 1)
	{
		
		$upl = "INSERT INTO taskdetails VALUES('','".$descr."','".$_SESSION['ecode']."','".$acecode."','".$regdate."','".$regtime."','".$closedate."','".$closetime."','".$status."','".$comments."')";
		if(mysqli_query($conn,$upl))
		{
			echo "Details Uploaded<br><br>";
			echo "<a class='link' href='CreateTasks.php'>Click here to Create More Tasks</a><br>";
			echo "<a class='link' href='RegTasks.php'>Click here to Edit Tasks</a><br>";
			echo "<a class='link' href='Logout.php'>Log Out</a>";
		}
		else
		{
			echo "Failed to Upload to taskdetails <br>" . mysqli_error($conn);
		}
	}
	else
	{
		echo "<a class='link' href='CreateTasks.php'>Go Back To Create Tasks</a>";
		//echo "<a
	}
}
else
{
	echo "Login first at the <a href='index.html'>Login Page</a>";
}
echo "</span></b>";
?>