<?php
	$firstName = $_POST['fname'];
	$lastName = $_POST['lname'];
	$creditCard = $_POST['cc'];
	$csv = $_POST['csv'];
	$email = $_POST['emailtext'];
	$password = $_POST['password'];
	$phoneNumber1 = $_POST['area'];
	$phoneNumber2 = $_POST['fpart'];
	$phoneNumber3 = $_POST['epart'];

		$host= "localhost";
		$dbusername = "root";
		$dbpassword = "admin";
		$dbname = "esudatabase";
		$phoneNumber1 = $phoneNumber1 . $phoneNumber2 . $phoneNumber3;



		// Create connection
		$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

		if(mysqli_connect_error()){
			die('Connection Error {'.mysqli_connect_errno().')'.mysqli_connect_error());
		}
		else{
			$sql = "INSERT INTO customer (firstName, lastName, creditCard, csv, email, password, phoneNumber)
			values('$firstName', '$lastName', AES_ENCRYPT('$creditCard','encrypt'),AES_ENCRYPT('$csv','encrypt'),'$email','$password', '$phoneNumber1')";
			}
		if($conn->query($sql)){
			echo "New record is inserted";
		}
		else {
			echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
?>
