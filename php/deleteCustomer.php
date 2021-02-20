<?php
$host= "localhost";
$dbusername = "root";
$dbpassword = "admin";
$dbname = "esudatabase";


// Create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

if(isset($_POST['submit']))
{

	$email=mysqli_real_escape_string($conn,$_POST['customerDelete']);



	$sql = mysqli_query($conn,"SELECT CID FROM customer WHERE email ='$email'");
	list($CID) = mysqli_fetch_row($sql);

	$sql2 = "DELETE FROM customer WHERE CID = '$CID'";

	$query=mysqli_query($conn,$sql2);
	if($query)
	{
		echo 'Customer Deleted<br>';

	}
	else
	{
		echo 'Operation failed, please try again<br>';
	}

	$sql = mysqli_query($conn,"SET @CID = LAST_INSERT_ID();");
	if($sql)
	{
		echo 'Heading back to inventory page...';
				header("refresh:3;url=inventory.html");



	}



}
?>
