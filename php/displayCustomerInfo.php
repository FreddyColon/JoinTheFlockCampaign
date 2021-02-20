<?php
$host= "localhost";
$dbusername = "root";
$dbpassword = "admin";
$dbname = "esudatabase";


// Create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="utf-8">
    <title>Caston &amp; Colon Business Enterprises, Ltd.</title>
  </head>
  <body class="FlexBody">
<div class="AppContentCenter" style="justify-content: center; align-items: center;">
    <form id="Retrieve Customer Info" action="" method="post">
<p><b>Enter email: </b></p>
   <input type="text" name="email" placeholder="Enter Email Address" />
   <input type="submit" name="search" value="Search by Email" />
   <table>
                <tr>

                  <th>First Name </th>
                  <th>Last Name </th>
                  <th>Credit Card Number </th>
                  <th>CSV Number </th>




                <tr> <br>
                <?php
                if(isset($_POST['search']))
                {

                  $email = $_POST['email'];

                     $sql=mysqli_query($conn,"SELECT firstName, lastName, AES_DECRYPT(creditCard,'encrypt') AS cc, AES_DECRYPT(csv,'encrypt') AS csv FROM customer WHERE email='$email'");

                     if($sql)
                     {
                       while($row=mysqli_fetch_array($sql))
                       {
                       ?>
                         <tr>
                           <td> <?php echo "".$row['firstName']." "; ?> </td>
                           <td> <?php echo "".$row['lastName']." "; ?> </td>
                           <td> <?php echo "".$row['cc']." "; ?> </td>
                           <td> <?php echo "".$row['csv']." "; ?> </td>
                         </tr>

                         <?php
                              }
                            }
                          }
                        ?>





              </table>
            </div>
</body>
</html>
