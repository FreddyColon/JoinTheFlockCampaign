<?php
  session_start();
?>
<?php
$host= "localhost";
$dbusername = "root";
$dbpassword = "admin";
$dbname = "esudatabase";


// Create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
if(mysqli_connect_error()){
  echo "Error connection";

  die('Connection Error {'.mysqli_connect_errno().')'.mysqli_connect_error());
  }
else
{
if(isset($_POST['xmlexport']))
{
$sql =  "SELECT orders.order_id, concat (firstName,' ',lastName) as customer_name, description, delivery_date, buildingName, roomNumber, charity_name, quantity
FROM orders
inner join transaction on orders.order_id = transaction.order_num
inner join delivery on delivery.order_id = orders.order_id
inner join customer on customer.CID = orders.CID
inner join items on items.item_id = transaction.item_id
inner join charity on charity.charity_id = transaction.charity_id ORDER BY customer_name";

$customerTableArray = array();

$result=mysqli_query($conn,$sql);


  if ($result)
  {
    while ($row = $result->fetch_assoc())
    {
      array_push($customerTableArray, $row);
    }
      if (count($customerTableArray))
      {
        createXMLfile($customerTableArray);
      }
      echo "XML file created, it's in your database folder<br>";
        echo 'Heading back to inventory page...';
            header("refresh:3;url=inventory.html");
      $result->free();

  }
  else {
    echo "i forgot to handle the error message";
  }

  $conn->close();
}
}

function createXMLfile($customerTableArray)
{
  $filepath = 'CustomerData_'.date('m-d-Y_hia').'.xml'; //'customerData.xml'
  $dom = new DOMDocument('1.0', 'utf-8');
  $root = $dom->createElement('customerData');

  for($i=0; $i<count($customerTableArray); $i++)
  {
    $order_id = $customerTableArray[$i]['order_id'];
    $customer_name = $customerTableArray[$i]['customer_name'];
    $item_description = $customerTableArray[$i]['description'];
    $order_date = $customerTableArray[$i]['delivery_date'];

    $building_name = $customerTableArray[$i]['buildingName'];
    $room_num = $customerTableArray[$i]['roomNumber'];
    $charity_name = $customerTableArray[$i]['charity_name'];
    $quantity = $customerTableArray[$i]['quantity'];

    $orders = $dom->createElement('orders');
    $orders->setAttribute('order_id', $order_id);

    $customer_name = $dom->createElement('customer_name', $customer_name);
    $orders->appendChild($customer_name);
    $item_description = $dom->createElement('item_description', $item_description);
    $orders->appendChild($item_description);
    $order_date = $dom->createElement('order_date', $order_date);
    $orders->appendChild($order_date);
    $building_name = $dom->createElement('building_name', $building_name);
    $orders->appendChild($building_name);
    $room_num = $dom->createElement('room_num', $room_num);
    $orders->appendChild($room_num);
    $charity_name = $dom->createElement('charity_name', $charity_name);
    $orders->appendChild($charity_name);
    $quantity = $dom->createElement('quantity', $quantity);
    $orders->appendChild($quantity);

    $root->appendChild($orders);
  }

  $dom->appendChild($root);
  $dom->save($filepath);

}

?>
