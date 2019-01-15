<?php
session_start();
if(isset($_SESSION['s_role'])){
  if($_SESSION['s_role']!='Admin'){
    header("Location: login.php");
  }
} else {
  header("Location: login.php");
}

?>

<?php
include_once 'dbconnect.php';

?>


<!DOCTYPE html>
<html>
<head>
<title> order </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="database.css">
<style>
.select{
  width:50px;
}
body  {
    background-image: url("bg/christmas.jpg");
    background-repeat: no-repeat;
    background-attachment: fixed;
    height: 100%;
    background-position: center;
    background-size: cover;
}
</style>
</head>
<body>

  <!-- Navigation-->
<?php include 'staff_header.php'; ?>
    <!-- Contact us-->
        <div class="container">

          <div class="row">

            <div class="mid">
              <h2>Order</h2><hr>
              <?php
              if (isset($_GET['orderID']))
              {
                $j = "SELECT ProductName,Quantity FROM OrderDetail, Product WHERE
      					OrderDetail.Product_ProductID = Product.ProductID AND Order_OrderID = '".$_GET['orderID']."'";
      					$res2=$mysqli->query($j);

      		      while ($row3=$res2->fetch_array())
      					{

      						echo $row3['ProductName'];
      						echo ' x ';
      						echo $row3['Quantity'];
      						echo '<hr>';


      					}


            }?>



</body>
</html>
