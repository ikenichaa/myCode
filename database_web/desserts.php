<!DOCTYPE html>
<html>
<head>
<title> desserts </title>
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
</style>
</head>
<body>
  <!-- Navigation-->

  <?php include 'header_front.php';?>
    <h5> Desserts </h5>


    <div class="center">
    <?php
    include_once 'dbconnect.php';
    $sql = "SELECT * FROM Product WHERE ProductType_ProductTypeID = '2'";
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
  </div>
    <?php } ?>
