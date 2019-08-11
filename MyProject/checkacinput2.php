<?php

$flag = 0;
	
	//check for acemail
	if($acecode == NULL and $acename == NULL and $acemail != NULL)
	{
		$search = "SELECT * from empmaster where empmail='".$acemail."'";
		$result = mysqli_query($conn,$search);
		if(mysqli_num_rows($result) == 1)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$acecode = $row['empcode'];
				$acename = $row['empname'];
			}
		}
		
		else if(mysqli_num_rows($result) == 0)
		{
			echo "No such employee exists";
			$flag = 1;
			$acemail = NULL;
		}
		else
		{
			echo 'Conflicting values found in Table "empmaster".';
			$acemail = NULL;
		}
	}
	
	//check for acecode
	else if($acename == NULL and $acemail == NULL and $acecode != NULL)
	{
		$search = "SELECT * from empmaster where empcode=".$acecode;
		$result = mysqli_query($conn,$search);
		if(mysqli_num_rows($result) == 1)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$acemail = $row['empmail'];
				$acename = $row['empname'];
			}
		}
		
		else if(mysqli_num_rows($result) == 0)
		{
			echo "No such employee exists";
			$flag = 1;
			$acecode = NULL;
		}
		else
		{
			echo 'Conflicting values found in Table "empmaster".';
			$acecode = NULL;
		}
	}
	
	//check for acename
	else if($acecode == NULL and $acemail == NULL and $acename != NULL)
	{
		$search = "SELECT * from empmaster where empname like '".$acename."'";
		$result = mysqli_query($conn,$search);
		if(mysqli_num_rows($result) == 1)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$acecode = $row['empcode'];
				$acemail = $row['empmail'];
			}
		}
		
		else if(mysqli_num_rows($result) == 0)
		{
			echo "No such employee exists";
			$flag = 1;
			$acename = NULL;
			
		}
		else
		{
			echo 'Conflicting values found in Table "empmaster".';
			$acename = NULL;
		}
	}
	
	else if($acecode == NULL and $acemail == NULL and $acename == NULL)
	{
		$flag = 0;
	}

		
	//last condition
	else 
	{
		$acecode=NULL;
		$acename=NULL;
		$acemail=NULL;
		echo "Input only one value of Task Actionee";
		$flag = 1;
	}
	

	
?>