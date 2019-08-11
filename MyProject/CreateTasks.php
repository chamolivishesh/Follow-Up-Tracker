<!DOCTYPE html>
<html>
<head>
	<title>Create Tasks</title>
	<link rel="stylesheet" type="text/css" href="CSS/main.css">
</head>
	
<body>

	<h1 style="font-family: Arial"><u>Follow-Up / Reminder Tracker</u></h1>
	
	<?php
	session_start();
	
	if(isset($_SESSION['ecode']))
	{
		echo "<b style='font-family: Comfortaa'>Logged in as Employee Code: " . $_SESSION['ecode'] . "</b><br><br>";
	}
	
	?>
	

	<form action="submit.php" method="post" enctype="multipart/form-data">
		<table border="2px" cellpadding="8px">
			<tr>
				<th colspan="2" align="center">
					CREATE TASKS
				</th>
			</tr>
			
			
			<tr>
	
				<td>Task Description:</td>
				<td><textarea maxlength="250" rows="4" cols="50" placeholder="Description" name="descr"></textarea></td>
			</tr>
			
			<tr>
				<td>Task Actionee:</td>
				<td><input type="number" placeholder="Employee Code" name="acecode"><br><b>OR</b><br>
					<input type="text" placeholder="Employee Name" name="acename"><br><b>OR</b><br>
					<input type="email" placeholder="Employee Email" name="acemail"></td>
			</tr>
			
			<tr>
				<td>Status:</td>
				<td><input checked type="radio" name="status" value="Open">Open
				    <input type="radio" name="status" value="Closed">Closed</td>
			</td>
			
			<tr>
				<td>Comments:</td>
				<td><textarea maxlength="250" rows="4" cols="50" placeholder="Comments" name="comments"></textarea>
			</tr>
			
			<tr>
				<td align="center" colspan="2"><button type="submit" name="submit"><B>SUBMIT</B></button></td>
			</tr>
		</table>
	</form>
	<br>
	<span style="font-family:Comfortaa"><b>
	<a class="link" href="RegTasks.php">Click here to Edit Tasks</a><br>
	<a class="link" href="Logout.php">Log Out</a>
	</b></span>
</body>

</html>