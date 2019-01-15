<?php
include_once 'dbconnect.php';
//include ('dbconnect.php');
if (isset($_SESSION['s_id']))
			{
        $getID = $_SESSION['s_id'];
        $q = "SELECT * FROM Staff WHERE Staff.LogIn_UID = $getID";
        $result=$mysqli->query($q);
        $row=$result->fetch_array();
      }

if(isset($_GET['deleteID']))
{
  $getCID = $_GET['deleteID'];

	$sqlquery_UID = "SELECT LogIn_UID From Customer WHERE CID = $getCID";
	$getUID = mysqli_query($mysqli,$sqlquery_UID);
	$row1 =$getUID->fetch_array();

    //echo $row1['LogIn_UID']."<br>";


	$sqlquery_delete_address = "DELETE FROM address WHERE Customer_CID = $getCID";
  $sqlquery_delete_customer = "DELETE FROM customer WHERE CID = $getCID";
	$sqlquery_delete_login = "DELETE FROM login WHERE UID = ".$row1['LogIn_UID'];
  mysqli_query($mysqli,$sqlquery_delete_address);
	mysqli_query($mysqli,$sqlquery_delete_customer);
	mysqli_query($mysqli,$sqlquery_delete_login);
}


?>

<!DOCTYPE html>
<html>
<head>
<title> Customer Info </title>
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

  <!-- Navigation-->

  <?php include 'staff_header.php'; ?>
    <!-- Contact us-->
        <div class="container">

          <div class="row">

            <div class="mid">
              <h2>CUSTOMER INFORMATION</h2><hr>
              <center>


            <?php
						$q = "SELECT * FROM Customer,LogIn,Address WHERE Customer.CID = Address.Customer_CID
						AND LogIn.UID = Customer.LogIn_UID AND Address.Status = 'on' ORDER BY Customer_CID";


						if($result = $mysqli->query($q)){

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
						echo '<td>Edit</td>';
						echo '<td>Delete</td>';
						echo '</tr>';

							$data = [];
							$lastId = -1;
							while($row = $result->fetch_array()){
								if($row['CID'] == $lastId){
									$data[count($data) - 1]['Address'] .= '<br />' .'<br />' . $row['Address'];
								}else{
									$data[] = $row;
								}
								$lastId = $row['CID'];
							}
							foreach($data as $row){

								echo '<tr>';
								echo '<td style="color:black">'.$row['CID'].'</td>';
								echo '<td style="color:black">'.$row['FirstName'].'</td>';
								echo '<td style="color:black">'.$row['LastName'].'</td>';
								echo '<td style="color:black">'.$row['Gender'].'</td>';
								echo '<td style="color:black">'.$row['Tel'].'</td>';
								echo '<td style="color:black">'.$row['Email'].'</td>';
								echo '<td style="color:black">'.$row['Address'].'</td>';
								echo '<td style="color:black">'.$row['LogInStatus'].'</td>';
								echo '<td><a href="Admin_edit_customer.php?eid='.$row[0].'">';
								echo '<img style="margin: 0px 10px"src="edit.png" width="25px" height="25px"></td></a></td>';
								echo '<td><a href="Admin_customer_info.php?deleteID='.$row['CID'].'">';
								echo '<img style="margin: 0px 10px"src="error.png" width="15px" height="15px"></a></td>';
								echo '</tr>';

							}
						echo '</table>';
						}
	?>


              <br>
              <a href="Admin_add_customer.php"><input type="submit"  value="ADD CUSTOMER"></a>
            </center>


            </div>
          </div>
        </div>

</body>
</html>
