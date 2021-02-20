<?php
$host= "localhost";
$dbusername = "root";
$dbpassword = "admin";
$dbname = "esudatabase";
$NUMBER_OF_CHARITIES = 7;

// Create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
if(mysqli_connect_error()){

  die('Connection Error {'.mysqli_connect_errno().')'.mysqli_connect_error());
  }
else
{
     // Total of socks sold for each charity
     for($i = 1; $i <= $NUMBER_OF_CHARITIES; $i++)
     {
    $query = "select SUM(quantity) FROM transaction WHERE item_id < 5 AND charity_id = '$i'";
    $res = mysqli_query($conn, $query);
    $num = $res->fetch_assoc();
    echo 'Total number of Socks for Charity: ' . $i . " is: ";
    $sum1 = array_sum($num);
    echo $sum1;
    echo "<br>";

  }



    // total of hats sock for each charity
    for($i =1; $i <= $NUMBER_OF_CHARITIES; $i++)
    {
    $query = "select SUM(quantity) FROM transaction WHERE item_id > 4 AND charity_id = '$i'";
    $res = mysqli_query($conn, $query);
    $num = $res->fetch_assoc();
    if($num > 0)
    {
      echo 'Total number of Hats for Charity: ' . $i . " is: ";
    $sum2 = array_sum($num);
    echo $sum2;
    echo "<br>";
  }

}
}


  ?>
