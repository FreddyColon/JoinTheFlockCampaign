<?php
session_start();
$host= "localhost";
$dbusername = "root";
$dbpassword = "admin";
$dbname = "esudatabase";
$email = $_SESSION['email'];

// Create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
if(mysqli_connect_error()){

  die('Connection Error {'.mysqli_connect_errno().')'.mysqli_connect_error());
  }
  ?>
  <!doctype html>

  <html>
  <head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="utf-8">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <title>Caston &amp; Colon Buisiness Enterprises, Ltd.</title>
    <style>
    .button {
      background-color: #f44336;
      border: none;
      color: white;
      text-align: center;
      text-decoration: none;

      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
    }

    .button1 {padding: 10px 24px;}

    </style>

  </head>

  <body>
    <form method="post" action="returnCust.php">

      <div class="FlexBody">
        <div class="AppContent">
          <a href="logout.php" class="button button1">Logout</a>
          <span class="Flock">ESU Join the Flock!</span>
          <span class="Tagline">Social Entrepreneurial Campaign</span>

          <div class="ImageBox">
            <img src="esulogo.png" alt="ESU Logo" id="LogoSplash">
            <img src="birds.png" alt="" id="Birds">
          </div>
          <div class="FieldShit">
            <div>Choose what you would like, a matching pair(s) will be donated to the charity of your choice. Please make checks payable to ESU and write Sock Donation in the check memo (Socks available starting Nov 18th)</div>
          </div>
          <div class="FieldShit">
            <p class="InputLabel">Name</p>
            <div class="FieldHolder" id="namefields">
              <div class="TextShit">
                <?php
                $query = "select firstName from customer where email= '$email'";

                $res = mysqli_query($conn, $query);

                $firstName=$res->fetch_assoc()
                ?>
                <input type="text" name="fname" value="<?php echo $firstName['firstName']; ?>" required>
                <p>First</p>

              </div>
              <div class="TextShit">
                <?php
                $query = "select lastName from customer where email= '$email'";

                $res = mysqli_query($conn, $query);

                $lastName=$res->fetch_assoc()
                ?>
                <input type="text" name="lastName" value="<?php echo $lastName['lastName']; ?>"required>
                <p>Last</p>
              </div>
            </div>
          </div>
          <div class="FieldShit">
            <p class="InputLabel">Credit Card Info</p>
            <div class="FieldHolder" id="ccfields">
              <div class="TextShit">
                <?php
                 $query = "SELECT CONCAT(REPEAT('*',CHAR_LENGTH(AES_DECRYPT(creditCard,'encrypt')) - 4), SUBSTRING(AES_DECRYPT(creditCard,'encrypt'), -4)) AS masked_card from customer where email = '$email'";
                 $res = mysqli_query($conn,$query);
                 $cName = $res->fetch_assoc();
                ?>
                <input type="text" name="cc" value="<?php echo $cName['masked_card']; ?>"required>
                <p>CC Number</p>
              </div>
              <div class="TextShit">
                <?php
                $query = "SELECT AES_DECRYPT(csv,'encrypt') as csv from customer where email = '$email'";
                 $res = mysqli_query($conn, $query);
                 $csvName=$res->fetch_assoc();
                ?>
                <input type="text" name="csv"  value="<?php echo $csvName['csv']; ?>"required>
                <p>CVS</p>
              </div>
            </div>
          </div>
          <div class="FieldShit">
            <p class="InputLabel">Email</p>
            <div class="FieldHolder">
              <div class="TextShit">
                <?php
                $query = "select email from customer where email= '$email'";

                $res = mysqli_query($conn, $query);

                $eName=$res->fetch_assoc()
                ?>
                <input type="text" name="emailtext" value="<?php echo $eName['email']; ?>" required>
              </div>
            </div>
          </div>
          <div class="FieldShit">
            <p class="InputLabel">Password</p>
            <div class="FieldHolder">
              <div class="TextShit">
                <?php
                $query = "select password from customer where email= '$email'";

                $res = mysqli_query($conn, $query);

                $pName=$res->fetch_assoc()
                ?>
                <input type="password" name="password" value="<?php echo $pName['password']; ?>"  required>
              </div>
            </div>
          </div>
          <div class="FieldShit">
            <p class="InputLabel">Phone Number (Optional)</p>
            <div class="FieldHolder" id="phonefields">
              <div class="TextShit">
                <?php
                $query = "select phoneNumber from customer where email= '$email'";

                $res = mysqli_query($conn, $query);

                $pnName=$res->fetch_assoc()
                ?>
                <input type="text" class="returnCustNumber" name= "area"  value="<?php echo $pnName['phoneNumber']; ?>">
                <p>###-###-####</p>
              </div>

            </div>
            <div class="FieldShit">
              <p class="InputLabel">Inventory</p>

              <div class="choiceqtstuff">


              <div>
                <?php
                $query = "SELECT item_id, description FROM items where item_id = '1'";
                $res = mysqli_query($conn, $query);
                $sock1 =$res->fetch_assoc();
                ?>
                <input type="checkbox" name="socks1" value="sock1"><?php echo $sock1['description'];?>
                <!--	<label for="sock1">ESU Colors - Medium - Men (6-8) Women (6-9) Donation $20</label>-->

                <label for="sock1qt" class="qtspace">Qt</label>
                <select	name = "sock1qt" value="sock1qt" class="qttf">
                  <option value="select">-</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                </select>


                <div class = "spaceout">

                  <label>Charity</label>
                  <select name = "sock1c" >
                    <?php
                    $query = "select charity_id, charity_name from charity";
                    $res = mysqli_query($conn, $query);
                    while ($row = $res->fetch_assoc())
                    {
                      echo '<option name = "sock1c" value="'.$row['charity_id'].'">'.$row['charity_name'].'</option>';
                    }

                    ?>
                    ?>
                  </select>
                </div>
              </div>
              <div>
                <?php
                $query = "SELECT item_id, description FROM items where item_id = '2'";
                $res = mysqli_query($conn, $query);
                $sock2 =$res->fetch_assoc();
                ?>
                <input type="checkbox" name="socks2" value="socks2"><?php echo $sock2['description'];?>

                <label for="sock2qt" class="qtspace" style="margin-left:135px;">Qt</label>
                <select	class="qttf" name="sock2qt">
                  <option value="select">-</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                </select>
                <div class = "spaceout">





                  <label>Charity</label>
                  <select name = "sock2c" >
                    <?php
                    $query = "select charity_id, charity_name from charity";
                    $res = mysqli_query($conn, $query);
                    while ($row = $res->fetch_assoc())
                    {
                      echo '<option name = "sock2c" value="'.$row['charity_id'].'">'.$row['charity_name'].'</option>';
                    }

                    ?>
                    ?>
                  </select>
                </div>
              </div>
              <div>
                <?php
                $query = "SELECT item_id, description FROM items where item_id = '3'";
                $res = mysqli_query($conn, $query);
                $sock3 =$res->fetch_assoc();
                ?>
                <input type="checkbox" name="socks3" value="sock3"><?php echo $sock3['description'];?>
                <label for="sock3qt" class="qtspace">Qt</label>
                <select name="sock3qt"	class="qttf">
                  <option value="select">-</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                </select>
                <div class = "spaceout">





                  <label>Charity</label>
                  <select name = "sock3c" >
                    <?php
                    $query = "select charity_id, charity_name from charity";
                    $res = mysqli_query($conn, $query);
                    while ($row = $res->fetch_assoc())
                    {
                      echo '<option name = "sock3c" value="'.$row['charity_id'].'">'.$row['charity_name'].'</option>';
                    }

                    ?>
                    ?>
                  </select>
                </div>
              </div>
              <div>
                <?php
                $query = "SELECT item_id, description FROM items where item_id = '4'";
                $res = mysqli_query($conn, $query);
                $sock4 =$res->fetch_assoc();
                ?>
                <input type="checkbox" name="socks4" value="sock4"><?php echo $sock4['description'];?>
                <label for="sock4qt" class="qtspace" style="margin-left:135px;">Qt</label>
                <select name="sock4qt"	class="qttf">
                  <option value="select">-</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                </select>
                <div class = "spaceout">





                  <label>Charity</label>
                  <select name = "sock4c">
                    <?php
                    $query = "select charity_id, charity_name from charity";
                    $res = mysqli_query($conn, $query);
                    while ($row = $res->fetch_assoc())
                    {
                      echo '<option name = "sock4c" value="'.$row['charity_id'].'">'.$row['charity_name'].'</option>';
                    }

                    ?>
                    ?>
                  </select>
                </div>
              </div>

          </div>
        </div>
        <div class="FieldShit">
          <p class="InputLabel">Hats</p>
          <div class="choiceqtstuff">

              <div>
                <?php
                $query = "SELECT item_id, description FROM items where item_id = '5'";
                $res = mysqli_query($conn, $query);
                $hat1 =$res->fetch_assoc();
                ?>
                <input type="checkbox" name="hat1" value="hat1"><?php echo $hat1['description'];?>
                <label for="hat1qt" class="qtspace">Qt</label>
                <select	name="hat1qt" class="qttf">
                  <option value="select">-</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                </select>
                <div class = "spaceout">





                  <label>Charity</label>
                  <select name = "hat1c" >
                    <?php
                    $query = "select charity_id, charity_name from charity";
                    $res = mysqli_query($conn, $query);
                    while ($row = $res->fetch_assoc())
                    {
                      echo '<option name = "hat1c" value="'.$row['charity_id'].'">'.$row['charity_name'].'</option>';
                    }

                    ?>
                    ?>
                  </select>
                </div>
              </div>
              <div>
                <?php
                $query = "SELECT item_id, description FROM items where item_id = '6'";
                $res = mysqli_query($conn, $query);
                $hat2 =$res->fetch_assoc();
                ?>
                <input type="checkbox" name="hat2" value="hat2"><?php echo $hat2['description'];?>
                <label for="hat2qt" class="qtspace">Qt</label>
                <select name="hat2qt"	class="qttf">
                  <option value="select">-</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                </select>
                <div class = "spaceout">





                <label>Charity</label>
                <select name = "hat2c">
                  <?php
                  $query = "select charity_id, charity_name from charity";
                  $res = mysqli_query($conn, $query);
                  while ($row = $res->fetch_assoc())
                  {
                    echo '<option name = "hat2c" value="'.$row['charity_id'].'">'.$row['charity_name'].'</option>';
                  }

                  ?>
                  ?>
                </select>
              </div>
            </div>


        </div>
      </div>

      <div class="FieldShit">
        <p class="InputLabel">Pickup or Delivery</p>
        <div class="choiceqtstuff">


            <div>
              <input type="radio" name="delivery" value="pickup">
              <label for="pickup">I want to pickup my socks. Socks are available for pickup from the C.R.E.A.T.E. Lab (Stroud Hall, Room 107) Tuesdays &amp; Wednesdays 1-4pm</label>
            </div>
            <div>
              <input type="radio" name="delivery" value="delivery">
              <label for="delivery">I want my socks delivered. Delivery available on campus only. Delivery day Tuesdays between 1-4pm</label>
            </div>

        </div>
      </div>
      <div class="FieldShit">
        <p class="InputLabel">Deliver My Socks To (Optional)</p>
        <div class="FieldHolder" id="delivfields">
          <div class="TextShit">
            <input type="text" name ="building" id="buildname">
            <p>Building Name</p>
          </div>
          <div class="TextShit">
            <input type="text" name ="room" id="roomnum">
            <p>Room #</p>
          </div>
        </div>

      </div>
      <hr>
      <div class="foot">
        <p class="InputLabel" style="font-size: 1.2em;">For large orders</p>
        <p class="create" style="font-size: .9em;">Please contact the C.R.E.A.T.E. Lab at esu.createlab@gmail.com</p>
      </div>

      <div class="FieldShit">
        <input type="submit" name= "submit"  id="checkBtn" value="Submit">
      </div>
    </div>


  </div>
  <script type="text/javascript">
  $(document).ready(function(){
    $('#checkBtn').click(function(){
      checked = $("input[type=checkbox]:checked").length;

      if(!checked){
        alert("Please check at least one checkbox");
        return false;
      }
    });
  });
  </script>
  </form>
</body>
</html>
