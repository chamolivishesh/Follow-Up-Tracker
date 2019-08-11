<?php

$conn = mysqli_connect("localhost","root","","myproject");		//"domain","username","password","dbname"
if (!$conn)
{
    die("Connection failed: " . mysqli_connect_error());
}
else
	echo "Connected successfully<br>";

?>