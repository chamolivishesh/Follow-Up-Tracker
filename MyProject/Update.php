<!DOCTYPE html>
		<html>
		<head>
			<title>Update Status</title>
			<link rel='stylesheet' type='text/css' href='CSS/main.css'>
		</head>
		<body style="background-color:white">
			<h1 style="font-family: Arial"><u>Follow-Up / Reminder Tracker</u></h1>
			<span style='font-family: Comfortaa'>
			
<?php
session_start();

if(isset($_SESSION['ecode']))
{
	echo "<b>Logged in as Employee Code: " . $_SESSION['ecode'] . "</b><br><br>";
	require("CONNECTION.php");
	
	$taskno = $_POST['taskno'];
	$descr = $_POST['descr'];
	$acecode = $_POST['acecode'];
	$acename = $_POST['acename'];
	$acemail = $_POST['acemail'];
	$status = $_POST['status'];
	$comments = $_POST['comments'];
	date_default_timezone_set('Asia/Kolkata');
	

		
	require ("checkacinput2.php");
	
	$result = mysqli_query($conn, "SELECT taskregecode FROM taskdetails WHERE taskno = ".$taskno);
	while($row = mysqli_fetch_assoc($result))
	{
		$row_code = $row['taskregecode'];
	}
	
		
	if($_SESSION['ecode'] == $row_code)		//check for rights
	{
	
	
		if($flag != 1)
		{
	
				
			//update
			if($descr != NULL)
			{
				mysqli_query($conn,"UPDATE taskdetails SET descr = '".$descr."' WHERE taskno = ".$taskno);
			}
			
			if($acecode != NULL)
			{
				mysqli_query($conn,"UPDATE taskdetails SET taskacecode = '".$acecode."' WHERE taskno = ".$taskno);
			}
			
			if($acename != NULL)
			{
				mysqli_query($conn,"UPDATE taskdetails SET taskacecode = (SELECT empcode from empmaster where empname = '".$acename."') WHERE taskno = ".$taskno);
			}
			
			if($acemail != NULL)
			{
				mysqli_query($conn,"UPDATE taskdetails SET taskacecode = (SELECT empcode from empmaster where empmail = '".$acemail."') WHERE taskno = ".$taskno);
			}
			
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
			//echo $closedate."<br>".$closetime;
			
			mysqli_query($conn,"UPDATE taskdetails SET closedate = '".$closedate."' WHERE taskno = ".$taskno);
			mysqli_query($conn,"UPDATE taskdetails SET closetime = '".$closetime."' WHERE taskno = ".$taskno);
			mysqli_query($conn,"UPDATE taskdetails SET status = '".$status."' WHERE taskno = ".$taskno);
			
			if($comments != NULL)
			{
				mysqli_query($conn,"UPDATE taskdetails SET comments = '".$comments."' WHERE taskno = ".$taskno);
			}
			
			echo "Update Successful<br><br>";
			
			
	
		}
	}
	else
	{
		echo "Cannot edit task no. <b>".$taskno."</b>, the current Employee does not have the authority<br><br>";
	}
		
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
				<th>Uploaded File</th>
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
			<th>Uploaded File</th>
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
	}
	echo "</table>";
	echo "<b><br>";
	echo "<a class='link' href='RegTasks.php'>Edit more tasks here</a><br>";
	echo "<a class='link' href='CreateTasks.php'>Add more tasks here</a><br>";
	echo "<a class='link' href='Logout.php'>Log Out</a>";
	echo "</b>";
	

	
	//work area ends here
}
else
{
	echo "Login first at the <a href='index.html'>Login Page</a>";
}
echo "</span></body></html>";
?>