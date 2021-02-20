<?php

	$email = $_POST['email'];

	$password = $_POST['password'];



		$host= "localhost";
		$dbusername = "root";
		$dbpassword = "admin";
		$dbname = "esudatabase";


		// Create connection
		$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);




		if(mysqli_connect_error()){
			die('Connection Error {'.mysqli_connect_errno().')'.mysqli_connect_error());
		}
		else{
			if($stmt = $conn->prepare('SELECT password FROM manager WHERE email=?'))
			{
				$stmt->bind_param('s', $_POST['email']);

				$stmt->execute();
				$stmt->store_result();
				if ($stmt->num_rows > 0) {
				$stmt->bind_result($password);
				$stmt->fetch();
				// Account exists, now we verify the password.
				// Note: remember to use password_hash in your registration file to store the hashed passwords.
				 $password1 = md5($_POST['password']);
				if ($password1 === $password) {
				// Verification success! User has loggedin!
				// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
				session_start();
				session_regenerate_id();
				$_SESSION['loggedin'] = TRUE;
				$_SESSION['email'] = $_POST['email'];

				echo 'Welcome ' . $_SESSION['email'] . '!';

				} else {
				echo 'Incorrect password!';
				echo $password;
				}
				} else {
				echo 'Email is not valid, Please try again!';
				}
				if (isset($_SESSION['loggedin'])) {
					header('Location: inventory.html');
					exit;
				}
				$stmt->close();

			}

			}

		$conn->close();
?>
