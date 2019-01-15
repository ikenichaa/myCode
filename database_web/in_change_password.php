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
				$q = "SELECT * FROM Customer, Address, LogIn
				WHERE Address.Customer_CID = Customer.CID AND
				      LogIn.UID = Customer.LogIn_UID AND
				      Customer.LogIn_UID = $getID";

        $result=$mysqli->query($q);
        $row=$result->fetch_array();

				$o = "SELECT Password FROM LogIn WHERE UID = $getID";
				$old = $mysqli->query($o);
				$older=$old->fetch_array();
				$oldpw = $older['Password'];


				$message="";




      }

if (isset($_POST['changepass']))
			{
					$oldp = $_POST['oldpass'];
          $newp = $_POST['newpass'];
          $oldpass = MD5($oldp);

					$newp = $_POST['newpass'];
          $newpass = MD5($newp);
          $c0 ="SET @p0='".$getID."'";
  				$c1 ="SET @p1='".$oldp."'";
          $c2 ="SET @p2='".$newp."'";

          $c3 ="SET @p3=''";

  				$c4 = "CALL `change_password`(@p0, @p1, @p2, @p3);";
          $mysqli->query($c0);
          $mysqli->query($c1);
          $mysqli->query($c2);
          $mysqli->query($c3);
          $mysqli->query($c4);

					if ($oldpw==$oldpass)
					 {
							header ("Location: changepass_success.php");
						}

					else
					{
						$message="wrong old password";
					}

			}
?>

<html>
<head>
<title> clean food </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="database.css">
<style>
body  {
    background-image: url("bg/nut.jpg");
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
  <!-- Contact us-->
  <div class="container">

    <div class="row">

      <div class="col">
        <h2>Reset Password</h2><hr><br>
        <form action="in_change_password.php" method="POST">
          <label>Old Password</label>
          <input type="password" name="oldpass" placeholder="old password">

					<label>New Password</label>
          <input type="password" name="newpass" placeholder="new password">
					<label><font color="red"><?php echo $message?></font></label>






      <input type="submit" id="signin" value="SUBMIT" name="changepass">

        </form>
      </div>
    </div>




</body>
</html>
