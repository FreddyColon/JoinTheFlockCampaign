<?php
$host= "localhost";
$dbusername = "root";
$dbpassword = "admin";
$dbname = "esudatabase";


// Create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);


if(isset($_POST['submit']))
{

	$charityname=mysqli_real_escape_string($conn,$_POST['charityname']);

	$sql=("INSERT INTO charity(charity_name)
	VALUES('$charityname')");


	$query=mysqli_query($conn,$sql);
	if($query)
	{
		echo 'New Charity Added<br>';

				header("refresh:2;url=inventory.html");

	}
	else
	{
		echo 'Addition failed, please try again<br>';
	}
}
?>
