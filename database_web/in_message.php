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
if (isset($_POST['feed']))
			{
        $mes = $_POST['subject'];
        var_dump($mes);
        echo '<br>';
        $c0 ="SET @p0='".$mes."'";
				$c1 ="SET @p1='".$row['CID']."'";





				$c3 = "SELECT `add_feedback`(@p0, @p1)";

				if ($mysqli->query($c0))
        {
          //echo 'c0';
        }
        if ($mysqli->query($c1))
        {
          //echo 'c1';
        }

				if ($mysqli->query($c3)){
          echo 'yay';

        }
        if ($mes!=""){
          header("Location: feedback_success.php");
        }


				// $date = "SELECT CURRENT_DATE()";
				// $res=$mysqli->query($date);
				// $r=$res->fetch_array();
				// $day = $r['CURRENT_DATE()'];
				// $mes = $_POST['subject'];
				// echo $mes;
				// if ($mes!=""){
				// 	echo "huray<br>";
				// 	echo $mes;
				// 	echo $day;
				// 	echo $row['CID'];
				// 	$v = "INSERT INTO Feedback(Detail,Date,Customer_CID) " .
				// 	" VALUES('".$mes."','".$day."','".$row['CID']."') ";
				// 	if ($mysqli->query($v))
				// 	{
				// 		header("Location: feedback_success.php");
				// 	}
        //
        //
				// }

			}
?>
<html>
<head>
<title> clean food </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="database.css">
</head>
<body>

<div class="backg">
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
  <!-- Contact us-->
      <div class="container">

        <div class="row">

          <div class="col">
            <h2>SEND US A MESSAGE</h2><hr><br>
            <form action="in_message.php" method='POST'>



          <label>Message</label>
          <textarea id="subject" name="subject" placeholder="Write something.." style="height:170px"></textarea>
          <input type="submit" name = "feed" value="Submit">

            </form>
          </div>
        </div>
      </div>

</div>

</body>
</html>
