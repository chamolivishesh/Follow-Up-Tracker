<?php

$conn1 = mysqli_connect("localhost","root","","");		//"domain","username","password","dbname"
if (!$conn1)
{
    die("Connection failed: " . mysqli_connect_error());
}
else
	echo "Connected successfully<br>";


$sql = "CREATE DATABASE myproject";
if (mysqli_query($conn1, $sql))
{
    echo "Database myproject created successfully<br>";
}
else 
{
    echo "Error creating database: " . mysqli_error($conn1) . "<br>";
}
	
	
$conn2 = mysqli_connect("localhost","root","","myproject");		//"domain","username","password","dbname"

$cre = "CREATE TABLE taskdetails (taskno integer primary key auto_increment,descr varchar(250), taskregecode integer,taskacecode integer, regdate date,regtime varchar(20),closedate date,closetime varchar(20), status varchar(6), comments varchar(250))";
if (mysqli_query($conn2, $cre))
{
    echo "Table taskdetails created successfully<br>";
}
else
{
    echo "Error creating taskdetails: " . mysqli_error($conn2) . "<br>";
} 		


$cre = "CREATE TABLE empmaster (empcode integer primary key auto_increment,empname varchar(40),empmail varchar(40))";
if (mysqli_query($conn2, $cre))
{
    echo "Table empmaster created successfully<br>";
} else
{
    echo "Error creating empmaster: " . mysqli_error($conn2) . "<br>";
}

?>