
<?php include_once 'dbconnect.php';
if (isset($_POST['regist']))
{
		echo 'hi<br>';
		echo 'hi<br>';
		
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$gender = $_POST['gender'];
		$telephone = $_POST['telephone'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		echo $firstname.'<br>';
		echo $lastname.'<br>';
		echo $gender.'<br>';
		echo $telephone.'<br>';
		echo $email.'<br>';
		//echo $pass.'<br>';
		echo $address.'<br>';
	if (
					$firstname != "" &&
					$lastname != "" &&
					$gender != "" &&
					$telephone != "" &&
					$address != "" &&
					$email != "" 
					//$pass != ""
					)
						{
							echo 'inhere';
							$q = "INSERT INTO LogIn(Email,Password) " .
							" VALUES('".$email."','1234') ";
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
								header("Location: Admin_customer_info.php");
							}


						}
				else{
				  $mysqli->connect_error;
					header("Location: check_info.php");
						}


}
?>
