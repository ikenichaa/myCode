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
              <h2>Staff</h2><hr>
              <?php
              if (isset($_GET['getstaffID']))
              {
                $q = "SELECT * FROM Staff WHERE SID = '".$_GET['getstaffID']."'";
                $result = $mysqli->query($q);
                $row = $result->fetch_array();
                echo '<table border="3" style="width:1000px;" cellpadding="8" cellspacing="0">';
                echo '<tr>';
    						echo '<td>SID</td>';
    						echo '<td>FirstName</td>';
    						echo '<td>LastName</td>';
    						echo '<td>Tel.</td>';
    						echo '<td>Address</td>';
    						echo '<td>Position</td>';
    						echo '<td>Salary</td>';

    						echo '</tr>';



                echo '<tr>';
								echo '<td style="color:black">'.$row['SID'].'</td>';
								echo '<td style="color:black">'.$row['FirstName'].'</td>';
								echo '<td style="color:black">'.$row['LastName'].'</td>';

								echo '<td style="color:black">'.$row['Tel'].'</td>';

								echo '<td style="color:black">'.$row['Address'].'</td>';
                echo '<td style="color:black">'.$row['Position'].'</td>';
                echo '<td style="color:black">'.$row['Salary'].'</td>';

                echo '</tr>';


            }?>



</body>
</html>
