<?php
session_start();
if(isset($_SESSION['s_role'])){
  if($_SESSION['s_role']!='Customer'){
    header("Location: login.php");
  }
} else {
  header("Location: login.php");
}

?>
<?php

include ('dbconnect.php');
if (isset($_SESSION['s_id']))
			{
        $getID = $_SESSION['s_id'];
        $q = "SELECT * FROM Customer WHERE Customer.LogIn_UID = $getID";
        $result=$mysqli->query($q);
        $row=$result->fetch_array();
      }
if (isset($_POST['add_address_customer']))
			{

				$address = $_POST['new_address'];

				if ($address!=""){

					$v = "INSERT INTO Address(Address,Customer_CID) " .
					" VALUES('".$address."','".$row['CID']."') ";
          if ($mysqli->query($v))
          {
            header("Location: in_edit_info.php");
          }


				}

			}
?>

<html>
<head>
<title> clean food </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="database.css">
<style>

  body {
    background-image:url("bg/christmas.jpg");
    background-repeat: no-repeat;
    background-attachment: fixed;
    height: 100%;
     background-position:center;

    background-size:cover;
  }
</style>
</head>
<body>


  <!-- Navigation-->

    <div id="head">
      <div class="topnav-right">
          <div class="dropdown">
            <a href ="in_home.php"><button class="dropbtn">HOME |</button></a>
          </div>

          <div class="dropdown">
            <button class="dropbtn">MENU |</button>
              <div class="dropdown-content">

                <a href="in_maincourses.php">MAIN COURSES</a>
                <a href="in_desserts.php">DESSERTS</a>
                <a href="in_beverages.php">BEVERAGES</a>
              </div>
            </div>



          <div class="dropdown">
            <a href ="in_aboutus.php"><button class="dropbtn">ABOUT US |</button></a>
          </div>

          <div class="dropdown">
            <button class="dropbtn">CONTACT US |</button>
            <div class="dropdown-content">
              <a href="in_contact_info.php">Contact Info</a>
              <a href="in_message.php">Leave a message</a>
            </div>
          </div>

          <div class="dropdown">
            <button class="dropbtn"><?php echo $row['FirstName']. "|" ;?></button>
            <div class="dropdown-content">
              <a href="in_edit_info.php">Edit Profile</a>
              <a href="in_order_delivery.php">Order Status</a>
              <a href="logout.php">LOG OUT</a>
            </div>
          </div>

          <div class="dropdown">
            <div class="ibutton">
            <div id="close-image">
              <a href="in_shopping.php"><img src="food/shop.png"></a>
            </div>
          </div>
        </div>

    </div> <!-- top right-->

        </div>
    <div class="contain">


        <div class="row">
            <div class="col">
              <h2>Add Address</h2><hr><br>
              <form action="in_add_address.php" method="POST">
              <label>Address</label>
              <textarea id="subject" name="new_address" style="height:50px"> </textarea>
              <input type="submit" id="signin" value="SUBMIT" name="add_address_customer">
              </form>





</body>
</html>
