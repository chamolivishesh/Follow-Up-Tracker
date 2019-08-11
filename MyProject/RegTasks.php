<!DOCTYPE html>
<html>
<head><title>Edit Tasks</title></head>
<link rel="stylesheet" type="text/css" href="CSS/main.css">
<body>
<h1 style="font-family: Arial"><u>Follow-Up / Reminder Tracker</u></h1>
<span style='font-family: Comfortaa'>
<?php
$taskcount = 0;

if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

require("CONNECTION.php");

if(isset($_SESSION['ecode']))
{
	echo "<b>Logged in as Employee Code: " . $_SESSION['ecode'] . "</b><br><br>";
	//redistered by others
	
	$fetch = "SELECT taskdetails.*,empmaster.* FROM taskdetails,empmaster WHERE taskdetails.taskregecode = '".$_SESSION['ecode']."' AND taskdetails.taskregecode = empmaster.empcode";
	echo "<table border='2px' cellpadding='8px'>";
	echo "<tr><td align='center' colspan='15'><b>Your Registered Tasks</b></td></tr>";
	
	$result = mysqli_query($conn,$fetch);
	
	if(mysqli_num_rows($result) > 0)
	{
	
		
		
		echo "<tr>
				<th>Task No.</th>
				<th>Task Description</th>
				<th>Task Registerer Code</th>
				<th>Task Registerer Name</th>
				<th>Task Registerer Mail</th>
				<th>Task Actionee Code</th>
				<th>Task Actionee Name</th>
				<th>Task Actionee Mail</th>
				<th>Registered Date</th>
				<th>Registered Time</th>
				<th>Closed Date</th>
				<th>Closed Time</th>
				<th>Status</th>
				<th>Comments</th>
			  </tr>";
		  
		while($row = mysqli_fetch_assoc($result))
		{
			$fetchac = "SELECT empname,empmail FROM empmaster  WHERE empcode = '".$row['taskacecode']."'";
			$result2 = mysqli_query($conn,$fetchac);
			while($rowac = mysqli_fetch_assoc($result2))
			{
			
				echo "<tr>
						<td>".$row['taskno']."</td>
						<td>".$row['descr']."</td>
						<td>".$row['taskregecode']."</td>
						<td>".$row['empname']."</td>
						<td>".$row['empmail']."</td>
						<td>".$row['taskacecode']."</td>
						<td>".$rowac['empname']."</td>
						<td>".$rowac['empmail']."</th>
						<td>".$row['regdate']."</td>
						<td>".$row['regtime']."</td>";
						if($row['closedate'] == "0000-00-00")
						{
							echo "<td></td>";
						}
						else
						{
							echo "<td>".$row['closedate']."</td>";
						}
						echo "<td>".$row['closetime']."</td>
							  <td>".$row['status']."</td>
							  <td>".$row['comments']."</td>
						  </tr>";
			}
			
		}
		
		
	}	
	else
	{
		echo "<tr><td colspan='15'><pre style='font-family: Comfortaa'>No registered tasks         </pre></td></tr>";
		$taskcount += 1;
	}
	echo "</table>";
	
	//registered by user
	
	$fetch = "SELECT taskdetails.*,empmaster.* FROM taskdetails,empmaster WHERE taskdetails.taskacecode = '".$_SESSION['ecode']."' AND taskdetails.taskacecode = empmaster.empcode";
	
	echo "<table border='2px' cellpadding='8px'>";
	echo "<br><tr><td align='center' colspan='15'><b>Tasks that Require Action</b></td></tr>";
	
	$result = mysqli_query($conn,$fetch);
	
	if(mysqli_num_rows($result) > 0)
	{
		
		
		echo "<tr>
			<th>Task No.</th>
			<th>Task Description</th>
			<th>Task Registerer Code</th>
			<th>Task Registerer Name</th>
			<th>Task Registerer Mail</th>
			<th>Task Actionee Code</th>
			<th>Task Actionee Name</th>
			<th>Task Actionee Mail</th>
			<th>Registered Date</th>
			<th>Registered Time</th>
			<th>Closed Date</th>
			<th>Closed Time</th>
			<th>Status</th>
			<th>Comments</th>
		  </tr>";
		  
		while($row = mysqli_fetch_assoc($result))
		{
			$fetchac = "SELECT empname,empmail FROM empmaster  WHERE empcode = '".$row['taskregecode']."'";
			$result2 = mysqli_query($conn,$fetchac);
			while($rowac = mysqli_fetch_assoc($result2))
			{
			
				echo "<tr>
						<td>".$row['taskno']."</td>
						<td>".$row['descr']."</td>
						<td>".$row['taskregecode']."</td>
						<td>".$rowac['empname']."</td>
						<td>".$rowac['empmail']."</td>
						<td>".$row['taskacecode']."</td>
						<td>".$row['empname']."</td>
						<td>".$row['empmail']."</th>
						<td>".$row['regdate']."</td>
						<td>".$row['regtime']."</td>";
						if($row['closedate'] == "0000-00-00")
						{
							echo "<td></td>";
						}
						else
						{
							echo "<td>".$row['closedate']."</td>";
						}
						echo "<td>".$row['closetime']."</td>
							  <td>".$row['status']."</td>
							  <td>".$row['comments']."</td>
				          </tr>";
			}
			
		}
		
	
	}	
	else
	{
		echo "<tr><td colspan='15'><pre style='font-family: Comfortaa'>No registered tasks</pre></td></tr>";
		$taskcount += 1;
	}
	echo "</table>";
	
	if($taskcount != 2)
	{
?>

	<br><br><br>
	<form action="Update.php" method="post" enctype="multipart/form-data">
		<table border="2px" cellpadding="8px">
			<tr>
				<th align="center" colspan="2">Edit Tasks (w.r.t Task No.)</th>
			</tr>
			
			<tr>
				<td>Task No.</td>
				<td><input type="number" required placeholder="Task No. (required)" name="taskno">
			<tr>
	
				<td>Task Description:</td>
				<td><textarea maxlength="250" rows="4" cols="50" placeholder="(unchanged)" name="descr"></textarea></td>
			</tr>
			
			
			<tr>
				<td>Task Actionee:</td>
				<td><input type="number" placeholder="Emp Code (unchanged)" name="acecode"><br>OR<br> 
					<input type="text" placeholder="Emp Name  (unchanged)" name="acename"><br>OR<br>
					<input type="email" placeholder="Emp Email (unchanged)" name="acemail"></td>
			</tr>
			
			<tr>
				<td>Status:</td>
				<td><input checked type="radio" name="status" value="Open">Open
				    <input type="radio" name="status" value="Closed">Closed</td>
			</td>
			
			<tr>
				<td>Comments:</td>
				<td><textarea maxlength="250" rows="4" cols="50" placeholder="(unchanged)" name="comments"></textarea>
			</tr>
			
			<tr>
				<td align="center" colspan="2"><button type="submit" name="submit"><b>SUBMIT</b></button></td>
			</tr>
		</table>
	</form>
	
	

	
<?php
	}
	echo "<br>";
	echo "<a class='link' href='CreateTasks.php'><b>Click here to Create More Tasks</b></a><br>";
	echo "<a class='link' href='Logout.php'><b>Log Out</b></a>";
	//work area ends
}
else
{
	echo "Login first at the <a href='index.html'>Login Page</a>";
}

?>
</span>
</body>
</html>