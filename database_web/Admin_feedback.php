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
<title> feedback </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="database.css">
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
<body>

  <?php include 'staff_header.php'; ?>

        <div class="container">

          <div class="row">

            <div class="mid">
              <h2>CUSTOMER FEEDBACK</h2><hr>
              <center>

              <br>




            <?php
						$q = "SELECT * FROM Feedback,Customer WHERE Customer.CID = Feedback.Customer_CID";


						if($result = $mysqli->query($q)){

						echo '<table border="3" style="width:1000px;" cellpadding="8" cellspacing="0">';
						echo '<tr>';
						echo '<td>CID</td>';
						echo '<td>FirstName</td>';
						echo '<td>LastName</td>';
						echo '<td>Tel.</td>';
						echo '<td>Date</td>';
						echo '<td>Detail</td>';
						echo '</tr>';


							while($row = $result->fetch_array()){

								echo '<tr>';
								echo '<td style="color:black">'.$row['Customer_CID'].'</td>';
								echo '<td style="color:black">'.$row['FirstName'].'</td>';
								echo '<td style="color:black">'.$row['LastName'].'</td>';
								echo '<td style="color:black">'.$row['Tel'].'</td>';
								echo '<td style="color:black">'.$row['Date'].'</td>';
								echo '<td style="color:black">'.$row['Detail'].'</td>';
								echo '</tr>';

							}

						echo '</table>';
						}
	?>

            </center>


            </div>
          </div>
        </div>










</div>


</body>
</html>
