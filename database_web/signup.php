<?php
session_start();// on top
$mes='';
include_once 'dbconnect.php';
if (isset($_POST['regist']))
{

		$firstname = $_POST['firstname'];

		$lastname = $_POST['lastname'];
		$gender = $_POST['gender'];
		$telephone = $_POST['telephone'];
		$email = $_POST['email'];
		$p = $_POST['pass'];
		$pass=MD5($p);
		$address = $_POST['address'];

	$check = "SELECT Email FROM login WHERE Email= '".$email."'";

	if($result = $mysqli->query($check)){
		if (mysqli_num_rows($result) == 1)
			{
				$mes='This email is already used. Please use another email.';
			}
		else if (
						$firstname != "" &&
						$lastname != "" &&
						$gender != "" &&
						$telephone != "" &&
						$address != "" &&
						$email != "" &&
						$pass != ""
						)
							{
								echo 'inhere';
								$q = "INSERT INTO LogIn(Email,Password) " .
								" VALUES('".$email."','".$pass."') ";
								$mysqli->query($q);

								$getUID = "SELECT UID FROM LogIn WHERE Email= '".$email."'";
								$res = $mysqli->query($getUID);
								$row = $res-> fetch_array();


								$t = "INSERT INTO Customer(Firstname,Lastname, Tel,Gender,LogIn_UID) " .
								" VALUES('".$firstname."','".$lastname."','".$telephone."','".$gender."','".$row['UID']."') ";
								$mysqli->query($t);

								$getCID = "SELECT CID FROM Customer WHERE LogIn_UID= '".$row['UID']."'";
								$result = $mysqli->query($getCID);
								$roww = $result-> fetch_array();
								echo $roww['CID'];

								$y = "INSERT INTO Address(Address,Customer_CID) " .
								" VALUES('".$address."','".$roww['CID']."') ";

								if ($mysqli->query($y))
								{
									header("Location: success.php");
								}


							}
	}
					else{
					  $mysqli->connect_error;
						header("Location: check_info.php");
							}


}







?>

<html>
<head>
<title> sign up </title>
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
    <?php include 'header_front.php';?>
    <!-- Contact us-->
        <div class="container">

          <div class="row">

            <div class="column">
              <h2>Sign Up</h2><hr><br>
              <form action="signup.php" method='POST'>
                <label>First Name</label>
                <input type="text" name="firstname" placeholder="Your name..">

                <label>Last Name</label>
                <input type="text" name="lastname" placeholder="Your last name..">

                <label>Gender</label>
                <input type="radio" name="gender" value="male"> Male
                <input type="radio" name="gender" value="female"> Female
                <input type="radio" name="gender" value="other"> Other<br><br>
                <label>Telephone No.</label>
            <input type="text" name="telephone" placeholder="08x-xxx-xxxx">
						<label>Address</label>
            <textarea name="address" placeholder="Address.." style="height:50px"></textarea>
            <label>Email</label>
            <input type="text" name="email" placeholder="e-mail">
			<label><font color="red"><?php echo $mes.'<br>';?></font></label>




                <label>password</label>
                <input type="password" name="pass" placeholder="password">




            		<input type="submit" id="signin" name ="regist" value="Sign Up">

              </form>
            </div>
          </div>
        </div>


</body>
</html>
