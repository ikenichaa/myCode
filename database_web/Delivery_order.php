<?php
session_start();
if(isset($_SESSION['s_role'])){
  if($_SESSION['s_role']!='Delivery Staff'){
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
        $q = "SELECT * FROM Staff WHERE Staff.LogIn_UID = $getID";
        $result=$mysqli->query($q);
        $row=$result->fetch_array();
      }
?>
<html>
<head>
<title> order </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="database.css">
<style>
.select{
  width:50px;
}
</style>
</head>
<body>

  <!-- Navigation-->
  <div class="del">
  <div id="head">
  <div class="topnav-right">

      <div class="dropdown">
        <a href ="Delivery_order.php"><button class="dropbtn">ORDER |</button></a>
      </div>

      <div class="dropdown">
        <button class="dropbtn"><?php echo $row['FirstName']. "|" ;?></button>
        <div class="dropdown-content">
          <a href="logout.php">LOG OUT</a>
        </div>
      </div>

    </div>
    </div>
    <!-- Contact us-->
        <div class="container">

          <div class="row">

            <div class="mid">
              <h2>DELIVERY ORDER</h2><hr>



              <center>
              <table border="1">
                <tr>
                  <th>OID</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Tel</th>
                  <th>Address</th>
                  <th>Order Date</th>
                  <th>Order Detail</th>
                  <th>Total Price</th>
                  <th>Total Cal</th>
                  <th>Status</th>
                </tr>
<?php
include_once 'dbconnect.php';

$sql_deliver = "SELECT * FROM DELIVERY WHERE Staff_SID=$row[SID]";
$result_deliver = $mysqli->query($sql_deliver);

if(mysqli_num_rows($result_deliver)>0){

  $sql = "SELECT * FROM `Order`, `Staff`, `Address`, `Delivery`, `Customer`
  WHERE Order.Customer_CID = Customer.CID
  AND Order.Address_AddressID = Address.AddressID
  AND Delivery.Staff_SID=Staff.SID
  AND Order.OrderID = Delivery.Order_OrderID
  AND Staff.SID = $row[SID]
  ";
  $result = $mysqli->query($sql);
  if(!$result){
    $mysqli->error;
  }
  while($row = $result->fetch_assoc()){
  ?>
      <tr>
        <td><?php echo $row['OrderID']; ?></td>
        <td><?php echo $row['FirstName']; ?></td>
        <td><?php echo $row['LastName']; ?></td>
        <td><?php echo $row['Tel']; ?></td>
        <td><?php echo $row['Address']; ?></td>
        <td><?php echo $row['OrderDate']; ?></td>
        <?php
        $sql2 = "SELECT * FROM OrderDetail, Product WHERE OrderDetail.Product_ProductID=Product.ProductID AND OrderDetail.Order_OrderID='".$row['OrderID']."'";
        $orderDetail = '';
        $totalPrice = 0;
        $totalCal = 0;
        $result2 = $mysqli->query($sql2);
        if(!$result2){
          $mysqli->error;
        }
        $totalPrice = 0;
        $totalCal = 0;
        while($row2 = $result2->fetch_assoc()){
          $orderDetail .= $row2['ProductName']." x ".$row2['Quantity'].", ";
          $totalPrice += $row2['Quantity']*$row2['Price'];
          $totalCal += $row2['Quantity']*$row2['Cal'];
        }
        $orderDetail = substr($orderDetail, 0, -2);
      ?>
      <td><?php echo $orderDetail; ?></td>
      <td><?php echo $totalPrice ?></td>
      <td><?php echo $totalCal ?></td>
      <td>
      <select onchange="changestatus(<?php echo $row['OrderID']; ?>, event)">
          <option value="cooking"
          <?php
            if($row['orderStatus']=='cooking'){
              echo "selected";
            }
          ?>
          > COOKING </option>
          <option value="delivering"
          <?php
            if($row['orderStatus']=='delivering'){
              echo "selected";
            }
          ?>>
          DELIVERING</option>
          <option value="success"
          <?php
            if($row['orderStatus']=='success'){
              echo "selected";
            }
          ?>
          >SUCCESS</option>
        </select>
        </td>
      </tr>
  <?php }
}
?>
</table>
















            </div>
          </div>
        </div>
<script>
  function changestatus(id, event){
    var url = window.location.href
    if(url.indexOf('?')>-1){
      window.location.href = url.split('?')[0] + "?id="+id+"&status="+event.target.value
    } else {
      window.location.href = window.location.href + "?id="+id+"&status="+event.target.value
    }

  }
</script>

<?php

  if(isset($_GET['id'])){
    $id = $_GET['id'];
    $status = $_GET['status'];
    $sql = "UPDATE `Order` SET orderStatus='$status' WHERE OrderID=$id";
    $result = $mysqli->query($sql);
    if($result){
      echo "<script>
              var url = window.location.href
              window.location.href = url.split('?')[0]
            </script>";
    } else {
      echo $mysqli->error;
    }
  }

?>







</div>


</body>
</html>
