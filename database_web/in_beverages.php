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
			if (isset($_POST['hi2']))
			{

				$number = $_POST['hi2'];

				$up = "SELECT * FROM Product WHERE ProductID = '$number' ";
				$res=$mysqli->query($up);
				$rows=$res->fetch_array();
				$menu = $rows['ProductName'];
				$price = $rows['Price'];
				$cal = $rows['Cal'];


				if (in_array($menu, $_SESSION['food'])) {
			    //
				}
				else{
					$_SESSION['food'][] = $menu;
					$_SESSION['quantity'][] = 1;
					$_SESSION['price'][] = $price;
					$_SESSION['cal'][] = $cal;
				}



				//print_r ($_SESSION['food']);

			//
			}
?>
<!DOCTYPE html>
<html>
<head>
<title> beverages </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="database.css">

<style>

body  {
    background-image: url("bg/lights.jpg");
    background-repeat: no-repeat;
    background-attachment: fixed;
    height: 100%;
    background-position: center;
    background-size: cover;
}
.selected{
  opacity: 0.5;
  cursor: none;
}
.button3 {background-color: #f44336;}
.button4 {background-color: #e7e7e7; color: black;} /* Gray */

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
  </div>


    <h5> Beverages </h5>
  <div class="center">
    <?php
    include_once 'dbconnect.php';
    $sql = "SELECT * FROM Product WHERE ProductType_ProductTypeID = '3'";
    $result = $mysqli->query($sql);
    if(!$result){
      $mysqli->error;
    }
    while($row = $result->fetch_assoc()){

      ?>
      <div class="box">
      <div class="hvrbox">
      <center><img src="<?php echo $row['imgurl']; ?>" class="hvrbox-layer_bottom" width="70%" height="70%"></center>
      <p class="serif"> <?php echo $row['ProductName']; ?> </p>
      <font size = "5px"> <?php echo $row['Price']; ?> bath</font>


  	   <div class="hvrbox-layer_top">
  		     <div class="hvrbox-text">Cal: <?php echo $row['Cal']; ?> for 8 ounces<br>  Price: <?php echo $row['Price']; ?> Baht </div>
      </div>
    </div>

  <table bgcolor="black" align="center" width=100%>
		<tr>
      <td>
				<form action="in_beverages.php" method="POST">
					<?php if (in_array( $row['ProductName'], $_SESSION['food'])){?>
						<button class="button button3" type="Submit"  value="<?php echo $row['ProductID']?>"> In Cart </button>

					<?php
					}
					else{?>
							<button class="button button4" type="Submit" name="hi2" value="<?php echo $row['ProductID']?>"> Buy Here </button>
						<?php
					}
					?>



				</form>
  			<!--<img type="image" src="food/shop.png" alt="Submit" width="50" height="50"></td>-->
			</tr>
		</table>

  	</div>
    <?php } ?>

</div>

</div>   <!-- center-->


<script>
  function toggle(productID, event){
    if(document.getElementById(productID).checked == true){
      document.getElementById(productID).checked = false
      event.target.className = event.target.className.replace(' selected','')
    } else {
      document.getElementById(productID).checked = true
      event.target.className += " selected"
    }
  }
  function clickSubmit(){
    document.getElementById('form').submit()
  }
</script>


  <!-- background-->


</body>
</html>






  <!-- background-->
