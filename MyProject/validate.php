<!DOCTYPE html>
<html>
<head>
	<title>Validation</title>
</head>
</body>
<span style='font-family: Comfortaa'>


<?php

session_start();

if(!isset($_SESSION['ecode']) and $_POST['ecode'] != NULL)
{
	$ecode = $_POST['ecode'];
	
	require("CONNECTION.php");
	
	$query = "SELECT empcode FROM empmaster WHERE empcode='".$ecode."'";
	$result = mysqli_query($conn,$query);
	
	if(mysqli_num_rows($result) > 0)
	{
		session_start();
		$_SESSION['ecode'] = $ecode;
		header("Location: CreateTasks.php");
	}
	else
	{
		echo "<b>Invalid Employee Code</b>";
	}
}

else if(isset($_SESSION['ecode']))
{
	echo "<b>Already logged in as Employee Code: ".$_SESSION['ecode'];
	echo "<br><br><a href=CreateTasks.php>Go to CreateTasks</a><br>";
	echo "<a href='Logout.php'>Log Out</a></b>";
}
?>

</span>
</body>
</html>