<?php
//session_start();// on top
$mes='';
include_once 'dbconnect.php';
if (isset($_POST['regist']))
{
		/*echo 'hi<br>';
		echo 'hi<br>';*/
		$firstname = $_POST['firstname'];

		$lastname = $_POST['lastname'];
		$position = $_POST['position'];
		$telephone = $_POST['telephone'];
		$email = $_POST['email'];
		//$pass = $_POST['pass'];
		$address = $_POST['address'];
		$salary = $_POST['salary'];
		/*echo $firstname.'<br>';
		echo $lastname.'<br>';
		echo $gender.'<br>';
		echo $telephone.'<br>';*/
		//echo $email.'<br>';
		//echo $pass.'<br>';
		//echo $address.'<br>';
	$check = "SELECT Email FROM login WHERE Email= '".$email."'";

	if($result = $mysqli->query($check)){
		if (mysqli_num_rows($result) == 1)
			{
				$mes='This email is already used. Please use another email.';
			}



		else if (
						$firstname != "" &&
						$lastname != "" &&
						$position != "" &&
						$telephone != "" &&
						$address != "" &&
						$email != "" &&
						$salary != ""
						//$pass != ""
						)
							{

								$pass=MD5('1234');
								echo 'inhere';
								$q = "INSERT INTO LogIn(UserType,Email,Password) " .
								" VALUES('".$position."','".$email."','".$pass."') ";
								$mysqli->query($q);

								$getUID = "SELECT UID FROM LogIn WHERE Email= '".$email."'";
								$res = $mysqli->query($getUID);
								$row = $res-> fetch_array();


								$t = "INSERT INTO staff(Firstname,Lastname, Tel,Address,Position,Salary,LogIn_UID) " .
								" VALUES('".$firstname."','".$lastname."','".$telephone."','".$address."','".$position."','".$salary."','".$row['UID']."') ";
								//$mysqli->query($t);

								/*$getCID = "SELECT CID FROM Customer WHERE LogIn_UID= '".$row['UID']."'";
								$result = $mysqli->query($getCID);
								$roww = $result-> fetch_array();
								echo $roww['CID'];

								$y = "INSERT INTO Address(Address,Customer_CID) " .
								" VALUES('".$address."','".$roww['CID']."') ";*/

								if ($mysqli->query($t))
								{
									header("Location: Admin_staff_info.php");
								}


							}
	}
					else{
					  $mysqli->connect_error;
						header("Location: check_info.php");
							}


}







?>

<!DOCTYPE html>
<html>
<head>
<title> add staff </title>
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

            <div class="column">
              <h2>Add STAFF</h2><hr><br>
              <form action="Admin_add_staff.php" method = "POST">
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="firstname" placeholder="Your name..">

                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="lastname" placeholder="Your last name..">

                <label for="tel">Telephone No.</label>
            <input type="text" id="tel" name="telephone" placeholder="08x-xxx-xxxx">

            <label for="email">Email</label>
            <input type="text" id="email" name="email" placeholder="e-mail">
			<label><font color="red"><?php echo $mes.'<br>';?></font></label>

            <label for="add">Address</label>
            <textarea id="subject" name="address" placeholder="Address.." style="height:50px"></textarea>

            <label>Position</label>
            <br><br><input type="radio" name="position" value="Admin"> Admin
            <input type="radio" name="position" value="Delivery Staff" checked> Delivery Staff<br><br>

            <label for="email">Salary</label>
            <input type="text" id="salary" name="salary" placeholder="salary">








            <input type="submit" id="signin" value="Add" name="regist">

              </form>
            </div>
          </div>
        </div>


</body>
</html>
