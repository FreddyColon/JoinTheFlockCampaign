<?php

  $host= "localhost";
  $dbusername = "root";
  $dbpassword = "admin";
  $dbname = "esudatabase";


  // Create connection
  $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);


      //find the sum of quantity where item id is 1,2,3,4
    $query = "select SUM(quantity) FROM transaction";
    $res = mysqli_query($conn, $query);
    $num = $res->fetch_assoc();
    echo "Total number of items sold: ";
    $sum = array_sum($num);
    echo $sum;


  ?>
