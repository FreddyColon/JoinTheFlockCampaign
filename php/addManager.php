<?php
$host= "localhost";
$dbusername = "root";
$dbpassword = "admin";
$dbname = "esudatabase";


// Create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);


if(isset($_POST['submit']))
{

	$email=mysqli_real_escape_string($conn,$_POST['email']);
	$password=mysqli_real_escape_string($conn,$_POST['password']);
	$password=md5($password);

	$sql=("INSERT INTO manager(email,password)
	VALUES('$email','$password')");


	$query=mysqli_query($conn,$sql);
	if($query)
	{
		echo 'New Manager Created<br>';

	}
	else
	{
		echo 'Operation failed, please try again<br>';
	}


		echo 'Headed back to inventory page...';
				header("refresh:3;url=inventory.html");
}
