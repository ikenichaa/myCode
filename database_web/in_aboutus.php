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
?>
<html>
<head>
<title> clean food </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="database.css">
<style>

  body {
    background-image:url("healthy.jpg");
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
                <h2>About Us</h2><hr><br>



            <p>Healthy eating means eating a variety of foods that give you the nutrients
              you need to maintain your health, feel good, and have energy. These nutrients
              include protein, carbohydrates, fat, water, vitamins, and minerals.

              Nutrition is important for everyone. When combined with being
              physically active and maintaining a healthy weight, eating well
              is an excellent way to help your body stay strong and healthy. <hr><br>
              <br>Want to eat better but don't have the time or know what to cook? We have you covered! Unicronnoi  is a local fit, fresh meal company that will cook and deliver meals TO YOU!

              Get variety in your diet while still being healthy or simply choose what options work best for you with this completely customizable menu!


      <p style.left="100px";></p>


</body>
</html>
