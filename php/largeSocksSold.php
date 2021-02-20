<?php

$host= "localhost";
$dbusername = "root";
$dbpassword = "admin";
$dbname = "esudatabase";


// Create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
if(mysqli_connect_error()){

  die('Connection Error {'.mysqli_connect_errno().')'.mysqli_connect_error());
  }
else
{
$query = "select SUM(quantity) FROM transaction WHERE item_id = 2 ";
$res = mysqli_query($conn, $query);
$num = $res->fetch_assoc();
$sum1 = array_sum($num);
$query = "select SUM(quantity) FROM transaction WHERE item_id = 4 ";
$res = mysqli_query($conn, $query);
$num2 = $res->fetch_assoc();
$sum2 = array_sum($num2);
$total = $sum1+ $sum2;

echo 'Total number of Large Socks: ';
echo $total;
echo "<br>";
}
?>
