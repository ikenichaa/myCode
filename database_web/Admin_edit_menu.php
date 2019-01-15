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

if(isset($_GET['deleteID']))
{
    $getproductID = $_GET['deleteID'];
    $sqlquery_delete_product = "DELETE FROM product WHERE ProductID = $getproductID";
    mysqli_query($mysqli,$sqlquery_delete_product);
}
else if(isset($_POST['pname']) && isset($_POST['cal']) && isset($_POST['price']) && isset($_POST['pid']) && isset($_POST['url'])){

  $pdn = $_POST['pname'];
  $cal = $_POST['cal'];
  $price = $_POST['price'];
  $pid = $_POST['pid'];
  $url = $_POST['url'];
  $sqlquery_add_menu = "INSERT INTO Product (ProductName,Cal,Price,ProductType_ProductTypeID,imgurl) VALUES ('$pdn','$cal','$price','$pid','$url')";
  mysqli_query($mysqli,$sqlquery_add_menu);
}


?>

<!DOCTYPE html>
<html>
    <head>
        <title> Edit Menu</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="database.css">
<style>

</style>
<style>

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
</body><div class="del">
  <?php include 'staff_header.php'; ?>
    <div class="container">

          <div class="row">

            <div class="mid">
              <h2>EDIT MENU</h2><hr>
              <center>
<a href="Admin_add_menu.php"><input type="submit"  value="ADD MENU"></a>
<h1>Main Course</h1>
<table border='2'>
      <tr>
          <th>
            ProductID
          </th>
          <th>
            ProductName
          </th>
          <th>
            Cal
          </th>
          <th>
            Price
          </th>
          <th>
            ProductTypeID
          </th>
          <th>
            imgurl
          </th>
          <th> Delete
          </th>
        </tr>
        <?php
          $sql = "SELECT * FROM Product WHERE ProductType_ProductTypeID = '1'";
          $result = $mysqli->query($sql);
          if(!$result){
            $mysqli->error;
          }
          while($row = $result->fetch_assoc()){
        ?>
            <tr>
              <td><?php echo $row['ProductID']; ?></td>
              <td><?php echo $row['ProductName']; ?></td>
              <td><?php echo $row['Cal']; ?></td>
              <td><?php echo $row['Price']; ?></td>
              <td><?php echo $row['ProductType_ProductTypeID']; ?></td>
              <td><img src="<?php echo $row['imgurl']; ?>" width="40"></td>
              <td><a href="Admin_edit_menu.php?deleteID=<?php echo $row['ProductID']; ?>"><img style="margin: 0px 10px"src="error.png" width="15px" height="15px"></a></td>
            </tr>
        <?php
          }
        ?>
    </table>

<?php

// $sqlquery_menu_maincourse = "SELECT * FROM product WHERE ProductType_ProductTypeID = 1";
// $result_query_menu_maincourse = mysqli_query($conn,$sqlquery_menu_maincourse);
// while($rowmaincourse = mysqli_fetch_assoc($result_query_menu_maincourse)){
// echo "
// <tr>
// <td>".$rowmaincourse['ProductID']."
// </td>
// <td>".$rowmaincourse['ProductName']."
// </td>
// <td>".$rowmaincourse['Cal']."
// </td>
// <td>".$rowmaincourse['Price']."
// </td>
// <td>".$rowmaincourse['ProductType_ProductTypeID']."
// </td>
// <td>".$rowmaincourse['imgurl']."&nbsp;&nbsp;&nbsp;<a href='?delete=".$rowmaincourse['ProductID']."'>&times;</a>
// </td>
// </tr>
// ";
// }
?>



<h1>Desserts</h1>
<table border='2'>
      <tr>
          <th>
            ProductID
          </th>
          <th>
            ProductName
          </th>
          <th>
            Cal
          </th>
          <th>
            Price
          </th>
          <th>
            ProductTypeID
          </th>
          <th>
            imgurl
          </th>
          <th> Delete
          </th>
        </tr>
        <?php
          $sql = "SELECT * FROM Product WHERE ProductType_ProductTypeID = '2'";
          $result = $mysqli->query($sql);
          if(!$result){
            $mysqli->error;
          }
          while($row = $result->fetch_assoc()){
        ?>
            <tr>
              <td><?php echo $row['ProductID']; ?></td>
              <td><?php echo $row['ProductName']; ?></td>
              <td><?php echo $row['Cal']; ?></td>
              <td><?php echo $row['Price']; ?></td>
              <td><?php echo $row['ProductType_ProductTypeID']; ?></td>
              <td><img src="<?php echo $row['imgurl']; ?>" width="40"></td>
              <td><a href="Admin_edit_menu.php?deleteID=<?php echo $row['ProductID']; ?>"><img style="margin: 0px 10px"src="error.png" width="15px" height="15px"></a></td>
            </tr>
        <?php
          }
        ?>
    </table>

<h1>Beverages</h1>
<table border='2'>
      <tr>
          <th>
            ProductID
          </th>
          <th>
            ProductName
          </th>
          <th>
            Cal
          </th>
          <th>
            Price
          </th>
          <th>
            ProductTypeID
          </th>
          <th>
            imgurl
          </th>
          <th> Delete
          </th>
        </tr>
        <?php
          $sql = "SELECT * FROM Product WHERE ProductType_ProductTypeID = '3'";
          $result = $mysqli->query($sql);
          if(!result){
            $mysqli->error;
          }
          while($row = $result->fetch_assoc()){
        ?>
            <tr>
              <td><?php echo $row['ProductID']; ?></td>
              <td><?php echo $row['ProductName']; ?></td>
              <td><?php echo $row['Cal']; ?></td>
              <td><?php echo $row['Price']; ?></td>
              <td><?php echo $row['ProductType_ProductTypeID']; ?></td>
              <td><img src="<?php echo $row['imgurl']; ?>" width="40"></td>
              <td><a href="Admin_edit_menu.php?deleteID=<?php echo $row['ProductID']; ?>"><img style="margin: 0px 10px"src="error.png" width="15px" height="15px"></a></td>
            </tr>
        <?php
          }
        ?>
    </table>

</body>
<style>
    table{
        width:60%;
    }
    td{
        padding:20px;
        text-align:center;
    }
    </style>
    </html>
