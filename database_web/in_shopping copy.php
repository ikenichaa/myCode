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
			$_SESSION['sump']=0;

					for ($i=0; $i < count($_SESSION['food']); $i++)
					{
						$p = $_SESSION['price'][$i];
						$q = $_SESSION['quantity'][$i];
						$t = $p*$q;
						$_SESSION['sump']=$_SESSION['sump']+$t;
					}

			$_SESSION['sumc']=0;

			for ($i=0; $i < count($_SESSION['food']); $i++)
			{
				$p = $_SESSION['cal'][$i];
				$q = $_SESSION['quantity'][$i];
				$t = $p*$q;
				$_SESSION['sumc']=$_SESSION['sumc']+$t;
			}
if (isset($_GET['delID']))
{
	array_splice($_SESSION['food'], $_GET['delID'], 1);
	array_splice($_SESSION['quantity'], $_GET['delID'], 1);
	array_splice($_SESSION['price'], $_GET['delID'], 1);
	array_splice($_SESSION['cal'], $_GET['delID'], 1);
	$_SESSION['sump']=0;

			for ($i=0; $i < count($_SESSION['food']); $i++)
			{
				$p = $_SESSION['price'][$i];
				$q = $_SESSION['quantity'][$i];
				$t = $p*$q;
				$_SESSION['sump']=$_SESSION['sump']+$t;
			}

	$_SESSION['sumc']=0;

	for ($i=0; $i < count($_SESSION['food']); $i++)
	{
		$p = $_SESSION['cal'][$i];
		$q = $_SESSION['quantity'][$i];
		$t = $p*$q;
		$_SESSION['sumc']=$_SESSION['sumc']+$t;
	}



	Header ('Location: in_shopping.php');

}

if (isset($_GET['addID']))
{
	$_SESSION['quantity'][$_GET['addID']] +=1;
	$_SESSION['sump']=0;

			for ($i=0; $i < count($_SESSION['food']); $i++)
			{
				$p = $_SESSION['price'][$i];
				$q = $_SESSION['quantity'][$i];
				$t = $p*$q;
				$_SESSION['sump']=$_SESSION['sump']+$t;
			}

	$_SESSION['sumc']=0;

	for ($i=0; $i < count($_SESSION['food']); $i++)
	{
		$p = $_SESSION['cal'][$i];
		$q = $_SESSION['quantity'][$i];
		$t = $p*$q;
		$_SESSION['sumc']=$_SESSION['sumc']+$t;
	}
	Header ('Location: in_shopping.php');
}

if (isset($_GET['minusID']))
{
	if ($_SESSION['quantity'][$_GET['minusID']]==1) {
		array_splice($_SESSION['food'], $_GET['minusID'], 1);
		array_splice($_SESSION['quantity'], $_GET['minusID'], 1);
		array_splice($_SESSION['price'], $_GET['minusID'], 1);
		array_splice($_SESSION['cal'], $_GET['minusID'], 1);

	}
	else
	{
		$_SESSION['quantity'][$_GET['minusID']] =$_SESSION['quantity'][$_GET['minusID']]-1;
	}
	$_SESSION['sump']=0;

			for ($i=0; $i < count($_SESSION['food']); $i++)
			{
				$p = $_SESSION['price'][$i];
				$q = $_SESSION['quantity'][$i];
				$t = $p*$q;
				$_SESSION['sump']=$_SESSION['sump']+$t;
			}

	$_SESSION['sumc']=0;

	for ($i=0; $i < count($_SESSION['food']); $i++)
	{
		$p = $_SESSION['cal'][$i];
		$q = $_SESSION['quantity'][$i];
		$t = $p*$q;
		$_SESSION['sumc']=$_SESSION['sumc']+$t;
	}
	Header ('Location: in_shopping.php');
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


					for ($i=0; $i < count($_SESSION['food']); $i++)
					{
						echo $_SESSION['food'][$i];
						echo (' x ');
						echo $_SESSION['quantity'][$i];
						?>
						<div class="cart_right">
							<a href="in_shopping.php?delID=<?php echo $i; ?>"><img style="margin: 0px 2px"src="error.png" width="25px" height="25px"></a>
		          <a href="in_shopping.php?addID=<?php echo $i; ?>"><img style="margin: 0px 2px"src="plus-2.png" width="25px" height="25px"></a>
		          <a href="in_shopping.php?minusID=<?php echo $i; ?>"><img style="margin: 0px 2px" src="minus.png" width="25px" height="25px"></a>


						</div>


						<?php echo ('<hr>');
					}

				?>


        <h4> Total Price: <?php echo $_SESSION['sump']?> baht</h4>
        <h4> Total Cal: <?php echo $_SESSION['sumc']?> cal</h4>
        <h4> Address </h4>
        <form action="confirm_order.php" method="POST">
          <?php
          $address = "SELECT * FROM Customer,LogIn,Address WHERE Customer.CID = Address.Customer_CID
          AND LogIn.UID = Customer.LogIn_UID AND UID='$getID'";
          $result = $mysqli->query($address);
          while($row = $result->fetch_array()): ?>
          <input type="radio" name="address_id" value="<?= $row['AddressID'] ?>" checked> <?= $row['Address'] ?><br />
        <?php endwhile	?>

<br><br>
        <input type="submit" id="signin" value="Confirm order" name="order">
			</form>



</div>
</div>


</body>
</html>
