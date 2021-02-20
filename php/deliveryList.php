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

  

      <table>

               <tr>
                 <th>Transaction Number </th>
                 <th>First Name </th>
                 <th>Last Name </th>
                 <th>Phone Number </th>
                 <th>Item Description </th>
                 <th>Quantity </th>
                 <th>Charity Donated </th>
                 <th>Building Name </th>
                 <th>Room Number </th>


               <tr> <br>
                 <?php





                                    $sql=mysqli_query($conn,"SELECT * FROM orders o inner join transaction t on o.order_id = t.order_num inner join delivery d on d.order_id = o.order_id
                                   inner join customer c on c.CID = o.CID inner join items i on i.item_id = t.item_id inner join charity ch on ch.charity_id = t.charity_id");

                                    if($sql)
                                    {
                                      while($row=mysqli_fetch_array($sql))
                                      {
                                        ?>
                                        <tr>
                                          <td> <?php echo "".$row['order_id_item_id']." "; ?> </td>
                                          <td> <?php echo "".$row['firstName']." "; ?> </td>
                                          <td> <?php echo "".$row['lastName']." "; ?> </td>
                                          <td> <?php echo "".$row['phoneNumber']." "; ?> </td>
                                          <td> <?php echo "".$row['description']." "; ?> </td>
                                          <td> <?php echo "".$row['quantity']." "; ?> </td>
                                          <td> <?php echo "".$row['charity_name']." "; ?> </td>
                                          <td> <?php echo "".$row['buildingName']." "; ?> </td>
                                          <td> <?php echo "".$row['roomNumber']." "; ?> </td>

                                        </tr>
                                        <?php
                                      }
                                    }

                                ?>

</div>
  </body>
</html>
