<?php
    session_start();
    $db='esudatabase';
    $user='root';
    $pass='admin';
    $conn=mysqli_connect('localhost', $user, $pass,$db) or die("Unable to Connect");
    $email = $_SESSION['email'];

    if(isset($_POST['submit']))
    {
        $last=mysqli_real_escape_string($conn,$_POST['lastName']);
        $sql = "UPDATE customer SET lastName = '$last'  where email = '$email'";
        if($conn->query($sql) === TRUE)
        {
            echo "Last name updated successfully";
            echo "<br>";
            echo 'You will be redirected to the updated order form...';
            header("refresh:4;url=OrderForm.php");
        }
        else
        {
            echo "Updating last name unsuccessful. Please try again later...";
            header("refresh:3;url=OrderForm.php");
        }

    }

?>
