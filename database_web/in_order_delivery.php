<?php
session_start();
include ('dbconnect.php');
if (isset($_SESSION['s_id']))
			{
        $getID = $_SESSION['s_id'];
        $q = "SELECT * FROM Customer WHERE Customer.LogIn_UID = $getID";
        $result=$mysqli->query($q);
        $row=$result->fetch_array();

      }
?>
<html>
<head>
<title> clean food </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="database.css">
<style>
img{
  float: right;
}
body  {
    background-image: url("bg/bread-board.jpg");
    background-repeat: no-repeat;
    background-attachment: fixed;
    height: 100%;
    background-position: center;
    background-size: cover;
}



</style>
</head>
<body>


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

  </div>
  </div>
  <div class="container">

    <div class="row">

      <div class="col">
        <h2>My Order</h2><hr>
				<?php
				//echo $row['CID'];

        $k = "SELECT * FROM `Order` WHERE Customer_CID = '".$row['CID']."'
				AND (orderStatus = 'Cooking' or orderStatus = 'delivering')";
				$res=$mysqli->query($k);
	      while ($row2=$res->fetch_array())
				{?>
					<h3 style="color:red;"> Status: <?php echo $row2['orderStatus']; ?>| Price:<?php echo $row2['TotalPrice']; ?> </h3>
					<?php

					//echo $row2['OrderID'];
					$j = "SELECT ProductName,Quantity FROM OrderDetail, Product WHERE
					OrderDetail.Product_ProductID = Product.ProductID AND Order_OrderID = '".$row2['OrderID']."'";
					$res2=$mysqli->query($j);

		      while ($row3=$res2->fetch_array())
					{

						echo $row3['ProductName'];
						echo ' x ';
						echo $row3['Quantity'];
						echo '<hr>';


					}
				}


				?>








</div>
</div>


</body>
</html>
