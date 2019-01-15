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
              <h2>Customer</h2><hr>
              <?php
              if (isset($_GET['getID']))
              {
                $q = "SELECT * FROM Customer,LogIn,Address WHERE Customer.CID = Address.Customer_CID
                AND LogIn.UID = Customer.LogIn_UID AND Customer.CID = '".$_GET['getID']."'";
                $result = $mysqli->query($q);
                $row = $result->fetch_array();
                echo '<table border="3" style="width:1000px;" cellpadding="8" cellspacing="0">';
                echo '<tr>';
                echo '<td>CID</td>';
                echo '<td>FirstName</td>';
                echo '<td>LastName</td>';
                echo '<td>Gender</td>';
                echo '<td>Tel.</td>';
                echo '<td>Email</td>';
                echo '<td>Adddress</td>';
                echo '<td>Status</td>';
                echo '</tr>';


                echo '<tr>';
								echo '<td style="color:black">'.$row['CID'].'</td>';
								echo '<td style="color:black">'.$row['FirstName'].'</td>';
								echo '<td style="color:black">'.$row['LastName'].'</td>';
								echo '<td style="color:black">'.$row['Gender'].'</td>';
								echo '<td style="color:black">'.$row['Tel'].'</td>';
								echo '<td style="color:black">'.$row['Email'].'</td>';
								echo '<td style="color:black">'.$row['Address'].'</td>';
								echo '<td style="color:black">'.$row['LogInStatus'].'</td>';
                echo '</tr>';


            }?>



</body>
</html>
