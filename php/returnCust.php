<?php
session_start();
if(!isset($_SESSION['loggedin']))
{
header('Location: index.html');
exit;
}

$host= "localhost";
$dbusername = "root";
$dbpassword = "admin";
$dbname = "esudatabase";
$email = $_SESSION['email'];

// Create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
if(mysqli_connect_error())
{
die('Connection Error {'.mysqli_connect_errno().')'.mysqli_connect_error());
}
else
{
  if(isset($_POST['submit']))
  {
    $last=mysqli_real_escape_string($conn,$_POST['lastName']);
    $sql = "UPDATE customer SET lastName = '$last'  where email = '$email'";
    if($conn->query($sql) === TRUE)
    {
      echo "Last name updated successfully";
      echo "<br>";
      echo 'You will be redirected to the login page, Please re-login...';
      header("refresh:5;url=retLogin.html");
    }
    else
    {
      echo "Updating last name unsuccessful. Please try again later...";
      //header("refresh:3;retcusthtml.php");
    }
  }


  if($stmt = $conn->prepare('SELECT CID FROM customer WHERE email= ?' ))
  {
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($CID);
    $stmt->fetch();
    $sql = "INSERT INTO orders (CID) VALUES ('$CID')";
    if($conn->query($sql))
    {
      echo "New order is inserted";
    }
    else
    {
      echo "Error: ".$sql."<br>".$conn->error;
    }
    //SELECT * FROM orders WHERE order_id=(SELECT max(order_id) FROM orders);
    $stmt = $conn->prepare('SELECT order_id FROM orders ORDER BY delivery_date DESC LIMIT 1;');
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($order_id);
    $stmt->fetch();

    // item 1:
    if(isset($_POST['socks1'])) //check if item chekcbox is checked
    {
      $item_id = 1;
      if(isset($_POST['sock1qt']))  // check if quantity box is filed
      {
        $quantity = $_POST['sock1qt'];
        if($quantity> 0)
        {
              if(isset($_POST['sock1c'])) //check charity box
              {

                $charity_id= $_POST['sock1c'];
                $sql = "INSERT INTO transaction (order_num,item_id, charity_id, quantity) VALUES ('$order_id', '$item_id','$charity_id', '$quantity')";
                if($conn->query($sql))
                {
                  echo "Transaction table updated!";
                }
                else
                {
                  echo "Error: ".$sql."<br>".$conn->error;
                }
          }

        }
      }
    }
    //item 2:
    if(isset($_POST['socks2'])) //check if item chekcbox is checked
    {
      $item_id = 2;
      if(isset($_POST['sock2qt']))  // check if quantity box is filed
      {
        $quantity = $_POST['sock2qt'];
        if(isset($_POST['sock2c'])) //check charity box
        {

          $charity_id= $_POST['sock2c'];
          $sql = "INSERT INTO transaction (order_num,item_id, charity_id, quantity) VALUES ('$order_id', '$item_id','$charity_id', '$quantity')";
          if($conn->query($sql))
          {
            echo "Transaction table updated!";
          }
          else
          {
            echo "Error: ".$sql."<br>".$conn->error;
          }

        }
      }
    }
    //Item 3:
    if(isset($_POST['socks3']))
    {
      $item_id = 3;
      if(isset($_POST['sock3qt']))
      {
        $quantity = $_POST['sock3qt'];
        if(isset($_POST['sock3c']))
        {

          $charity_id= $_POST['sock3c'];
          $sql = "INSERT INTO transaction (order_num,item_id, charity_id, quantity) VALUES ('$order_id', '$item_id','$charity_id', '$quantity')";
          if($conn->query($sql))
          {
            echo "Transaction table updated!";
          }
          else
          {
            echo "Error: ".$sql."<br>".$conn->error;
          }

        }
      }
    }
    //Item 4:
    if(isset($_POST['socks4']))
    {
      $item_id = 4;
      if(isset($_POST['sock4qt']))
      {
        $quantity = $_POST['sock4qt'];
        if(isset($_POST['sock4c']))
        {

          $charity_id= $_POST['sock4c'];
          $sql = "INSERT INTO transaction (order_num,item_id, charity_id, quantity) VALUES ('$order_id', '$item_id','$charity_id', '$quantity')";
          if($conn->query($sql))
          {
            echo "Transaction table updated!";
          }
          else
          {
            echo "Error: ".$sql."<br>".$conn->error;
          }

        }
      }
    }
    //Item 5:
    if(isset($_POST['hat1']))
    {
      $item_id = 5;
      if(isset($_POST['hat1qt']))
      {
        $quantity = $_POST['hat1qt'];
        if(isset($_POST['hat1c']))
        {

          $charity_id= $_POST['hat1c'];
          $sql = "INSERT INTO transaction (order_num,item_id, charity_id, quantity) VALUES ('$order_id', '$item_id','$charity_id', '$quantity')";
          if($conn->query($sql))
          {
            echo "Transaction table updated!";
          }
          else
          {
            echo "Error: ".$sql."<br>".$conn->error;
          }

        }
      }
    }
    //Item:6
    if(isset($_POST['hat2']))
    {
      $item_id = 6;
      if(isset($_POST['hat2qt']))
      {
        $quantity = $_POST['hat2qt'];
        if(isset($_POST['hat2c']))
        {

          $charity_id= $_POST['hat2c'];
          $sql = "INSERT INTO transaction (order_num,item_id, charity_id, quantity) VALUES ('$order_id', '$item_id','$charity_id', '$quantity')";
          if($conn->query($sql))
          {
            echo "Transaction table updated!";
          }
          else
          {
            echo "Error: ".$sql."<br>".$conn->error;
          }




        }
      }
    }
    //Delivery Table
            $delivery=$_POST['delivery'];
            $building=$_POST['building'];
            $room=$_POST['room'];
            if($building && $room)
            {
                $sql="INSERT INTO delivery(order_id,buildingName,roomNumber)
                VALUES('$order_id','$building','$room')";
                if($conn->query($sql))
                {
                    echo "Delivery Posted<br>";
                }
                else
                {
                    echo "Error: ".$ql."<br>".$conn->error;
                }
            }






    $stmt->close();
  }

}

$conn->close();

?>
