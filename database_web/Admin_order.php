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
              <h2>ORDER</h2><hr>
              <h4>SELECT DATE/MONTH/YEAR OF ORDER</h4>
              <table>
              <tr>
                <th>DATE</th>
                <th>MONTH</th>
                <th>YEAR</th>
              </tr>
              <tr>
                <td>
			<form action = "Admin_order.php" method = "POST">
              <select id="wgt" name = "date">
                <option value="-">-</option>
                <?php for($i = 1; $i <= 31; $i++): ?>
                  <option value="<?= sprintf("%02d", $i) ?>"
                    <?= isset($_POST['date']) && $_POST['date'] == sprintf("%02d", $i) ? 'selected' : '' ?>
                    ><?= $i ?></option>
                <?php endfor ?>

              </select>
            </td>

              <td>
              <select id="wgt" name = "month">
                <option value="-">-</option>
                <?php for($i = 1; $i <= 12; $i++): ?>
                  <option value="<?= sprintf("%02d", $i) ?>"
                    <?= isset($_POST['month']) && $_POST['month'] == sprintf("%02d", $i) ? 'selected' : '' ?>>
                    <?= date('F', mktime(0, 0, 0, $i, 1, 2000) ) ?>
                  </option>
                <?php endfor ?>
              </select>
            </td>

            <td>
            <select id="wgt" name = "year">
              <option value="-">-</option>
              <option value="2018" <?= isset($_POST['year']) && $_POST['year'] == 2018 ? 'selected' : '' ?>>2018</option>
              <option value="2019" <?= isset($_POST['year']) && $_POST['year'] == 2019 ? 'selected' : '' ?>>2019</option>
              <option value="2020" <?= isset($_POST['year']) && $_POST['year'] == 2020 ? 'selected' : '' ?>>2020</option>
              <option value="2021" <?= isset($_POST['year']) && $_POST['year'] == 2021 ? 'selected' : '' ?>>2021</option>
            </select>
          </td>

          <td>
             <input type="submit" value="search" name = "submit"></form>
          </td>

          </tr>

            </table>

<br><br>


<table border="3" style="width:1000px;" cellpadding="8" cellspacing="0">
<tr>
<td>OID</td>
<td>CID</td>
<td>Order Date</td>
<td>Order Time</td>
<td>Order Detail</td>
<td>Total Price</td>
<td>Total Cal</td>
<td>Status</td><td>SID</td></tr>

			  <?php
        $date_query = '';
        if(isset($_POST['submit'])){

					  $date = $_POST['date'];
					  $month = $_POST['month'];
					  $year = $_POST['year'];
            if ($date == '-') $date = '%';
            if ($month == '-') $month = '%';
            if ($year == '-') $year = '%';


            $date_query = " AND OrderDate LIKE '" . $year . "-" . $month . "-" . $date . "'";


        }
        $q = "SELECT * FROM `order` AS o, delivery AS d, product AS p, orderdetail AS od WHERE o.OrderID = d.Order_OrderID
        AND p.ProductID = od.Product_ProductID AND o.OrderID = od.Order_OrderID" . $date_query;
            $data = [];
            $check = [];
											if($result = $mysqli->query($q)){


												while($row = $result->fetch_array()){

                          if (in_array($row['OrderID'], $check)) {
                  			    //
                  				}
                          else {
                            $data[] = $row;
                            $check[] = $row['OrderID'];
                          }


                          }
                        }

	?>

<?php foreach($data as $row): ?>

<td style="color:black"><?= $row['OrderID'] ?></td>
<td style="color:black"><a href="specific_customer.php?getID=<?php echo $row['Customer_CID']; ?>">
  <?= $row['Customer_CID'] ?></a></td>
<td style="color:black"><?= $row['OrderDate'] ?></td>
<td style="color:black"><?= $row['OrderTime'] ?></td>
<td style="color:black">
  <a href="specific_order.php?orderID=<?php echo $row['OrderID']; ?>"> Order </a>
</td>
<td style="color:black"><?= $row['TotalPrice'] ?></td>
<td style="color:black"><?= $row['TotalCal'] ?></td>
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
<td style="color:black"><a href="specific_staff.php?getstaffID=<?php echo $row['Staff_SID']; ?>">
  <?= $row['Staff_SID'] ?></td></a>
</tr>
<?php endforeach ?>
</table>
          <br>

            </div>
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

</body>
</html>
